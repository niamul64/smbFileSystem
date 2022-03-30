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
        echo $operation.'"'.$folderNameThatWeWantToDelete.'" directory just deleted <br>';
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
        <!-- write delete code; -->
        <?php
        echo '<br>';
    }
} // end of printListOfDirectoriesAndFiles()
    ?> 



<?php
// Main Function:
$files= grabFileAndDirectories($currentPath);
printListOfDirectoriesAndFiles($files)
?> 



</body>
</html>