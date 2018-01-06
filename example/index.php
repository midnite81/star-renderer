<?php
include '../vendor/autoload.php';
$config = include '../config/stars.php';
$star = new Midnite81\StarRenderer\StarRenderer($config);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Stars</title>
</head>
<body>
    <?php echo $star->render(4.5, 5); ?>
</body>
</html>