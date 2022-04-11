<?php
define("rootDir","/home/user/Documents/sharef"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
    $fileExists=0;
  
    $nextDir = $_POST['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;

    if (isset($_FILES['fileToUpload']) && $_FILES["fileToUpload"]["size"] >0 ){ // if a image selected
        if (file_exists($currentPath.'/'.$_FILES["fileToUpload"]["name"])){
               $fileExists=1;
        }
        else{
            $tmp=$_FILES["fileToUpload"]["tmp_name"];
            move_uploaded_file($tmp,$currentPath.'/'.$_FILES["fileToUpload"]["name"]);
        }
    }

echo $nextDir.'|'.$fileExists;
    
}

?>