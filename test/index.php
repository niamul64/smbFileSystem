<?php
define("rootDir","/home/user/Documents/sharef"); 
$zip_file= "/home/user/Documents".'/'."zipFile.zip";

$file1='a.txt';
$filePath1=rootDir.'/'.$file1;
$file2='absadsss.txt';
$filePath2=rootDir.'/'.$file2;



$zip = new ZipArchive();
$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE);

$zip->addFile($filePath1, $file1);
$zip->addFile($filePath2, $file2);
  
$zip->close();

$zipFileUrl=$zip_file;
if (file_exists($zipFileUrl)){// checking: if file exists
    header('Content-Type: application/octet-stream');
    header("Content-Transfer-Encoding: Binary"); 
    header("Content-disposition: attachment; filename=\"" . basename($zipFileUrl) . "\""); 
    readfile($zipFileUrl); 
    echo "file downloading";
}



// $file1='a.txt';
// $filePath1=rootDir.$file1;
// $file2='main.txt';
// $filePath2=rootDir.$file2;

// $zip = new ZipArchive();
// $zip->open('/home/user/Documents/sharef/', ZipArchive::CREATE | ZipArchive::OVERWRITE);
    
// $zip->addFile($filePath1, $file1);
// $zip->addFile($filePath2, $file2);
// $zip->close();
// var_dump($zip["numFiles"]);
?>