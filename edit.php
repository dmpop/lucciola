<?php
error_reporting(E_ERROR);
?>

<html lang="en">
<!-- Author: Dmitri Popov, dmpop@linux.com
         License: GPLv3 https://www.gnu.org/licenses/gpl-3.0.txt -->

<head>
    <meta charset="utf-8">
    <title>Lucciola</title>
    <link rel="shortcut icon" href="img/favicon.png" />
    <link rel="stylesheet" href="css/milligram.min.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/popup.css">
    <script src="js/popup.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
    <div style="text-align: center;">
        <img style="height: 3.1em; margin-top: 1em; display: inline; vertical-align: bottom;" src="img/favicon.svg" alt="logo" />
        <h1 style="display: inline; vertical-align: bottom;">Lucciola</h1>
        <hr>
        <button class="button button-outline" onclick='window.location.href = "index.php"'>Back</button>
        <?php
        function Read()
        {
            $f = "commands.csv";
            echo file_get_contents($f);
        }
        function Write()
        {
            $f = "commands.csv";
            $data = $_POST["text"];
            file_put_contents($f, $data);
            echo '<script>
                    popup("Changes have been saved");
                </script>';
        }
        if (isset($_POST["save"])) {
            Write();
        };
        ?>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <textarea name="text"><?php Read(); ?></textarea><br />
            <button type="submit" name="save">Save</button>
        </form>
        <hr style="margin-top: 2em;">
        <p>This is <a href="https://github.com/dmpop/lucciola">Lucciola</a></p>
    </div>
</body>

</html>