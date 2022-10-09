#!/usr/bin/env bash

#  This program is free software; you can redistribute it and/or modify
#  it under the terms of the GNU General Public License as published by
#  the Free Software Foundation; either version 2 of the License, or
#  (at your option) any later version.
#
#  This program is distributed in the hope that it will be useful,
#  but WITHOUT ANY WARRANTY; without even the implied warranty of
#  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#  GNU General Public License for more details.
#
#  You should have received a copy of the GNU General Public License
#  along with this program; if not, write to the Free Software
#  Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston,
#  MA 02110-1301, USA.

BACKUP_PATH="/media/usb0"

# Check for Raspberry Pi OS
os_check=$(cat /etc/os-release | grep Raspbian)

# Wait for camera
camera=$(gphoto2 --auto-detect | grep usb)
while [ -z "$camera" ]; do
	sleep 1
	camera=$(gphoto2 --auto-detect | grep usb)
done

# Set the ACT LED to heartbeat to indicate that the camera has been detected
if [ ! -z "$os_check" ]; then
	sudo sh -c "echo heartbeat > /sys/class/leds/led0/trigger"
fi

# Transfer new files
gphoto2 --filename "$BACKUP_PATH/%d%m%Y-%H%M%S-%n.%C" --get-all-files --skip-existing >>"/tmp/lucciola.log" 2>&1
# Shutdown
if [ ! -z "$os_check" ]; then
	sudo poweroff
fi
