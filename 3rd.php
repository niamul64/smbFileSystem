<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
include "smb.php";


//$files = nclude( 'smb://User1:june@192.168.0.107/sharef');

// $files = scandir( 'smb://User1:june@192.168.0.107/sharef');
$files = scandir( 'smb://june:User1@192.168.0.107/sharef');

print_r($files);

var_dump(is_dir('smb://june:User1@192.168.0.107/sharef'));

?> 


</body>
</html>