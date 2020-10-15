<?php
session_start();
?>
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
    <h1>Web file browser</h1>
    <h2>Please login to see content!</h2>
    <?php
    if (isset($_POST['login']) && !empty($_POST['username']) && !empty($_POST['password'])) {
        if ($_POST['username'] == "user" && $_POST['password'] == "user1") {
            $_SESSION['logged_in'] = true;
            $_SESSION['timeout'] = time();
            $_SESSION['username'] = "User";
            echo "You've successfully logged in!";
        } else {
            echo "Wrong username or password";
        }
    }
    ?>
    <?php
    $path = "." . $_GET['path'];
    if (isset($_POST['name'])) {
        mkdir($path . "/" . ($_POST['name']));
    }
    if (array_key_exists('file', $_GET)) {
        unlink($path . "/" . $_GET['file']);
    }
    $dir_contents = scandir($path);
    echo ("<table><thead><tr>
        <th>Type</th>
        <th>Name</th>
        <th>Actions</th>
        </tr></thead>");
    echo ("<tbody><tr>");
    foreach ($dir_contents as $cont) {
        if ($cont == "." || $cont == "..") {
            continue;
        }
        echo ("<tr><td>" . (is_dir($path . "/" . $cont) ? "Dir" : "File") . "</td>");
        if (is_dir($path . "/" . $cont)) {
            echo ("<td>" . "<a href='./?path=" . $_GET['path'] . "/" . $cont . "'>" . $cont .  "</a></td>");
        } else {
            echo ("<td>" . $cont . "</td>");
        }
        if (is_file($path . "/" . $cont)) {
            if ($cont != "index.php") {
                echo ("<td><button><a href='./?path=" . $_GET['path'] . "&file=" . $cont . "'>" . "Delete</a></button></td>");
            } else {
                echo ("<td></td>");
            }
        } else {
            echo ("<td></td>");
        }
    }
    echo ("</tbody></table>");
    $split = explode("/", $_GET['path']);
    $emptyString = "";
    for ($i = 0; $i < count($split) - 1; $i++) {
        if ($split[$i] == "")
            continue;
        $emptyString .= "/" . $split[$i];
    }
    echo ("<button>" . "<a href='./?path=" . $emptyString . "'>" . "BACK" . "</a>" . "</button>");
    ?>
    <form action="<?php $path ?>" method="POST">
        <label for="name">Directory name</label>
        <br>
        <input type="text" id="name" name="name" placeholder="Eneter dir name">
        <button type="submit">Create new directory</button>
        <br>
        <br>
        <br>
    </form>

    <form action="" method="POST">
        <label for="username">Enter your username</label>
        <br>
        <input type="text" name="username" id="username" placeholder="user">
        <br>
        <label for="password">Enter your password</label>
        <br>
        <input type="password" name="password" id="password" placeholder="user1">
        <br>
        <input type="submit" value="Login">
    </form>
</body>

</html>