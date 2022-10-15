# Lucciola

Lucciola provides a simple web interface to control any supported camera via gPhoto2. Lucciola also transforms a Raspberry Pi into a automatic camera backup device.

## Rationale

Most modern cameras can be controlled using dedicated apps, so it may seem that Lucciola tries to solve a non-existing problem in a somewhat more convoluted way. However, Lucciola has a number of important advantages.

- No proprietary software. Lucciola is an open-source software based on PHP and gPhoto2.
- Lucciola runs in any browser, so you are not limited to iOS or Android devices.
- The tool is not limited to a specific camera model. If your camera is supported by gPhoto2, it will work with Lucciola.
- Lucciola is deliberately made simple, so you can easily customize, extend, and improve it.

## Dependencies

- PHP
- gPhoto2
- Git (optional)

# Installation and usage

On Raspberry Pi running Raspberry Pi OS Lite, run the following command:

```bash
curl -sSL https://raw.githubusercontent.com/dmpop/lucciola/main/install-lucciola.sh | bash
```

<!--
The [Linux Photography](https://gumroad.com/l/linux-photography) book provides instructions on installing and using Everyday Photo Carry. Get your copy at [Google Play Store](https://play.google.com/store/books/details/Dmitri_Popov_Linux_Photography?id=cO70CwAAQBAJ) or [Gumroad](https://gumroad.com/l/linux-photography).

<img src="https://tokyoma.de/bookcovers/linux-photography.jpg" title="Linux Photography book" width="200"/>
-->

## Problems?

Please report bugs and issues in the [Issues](https://github.com/dmpop/lucciola/issues) section.

## Contribute

If you've found a bug or have a suggestion for improvement, open an issue in the [Issues](https://github.com/dmpop/lucciola/issues) section.

To add a new feature or fix issues yourself, follow the following steps.

1. Fork the project's repository.
2. Create a feature branch using the `git checkout -b new-feature` command.
3. Add your new feature or fix bugs and run the `git commit -am 'Add a new feature'` command to commit changes.
4. Push changes using the `git push origin new-feature` command.
5. Submit a pull request.

## Author

Dmitri Popov [dmpop@tokyoma.de](mailto:dmpop@tokyoma.de)

## License

The [GNU General Public License version 3](http://www.gnu.org/licenses/gpl-3.0.en.html)
 
