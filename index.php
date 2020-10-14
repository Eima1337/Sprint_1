<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web File Browser</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/main.css">

</head>
<body>
    <?php
        $path = "." . $_GET['path'];
        print ($path);
        // print($_GET['path']);
        $dir_contents = scandir($path);
        echo ("<table><thead><tr>
        <th>Type</th>
        <th>Name</th>
        <th>Actions</th>
        </tr></thead>");
        echo ("<tbody><tr>");
        foreach ($dir_contents as $cont) {
            echo("<tr><td>" . (is_dir($cont) ? "Dir" : "File") . "</td>");
            if (is_dir($cont)) {
                echo("<td>" . "<a href='./?path=" . "/" . $cont . "'>" . $cont .  "</a></td>");
            } else {
                echo("<td>" . $cont . "</td>");
            }
            if (is_file($cont)) {
                echo("<td><button>Delete</button></td>");
            } else {
                echo("<td></td>");
            }
        }
        echo("</tbody></table>");
        echo("<button>" . "<a href='?path='>" . "BACK" . "</a>" . "</button>");
    ?>




    <script src="js/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>