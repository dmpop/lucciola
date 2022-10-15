#!/usr/bin/env bash

# Author: Dmitri Popov, dmpop@linux.com

#######################################################################
# This program is free software: you can redistribute it and/or modify
# it under the terms of the GNU General Public License as published by
# the Free Software Foundation, either version 3 of the License, or
# (at your option) any later version.

# This program is distributed in the hope that it will be useful,
# but WITHOUT ANY WARRANTY; without even the implied warranty of
# MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
# GNU General Public License for more details.

# You should have received a copy of the GNU General Public License
# along with this program.  If not, see <http://www.gnu.org/licenses/>.
#######################################################################

if [ ! -x "$(command -v apt)" ]; then
        echo "Looks like it's not an Ubuntu- or Debian-based system."
        exit 1
fi

if [[ $EUID -eq 0 ]]; then
        echo "Run the script as a regular user"
        exit 1
fi

cd
sudo apt update
sudo apt upgrade -y
sudo apt install -y git gphoto2 screen usbmount exfat-fuse exfat-utils php-cli
sudo apt autoremove -y

git clone https://github.com/dmpop/lucciola.git
chmod +x $HOME/lucciola/*.sh
sudo ln -s $HOME/lucciola/lucciola.sh /usr/local/bin/lucciola
sudo mv /etc/usbmount/usbmount.conf /etc/usbmount/usbmount.conf.bak
sudo bash -c "cat > /etc/usbmount/usbmount.conf" << EOL
ENABLED=1
MOUNTPOINTS="/media/usb0 /media/usb1 /media/usb2 /media/usb3
             /media/usb4 /media/usb5 /media/usb6 /media/usb7"
FILESYSTEMS="vfat exfat ext2 ext3 ext4 hfsplus"
MOUNTOPTIONS="sync,noexec,nodev,noatime,nodiratime,uid=1000,gid=1000"
FS_MOUNTOPTIONS=" "
VERBOSE=no
EOL
crontab -l | {
        cat
        echo "@reboot sudo /home/"$USER"/lucciola/lucciola.sh"
        } | crontab
crontab -l | {
        cat
        echo "@reboot sudo /home/"$USER"/lucciola/ip.sh"
        } | crontab
echo "All done. The system will reboot now."
sudo reboot

# Create Lucciola systemd service unit
sudo sh -c "echo '[Unit]' > /etc/systemd/system/lucciola.service"
sudo sh -c "echo 'Description=Lucciola' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo '[Service]' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo 'Restart=always' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo 'ExecStart=/usr/bin/php -S 0.0.0.0:8000 -t /home/"$USER"/lucciola' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo 'ExecStop=/usr/bin/kill -HUP \$MAINPID' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo '[Install]' >> /etc/systemd/system/lucciola.service"
sudo sh -c "echo 'WantedBy=multi-user.target' >> /etc/systemd/system/lucciola.service"
sudo systemctl enable lucciola.service
sudo systemctl start lucciola.service

echo "-------------------------------------"
echo "All done! The system will reboot now."
echo "-------------------------------------"
sleep 5
clear
sudo reboot
