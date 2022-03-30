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

        if (is_dir(rootDir.'/'.$nextDir.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 
            
            <a href="index.php?go=<?php echo $nextDir.'/'.$eachFile; ?> " > <?php echo "$fileCountIndex. "; echo $eachFile; ?> </a>
            
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