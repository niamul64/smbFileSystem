<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>file System</title>
</head>
<body>
<?php




define("rootDir","/home/user/Documents/sharef"); // this is the main directory path that have shared
$nextDir=''; // variable to keep the path after root directory
$currentPath=rootDir; // variable to keep full path


if (isset($_GET ['go'])){ // if the user clicks on the directory to go insidde 
    global $nextDir;
    $nextDir = $_GET['go']; // grabbing path after root with the folder name which jus clicked 
    $currentPath = rootDir.$nextDir; // making the full path
}

if (isset($_GET ['folderName'])){ // if the user clicks on delete button for directory delete 
    global $nextDir;
    $nextDir = $_GET['deletePath']; // for keeping the path to directory
    $currentPath = rootDir.$nextDir; // the directory path, where the folder going to be deleted
    $folderNameThatWeWantToDelete= $_GET['folderName']; // grabbing the folder name which the user want to delete
    
    // deleting process
    if (is_dir($currentPath.'/'.$folderNameThatWeWantToDelete)){ // checking the foldder actually exists

        rmdir($currentPath.'/'.$folderNameThatWeWantToDelete); // deleting the folder 
        if (!is_dir($currentPath.'/'.$folderNameThatWeWantToDelete)){ // delete process successfull or not successfull message print
            echo $operation.'"'.$folderNameThatWeWantToDelete.'" directory just deleted <br>';
        }
        else{
            echo 'could not delete the directory <br>';
        }  
    } 
}

if (isset($_GET ['fileName'])){ // if the user clicks on file delete butoon
    global $nextDir;
    $nextDir = $_GET['deletePath']; // for keeping the file path after root path
    $currentPath = rootDir.$nextDir; // the full file path, wher the file going to be deleted
    $folderNameThatWeWantToDelete= $_GET['fileName']; // grabbing the file name which we want to delete
    
    // deleting process
    if (file_exists($currentPath.'/'.$folderNameThatWeWantToDelete)){// checking: if file exists
        unlink($currentPath.'/'.$folderNameThatWeWantToDelete); // deleting the file
        echo $operation.'"'.$folderNameThatWeWantToDelete.'" file just deleted <br>'; // success full delete message
    } 

}


function grabFileAndDirectories($path){

    $files = scandir($path); // grabing all files in the directory
    $files = array_diff($files,array('.','..')); // removing extra dots
    return array_values($files); // returning a array of all directories and files
}   // end of grabFileAndDirectories()
?> 

<?php

function printListOfDirectoriesAndFiles($listOfFilesAndDirectories){
    global $nextDir, $currentPath;
    

    $onlyFiles= array(); // array to keep all files only, no directory.

    echo '<b>All Directories and Files:</b><br> '; // Print Heading 
 
    echo 'current path: Root'.$nextDir.'<br>';
    ?> 
     <a href="index.php?go=" > <?php echo 'Goto Home Directory <br><br>'; ?> </a>
    <?php

    $fileCountIndex= 0; // count index  for folders and files 

    echo "<b>Directories: </b><br>";
    ?> 

    <?php

    foreach ($listOfFilesAndDirectories as $eachFile){

        if (is_dir($currentPath.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 
            
            <a href="index.php?go=<?php echo $nextDir.'/'.$eachFile; ?> " > <?php echo "$fileCountIndex. "; echo $eachFile; ?> </a>
            <a href="index.php?deletePath=<?php echo $nextDir; ?>&folderName=<?php echo $eachFile; ?>  " > <button>Delete</button></a> 
            
            <?php
            echo '<br>';
        } 
        else{
            array_push($onlyFiles, $eachFile);
        }
    }

    echo "<br><b>Files: </b><br>";

    ?> 

    <?php
    foreach ($onlyFiles as $eachFile){
        $fileCountIndex += 1;
        echo "$fileCountIndex. "; 
        echo ($eachFile);        
        ?> 
            <a href="index.php?deletePath=<?php echo $nextDir; ?>&fileName=<?php echo $eachFile; ?>  " > <button>Delete</button></a> 
        <?php
        echo '<br>';
    }
} // end of printListOfDirectoriesAndFiles()
    ?> 


<?php   // after make directory submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    global $nextDir, $currentPath;
    
    
  // collect value of input field
  $directoryName = $_POST['folderName'];
  $fileName=$_POST['fileName'];
  $fileExtension=$_POST['fileExtension'];
  $nextDir=$_POST['path']; // grabbing path after root
  $currentPath = rootDir.$nextDir;

  if ($directoryName != ''){ // if directory name field is not empty
    if (is_dir($currentPath.'/'.$directoryName)){
        echo 'Directory already exist';
        }else{
        mkdir($currentPath.'/'.$directoryName);
    }
  }
  if (($fileName != '') && ($fileExtension!='') ){ // if file name and extention fields are not empty

    if (file_exists($currentPath.'/'.$fileName.'.'.$fileExtension)){ // scecking the file alreadddy exists or not
        echo 'file already exist';
        }else{
            $file_handle = fopen($currentPath.'/'.$fileName.'.'.$fileExtension, 'w'); // creating file, and a file handler
            fclose($file_handle); // closing the file handler
    }
  }
}
?>

<!-- //html start -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Make a directory/file in current path:<br> <input type="text" name="folderName" placeholder="Directory Name"><br>  
  <input type="text" name="fileName" placeholder="File Name">.<input type="text" name="fileExtension" placeholder="Extension">
  <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
 <br> <input type="submit"><br> <!-- make directory name submission -->
</form>
<br>

<?php
// Main Function:
$files= grabFileAndDirectories($currentPath); // calling a function to scanning all directories and files in current path and return
printListOfDirectoriesAndFiles($files) // show all directories and files on html page
?> 



</body>
</html>