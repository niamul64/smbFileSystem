<?php
// all include files

include 'rootDir.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $nextDir = $_GET['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;
    $oldName = $_GET['oldName']; // directory name to making a directory
    $newName = $_GET['newName']; // file name to make new file
    
    if (file_exists($currentPath.'/'.$newName)){ // can't rename
     echo 'error';    
    }
    else{
        rename($currentPath.'/'.$oldName,$currentPath.'/'.$newName); // renaming 
        echo 'done';
    } 
}
?>