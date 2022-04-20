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

if ($_SERVER["REQUEST_METHOD"] == "POST") { 

    echo $_POST ['title'];

}

function grabFileAndDirectories($nextDir){

    $files = scandir(rootDir.$nextDir); // grabing all files in the directory
    $files = array_diff($files,array('.','..')); // removing extra dots
    return array_values($files); // returning a array of all directories and files
} // end of grabFileAndDirectories()
?> 

<?php
function changeNextDirectory($fileName){
    echo $fileName; 
}
?> 

<?php

function printListOfDirectoriesAndFiles($listOfFilesAndDirectories){

    $onlyFiles= array(); // array to keep all files only, no directory.

    echo '<h3>All Directories and Files:</h3>'; // Print Heading 
    $fileCountIndex= 0; // count index  for folders and files 

    echo "<b>Directories: </b><br>";
    ?> 
    <ul class="folders">
    <?php
    foreach ($listOfFilesAndDirectories as $eachFile){
        if (is_dir(rootDir.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 
            <?php echo "$fileCountIndex. "; ?>
            <a class='folderEach' href="#"><?php  echo ($eachFile); ?> </a>
            <?php
            echo '<br>';
        } 
        else{
            array_push($onlyFiles, $eachFile);
        }
    }
    ?> 


    </ul>
    <?php    
    echo "<br><b>Files: </b><br>";

    ?> 

<ul class="files">
    <?php
    foreach ($onlyFiles as $eachFile){
        $fileCountIndex += 1;

        ?> 
        <?php echo "$fileCountIndex. "; ?>
        <a class='fileEach' href="#"><?php  echo ($eachFile); ?> </a>
        <?php

        echo '<br>';
    }
} // end of printListOfDirectoriesAndFiles()
    ?> 
</ul>

<?php
// Main Function:
$files= grabFileAndDirectories('');
printListOfDirectoriesAndFiles($files)
?> 
<script src='scrip.js'></script>

</body>
</html>