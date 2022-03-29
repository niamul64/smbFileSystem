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

function grabFileAndDirectories($nextDir){

    $files = scandir(rootDir.$nextDir); // grabing all files in the directory
    $files = array_diff($files,array('.','..')); // removing extra dots
    return array_values($files);
}


function printListOfDirectoriesAndFiles($listOfFilesAndDirectories){

    echo '<h3>All Directories and Files:</h3>'; // Print Heading 
    echo '<pre>';
    $fileCountIndex= 0;
    foreach ($listOfFilesAndDirectories as$eachFile){
        $fileCountIndex += 1;
        echo "$fileCountIndex. ";    
        echo($eachFile);
        echo '<br>';
    }
    echo '</pre>';
} 


// Main Function:
$files= grabFileAndDirectories('');
printListOfDirectoriesAndFiles($files)
?> 



</body>
</html>