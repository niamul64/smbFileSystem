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
$nextDir='';
$currentPath=rootDir;


if (isset($_GET ['go'])){ // if the user clicks on 
    global $nextDir;
    $nextDir = $_GET['go'];
    $currentPath = rootDir.$nextDir;

}

if (isset($_GET ['folderName'])){ // if the user clicks on 
    global $nextDir;
    $nextDir = $_GET['deletePath']; // for keeping the current directory
    $currentPath = rootDir.$nextDir; // the directory path, wwher the folder going to be deleted
    $folderNameThatWeWantToDelete= $_GET['folderName']; // grabbing the folder  name which we want to delete
    
    // deleting process
    if (is_dir($currentPath.'/'.$folderNameThatWeWantToDelete)){

        rmdir($currentPath.'/'.$folderNameThatWeWantToDelete);
        if (!is_dir($currentPath.'/'.$folderNameThatWeWantToDelete)){
            echo $operation.'"'.$folderNameThatWeWantToDelete.'" directory just deleted <br>';
        }
        else{
            echo 'could not delete the directory <br>';
        }
        
    } 

}
if (isset($_GET ['fileName'])){ // if the user clicks on 
    global $nextDir;
    $nextDir = $_GET['deletePath']; // for keeping the current directory
    $currentPath = rootDir.$nextDir; // the directory path, wwher the folder going to be deleted
    $folderNameThatWeWantToDelete= $_GET['fileName']; // grabbing the folder  name which we want to delete
    
    // deleting process
    if (file_exists($currentPath.'/'.$folderNameThatWeWantToDelete)){

        unlink($currentPath.'/'.$folderNameThatWeWantToDelete);
        echo $operation.'"'.$folderNameThatWeWantToDelete.'" file just deleted <br>';
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
    global $nextDir;
    
    
  // collect value of input field
  $DirectoryName = $_POST['folderName'];
  
  $nextDir=$_POST['path']; // grabbing path after root
  $currentPath = rootDir.$nextDir;

  
  if (is_dir($currentPath.'/'.$DirectoryName)){
      echo 'Directory already exist';
  }else{
    mkdir($currentPath.'/'.$DirectoryName);
  }

}
?>



<!-- //html start -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Make a directory in current path:<br> <input type="text" name="folderName" placeholder="Directory Name">
  <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
  <input type="submit"><br> <!-- make directory name submission -->
</form>
<br>



<?php
// Main Function:
$files= grabFileAndDirectories($currentPath);
printListOfDirectoriesAndFiles($files)
?> 



</body>
</html>