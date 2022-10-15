<!DOCTYPE html>
<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com, tokyoma.de
	 License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
	<meta charset="utf-8">
	<title>Lucciola</title>
	<link rel="shortcut icon" href="img/favicon.png" />
	<link rel="stylesheet" href="css/milligram.min.css">
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="css/popup.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
	<!-- Suppress form re-submit prompt on refresh -->
	<script>
		if (window.history.replaceState) {
			window.history.replaceState(null, null, window.location.href);
		}
	</script>
	<div style="text-align: center;">
		<img style="height: 3.1em; margin-top: 1em; display: inline; vertical-align: bottom;" src="img/favicon.svg" alt="logo" />
		<h1 style="display: inline; vertical-align: bottom;">Lucciola</h1>
		<hr>

		<?php
		// Check is the camera is connected
		$camera = shell_exec("gphoto2 --auto-detect | grep usb");
		echo $camera;
		// If the camera is not detected, show a warning message
		if (empty($camera)) {
			echo '<figure>
					<img style="display: inline; height: 1.5em; margin-right: 0.5em; vertical-align: middle;" src="img/alert.svg" alt="alert" />
						<figcaption>Camera is not connected</figcaption>
				</figure>';
		}
		// Iff the camera is detected, capture a preview image
		if (isset($_POST["refresh"])) {
			unlink("capture_preview.jpg");
			shell_exec("gphoto2 --capture-preview");
		}
		echo "</p>";
		// Show the captured preview image
		if (file_exists("capture_preview.jpg")) {
			echo '<img style="border-radius: 9px;" src="capture_preview.jpg">';
		}
		?>

		<?php
		// Read the first row of the commands.csv file
		if (file_exists("commands.csv")) {
			$handle = fopen("commands.csv", "r");
			$custom = fgetcsv($handle, 1000, ";");
		}
		?>

		<form style="margin-top: 2em;" action=" " method="POST">
			<button class="button button-outline" type="submit" style="display: inline;" name="refresh">Refresh</button>
			<?php
			if (!empty($camera)) {
				echo '<button class="button button-outline" type="submit" style="display: inline;" name="capture">Capture</button>
			<button type="submit" style="display: inline;" name="custom">' . $custom[0] . '</button>';
			}
			?>
			<button type='submit' style="display: inline;" name="poweroff">Power off</button>
		</form>
		<hr style="margin-top: 2em;">
		<?php
		if (isset($_POST["capture"])) {
			echo "<pre>";
			passthru("gphoto2 --capture-image-and-download --keep --filename photos/%Y%m%d-%H%M%S-%03n.%C");
			echo "</pre>";
		}
		?>

		<?php
		// If the custom button pressed, pass the second value of the $custom array as a gPhoto2 command.
		if (isset($_POST["custom"])) {
			echo "<pre>";
			passthru('gphoto2 ' . $custom[1]);
			echo "</pre>";
		}
		?>

		<form style="margin-top: 1.5em; display: inline;" action='index.php' method='POST'>
			<select style="width: 25em;" name="parameter">
				<option value=''>Select command</option>
				<?php
				if (file_exists("commands.csv")) {
					$handle = fopen("commands.csv", "r");
					fgetcsv($handle);
					while (($row = fgetcsv($handle, 1000, ";")) !== FALSE) {
						echo '<option value="' . $row[1] . '">' . $row[0] . "</option>";
					}
				} else {
					echo '<option disabled>commands.csv not found</option>';
				}
				?>
			</select>
			<button style="vertical-align: top;" type="submit">OK</button>
		</form>
		<button class="button button-outline" type="button" onclick="location.href='edit.php';">Edit commands</button>

		<?php

		if (!file_exists("photos")) {
			mkdir("photos", 0777, true);
		}

		if (isset($_POST["cmd"])) {
			echo '<pre>';
			passthru('gphoto2 ' . $_POST["cmd"]);
			echo '</pre>';
		}

		if (isset($_POST["parameter"])) {
			echo '<hr style="margin-top: 2em;"><pre>';
			$command = 'gphoto2 ' . $_POST['parameter'];
			passthru("$command");
			echo '</pre>';
		}
		if (isset($_POST["poweroff"])) {
			shell_exec('sudo poweroff > /dev/null 2>&1 & echo $!');
		}
		?>
		<hr>
		<p>This is <a href="https://github.com/dmpop/lucciola">Lucciola</a></p>
	</div>
</body>

</html>