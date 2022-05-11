<?php
// all include files

include 'rootDir.php';
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newCreatingFile=0;
    $directoryExists=0;
    $nextDir = $_POST['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;
    $directoryName = $_POST['folderName']; // directory name to making a directory
    $fileName = $_POST['fileName']; // file name to make new file
    $fileExtension = $_POST['fileExtension']; // new file  extension

    if ($directoryName != '') { // if directory name field is not empty
        if (is_dir($currentPath.'/'.$directoryName)){
            
            $directoryExists=1;
        }else{
            mkdir($currentPath.'/'.$directoryName);
        }
    }
    if (($fileName != '') && ($fileExtension!='') ){ // if file name and extention fields are not empty
    
        if (file_exists($currentPath.'/'.$fileName.'.'.$fileExtension)){ // scecking the file alreadddy exists or not
            
            $newCreatingFile=1;

            }else{
                $file_handle = fopen($currentPath.'/'.$fileName.'.'.$fileExtension, 'w'); // creating file, and a file handler
                fclose($file_handle); // closing the file handler
            }
    }


echo $nextDir.'|'.$directoryExists.'|'.$newCreatingFile;
    
}

?>