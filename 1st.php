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

$RootShareDir= '/home/user/Documents/sharef';
$files= scandir($localDir);
$files= array_diff($files,array('.','..'));
$files= array_values($files);

echo '<pre>';
print_r($files);
echo '</pre>';
?> 



</body>
</html>