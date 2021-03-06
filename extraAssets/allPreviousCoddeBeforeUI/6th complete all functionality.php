<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>file System</title>
</head>
<body>
<?php

define("rootDir","/home/user/Documents/sharef"); // this is the main directory path that have shared
$nextDir=''; // variable to keep the path after root directory
$currentPath=rootDir; // variable to keep full path

function deleteNonemptyFile($pathToDirectory){// getting the path of dir to delete as argument.

    $files = scandir($pathToDirectory); // scaning all the dir and files inside the path
    $files = array_diff($files,array('.','..')); // removing extra dots
    foreach ($files as $file) {
        if (is_dir($pathToDirectory.'/'.$file)) {
            deleteNonemptyFile($pathToDirectory.'/'.$file);
        } else {
            unlink($pathToDirectory.'/'.$file);
        }
    }
    rmdir($pathToDirectory);

}



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
            deleteNonemptyFile($currentPath.'/'.$folderNameThatWeWantToDelete);
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
 
    echo 'current path: <span id = "currentPath">Root'.$nextDir.'</span><br>'; // showing the current path the user in 
    ?> 
    <!-- button to: on click go to root directory -->
     <a href="index.php?go=" > <?php echo 'Goto Home Directory <br><br>'; ?> </a> 

     <!-- button to go one step back -->
    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
    <input type="text" name="backButton" value="<?php echo $nextDir; ?>" hidden>
    <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
    <input id='backButton' type="submit" value='<<Back'>  <br> <!-- make directory name submission -->
    </form>


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
            array_push($onlyFiles, $eachFile); // taking the  files to another list 
        }
    }

    echo "<br><b>Files: </b><br>";

    ?> 

    <?php
    foreach ($onlyFiles as $eachFile){ // loop to show all files, not directories 
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
if ($_SERVER["REQUEST_METHOD"] == "POST") { // if directories of file creating form submitted
    global $nextDir, $currentPath;
  
    $flag= 1; // flag to identify is back button pressed // 1 for not pressed
    
    // collect value of input field
    $nextDir = $_POST['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;

    $backButton=$_POST['backButton'];
    if ($backButton){
        $flag= 0; // means: back button pressed
        $splitPath = explode("/",$nextDir);
        array_pop($splitPath); // to go back we need to remove the name of last Dir
        unset($splitPath[0]); // nothing in the 0th index
        $nextDir='';
        foreach ($splitPath as $path){
            $nextDir = $nextDir.'/'.$path; // creatring path after root
        }
        $currentPath = rootDir.$nextDir; // total path
    }
    

    
    if ($flag){ // if back Button not pressed, then go inside
        
        $directoryName = $_POST['folderName']; // directory name to making a directory
        $fileName = $_POST['fileName']; // file name to make new file
        $fileExtension = $_POST['fileExtension']; // new file  extension

        if ($directoryName != '') { // if directory name field is not empty
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
        if (isset($_FILES['fileToUpload']) && $_FILES["fileToUpload"]["size"] >0 ){ // if a image selected

            move_uploaded_file($_FILES["fileToUpload"]["tmp_name"],$currentPath.'/'. $_FILES["fileToUpload"]["name"]);
        }
    }
}
?>

<!-- //html start -->



<!-- //directories of file creating form -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
  Make a directory/file in current path:<br> <input type="text" name="folderName" placeholder="Directory Name"><br>  
  <input type="text" name="fileName" placeholder="File Name"> <b> . </b>  <input type="text" name="fileExtension" placeholder="Extension">
  <br>
  <label for="fileToUpload">upload any external file to current directory</label>
  <br><input type="file" name="fileToUpload" id="fileToUpload">
  <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
 <br> <input type="submit"><br> <!-- make directory name submission -->
</form>
<br>

<?php
// Main Function:
$files= grabFileAndDirectories($currentPath); // calling a function to scanning all directories and files in current path and return
printListOfDirectoriesAndFiles($files) // show all directories and files on html page
?> 


<script src='script.js'></script>
</body>
</html>