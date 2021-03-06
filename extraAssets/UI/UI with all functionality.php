<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>File Explorer</title>
 
</head>
<body>
<body class="bg-light">
<?php
// all global variables

define("rootDir","/home/user/Documents/sharef"); // this is the main directory path that have shared
$nextDir=''; // variable to keep the path after root directory
$currentPath=rootDir; // variable to keep full path
?>

<?php
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
?>

<?php
//all get request

//all get request End
?>
<?php
//all get/post request
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
if (isset($_GET ['fileName'])){ // if the user clicks on file delete button
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

if (isset($_GET ['downloadFileName'])){ // if the user clicks on file download button
    global $nextDir;
    $nextDir = $_GET['downloadPath']; // for keeping the file path after root path
    $currentPath = rootDir.$nextDir; // the full file path
    $folderNameThatWeWantToDownload= $_GET['downloadFileName']; // grabbing the file name which we want to download
    $file_url = $currentPath.'/'.$folderNameThatWeWantToDownload;
    // deleting process
    if (file_exists($file_url)){// checking: if file exists
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($file_url) . "\""); 
        readfile($file_url); 
    }
}


// after make directory submission
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

//all get/post request End
?>
    
<!-- container-fluid class start -->
<?php // printTitle: file explorer
function printTitle(){
?>
    <div class="container-fluid"> 
        <main>
            <div class=" text-center">
            <h2>File Explorer</h2>
            
            </div>
        </main>
<?php
}// printTitle: file explorer End
?>

<?php 
function createForm(){
    global $nextDir, $currentPath;
?>

<!-- form start -->
<div class="border p-1 container-xl">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <p class="p-1 d-flex justify-content-center bg-white text-dark">Create Directory/File Or Upload A File in The Current Path</p>
                <div class="row m-1 ">
                    <div class="col-sm-7 border">
                        <div class="input-group">
                            <input type="text" name="folderName" placeholder="Directory Name"><br> 
                        </div>
                        
                        <div class="input-group mt-1">
                            <input type="text" name="fileName" class="" placeholder="File Name" >
                            <span class="bg-white ms-2 me-2 ps-2 pe-2"><b> . </b> </span>
                            <input type="text" name="fileExtension" class="" placeholder="Extension" >
                        </div>

                    </div>
                    <div class="col-sm-5 border">
                        <label for="fileToUpload">Upload any external file to current directory</label>
                        <br><input class="" type="file" name="fileToUpload" id="fileToUpload">
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                    </div>
                    <br> <input id="submitForm" class="mt-2  btn btn-secondary" type="submit" value="Submit"><!-- submission -->
                </div>
                
             
            </form>
        
        </div>
<!-- form end -->

<hr class='bg-success'>

<?php 
}
?>

<?php
function printListOfDirectoriesAndFiles($listOfFilesAndDirectories){
    global $nextDir, $currentPath;
    $onlyFiles= array(); // array to keep all files only, no directory.
?>
<!-- main body start -->
        <div class="container mt-1 mb-6"> 
            <div class="row">
<!-- folder show start -->               
                <div class="col-sm-4 border  border-5">

                    <!-- back button start -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <input type="text" name="backButton" value="<?php echo $nextDir; ?>" hidden>
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                        <input id='backButton' class="mt-2 btn btn-dark" type="submit" value='<<Back'>  <!-- make directory name submission -->
                    </form>
                    <!-- back button end -->

                    <p  class="mt-1">Current Path: <span id="currentPath">Root/<?php echo $nextDir; ?></span> </p> <!-- show current path -->
                    
                    <!-- button to: on click go to root directory -->
                    <a class="p-1 bg-info text-dark" href="index.php?go=" > <?php echo 'Goto Home Directory'; ?> </a> 
                    
                    <p><b>Directories/Folders:</b></p>

                    <?php $fileCountIndex= 0; // count index  for folders and files  ?>

<!-- folder name and delete button start-->
                    <div class="">
            <?php

            foreach ($listOfFilesAndDirectories as $eachFile){

            if (is_dir($currentPath.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 

                    <!-- each row -->
                        <div class="border-bottom border-1 mb-2 row">
                            <div class="col-8"> <a class="text-dark" href="index.php?go=<?php echo $nextDir.'/'.$eachFile; ?> " ><?php echo "$fileCountIndex. "; echo $eachFile; ?> </a> </div>
                            <div class="col-4"> <a class="bg-info text-dark" href="index.php?deletePath=<?php echo $nextDir; ?>&folderName=<?php echo $eachFile; ?>  ">Delete</a> </div>
                        </div>
                        
            <?php
                    } 
                    else{
                        array_push($onlyFiles, $eachFile); // taking the  files to another list 
                    }
                }
            ?>

                    </div>
<!-- folder name and delete button start-->



                </div>
<!-- folder show end -->

<!-- file show start -->
                <div class="col-sm-8">
                    <p class="p-1 d-flex justify-content-center bg-white text-dark">All files in the current path</p>
                    
<!-- files card start -->
                    <div class="container-fluid">
                        <div class="row justify-content-md-center">


                        <?php
                        foreach ($onlyFiles as $eachFile){ // loop to show all files, not directories 
                            $fileCountIndex += 1;
       
                        ?> 
                        <!-- each file start -->
                            <div class="me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" > 
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $eachFile; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">size: 5KB</h6>
                                    <p class="card-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </p>

                                    <a class="card-link text-dark " href="index.php?deletePath=<?php echo $nextDir; ?>&fileName=<?php echo $eachFile; ?> "> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a> 
                                    <a class="card-link" href="index.php?downloadPath=<?php echo $nextDir; ?>&downloadFileName=<?php echo $eachFile; ?> "> 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                        <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                        <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                    </svg>
                                    </a> 
                                </div>
                            </div>
                            <!-- each file end -->
                            <?php

                                }
                            ?> 
                            
                        </div>
                    </div>
<!-- files card ends -->


                </div>
<!-- file show start -->

            </div>
        </div>
<!-- main body end -->
<?php } ?>



    </div>
<!-- container-fluid class end-->

<?php
function extraGapToMakeSepareTheFooter(){
?>
<!-- only to make gap start-->
<br><br> 
<!-- only to make gap start-->
<?php
}
?>
<?php
function printFooter(){
?>
    <!-- footer start -->
    <footer class="pt-5 text-muted text-center text-small fixed-bottom">
        <p class="mb-1">&copy; 2005???2022 Brotecs Technologies Limited</p>
        <ul class="list-inline">
            <li class="list-inline-item"><a href="#">Privacy</a></li>
            <li class="list-inline-item"><a href="#">Terms</a></li>
            <li class="list-inline-item"><a href="#">Support</a></li>
        </ul>
    </footer>
    <!-- footer start end-->
<?php   
}
?>

<?php
// scan all files and DirS
function grabFileAndDirectories($path){

    $files = scandir($path); // grabing all files in the directory
    $files = array_diff($files,array('.','..')); // removing extra dots
    return array_values($files); // returning a array of all directories and files
}   // end of grabFileAndDirectories()
// scan all files and DirS
?>

<?php
// Main Function
printTitle();
createForm();
$files= grabFileAndDirectories($currentPath); // calling a function to scanning all directories and files in current path and return
printListOfDirectoriesAndFiles($files); // show all directories and files on html page
extraGapToMakeSepareTheFooter();
printFooter();

// Main Function end
?>

<script src="jq.js"></script>

</body>
</html>