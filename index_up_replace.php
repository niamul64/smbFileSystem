<?php
// all include files

include 'rootDir.php';
?>

<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCreatingFile=0;
    $fileExists=0;
    $directoryExists=0;
    $nextDir = $_POST['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;
    $directoryName = $_POST['folderName']; // directory name to making a directory
    $fileName = $_POST['fileName']; // file name to make new file
    $fileExtension = $_POST['fileExtension']; // new file  extension

    
   
    if (isset($_FILES['fileToUpload']) && $_FILES["fileToUpload"]["size"] >0 ){ // if a image selected
        if (file_exists($currentPath.'/'.$_FILES["fileToUpload"]["name"])){
            unlink($currentPath.'/'.$_FILES["fileToUpload"]["name"]);
        }
            $tmp=$_FILES["fileToUpload"]["tmp_name"];
            move_uploaded_file($tmp,$currentPath.'/'.$_FILES["fileToUpload"]["name"]);
    }

echo 'ok';
    
}

?>