<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

 <a href="../home/user/Documents/sharef/file.txt"></a>
 
<?php 
$curl= curl_init();

curl_setopt($curl, CURLOPT_URL, '/home/user/Documents/sharef/file.txt');
curl_exec($curl);

echo $curl;


$file_url = '/home/user/Documents/sharef/file.txt';
header('Content-Type: application/octet-stream');
header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
readfile($file_url); 

?>


</script>
    
</body>
</html>