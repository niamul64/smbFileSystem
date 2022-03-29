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

    <?php

    foreach ($listOfFilesAndDirectories as $eachFile){
        if (is_dir(rootDir.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 
            <button onclick="changeDir('<?php echo $eachFile; ?>')"> Go </button>
            <?php
            echo "$fileCountIndex. "; 
            echo ($eachFile);
            ?> 

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
$files= grabFileAndDirectories('');
printListOfDirectoriesAndFiles($files)
?> 

<script>
    function changeDir(fileName) {
        console.log(fileName);
    }
    
</script>

</body>
</html>