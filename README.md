# Lucciola

Lucciola transforms any Linux machine into a automatic camera backup device. It works with any camera supported by [gPhoto2](http://gphoto.org/proj/libgphoto2/support.php). The key goals of Lucciola design: simplicity, reliability, zero-effort operation.

# Dependencies

- gPhoto2
- Git (optional)

# Installation and usage

On Raspberry Pi running Raspberry Pi OS Lite, run the following command:

```bash
curl -sSL https://raw.githubusercontent.com/dmpop/lucciola/main/install-lucciola.sh | bash
```

On any other Linux system install gPhoto2 and specify the desired value of the `BACKUP_PATH` variable in the _lucciola.sh_ script.

## Usage

Run the `./lucciola.sh` command.

## Problems?

Please report bugs and issues in the [Issues](https://github.com/dmpop/lucciola/issues) section.

## Contribute

If you've found a bug or have a suggestion for improvement, open an issue in the [Issues](https://github.com/dmpop/lucciola/issues) section.

To add a new feature or fix issues yourself, follow the following steps.

1. Fork the project's repository repository.
2. Create a feature branch using the `git checkout -b new-feature` command.
3. Add your new feature or fix bugs and run the `git commit -am 'Add a new feature'` command to commit changes.
4. Push changes using the `git push origin new-feature` command.
5. Submit a pull request.

## Author

Dmitri Popov [dmpop@tokyoma.de](mailto:dmpop@tokyoma.de)

## License

The [GNU General Public License version 3](http://www.gnu.org/licenses/gpl-3.0.en.html)

