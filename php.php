<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
        	$path = "./" . $_GET['path'];
            $dir_contents = scandir($path);
            foreach($dir_contents as $cont){
            print("<a href='./?path=" . $_GET['path'] . "/" . $cont . "'>" . $cont . "</a><br>");
        }
                
    ?>
</body>
</html>