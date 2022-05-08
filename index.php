<?php
// error log 
// ini_set('display_errors', 1);
// ini_set('log_errors',1);
// ini_set('error_log', dirname(__FILE__).'ErrorLog.txt');
// error_reporting(E_ALL);
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="jsCssFiles/style.css">
    
    <!-- icons CDN -->

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <title>File Explorer</title>
 
</head>
<body>
<body class="bg-light">

<?php
// all include files

include 'rootDir.php';
?>

<?php
// all global variables
$nextDir=''; // variable to keep the path after root directory
$currentPath=rootDir; // variable to keep full path
$messageShow=''; // keep all kind of message to show on alert
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
if (isset($_GET ['reloadPath'])){ 
    global $nextDir;
    $nextDir = $_GET['reloadPath']; // grabbing path after root with the folder name which jus clicked 
    $currentPath = rootDir.$nextDir; // making the full path
}
//all get request End
?>

<?php
// download zip file foe multifile download (temporary)
if (isset($_GET ['pathAfterRootFromMultiDownload'])){ 
    global $nextDir;
    $nextDir = $_GET['pathAfterRootFromMultiDownload']; // grabbing path after root with the folder name which jus clicked 
    $currentPath = rootDir.$nextDir; // making the full path
    $zipFileUrl=zipForMultiDownload.'/'."zipFile.zip";
    if (file_exists($zipFileUrl)){// checking: if file exists
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($zipFileUrl) . "\""); 
        readfile($zipFileUrl);
        shell_exec('rm -rf ' . $zipFileUrl); 
        //unlink($zipFileUrl);
        header('Pragma: no-cache');
    }
}
// download zip file foe multifile download (temporary) End.
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


if ($_SERVER["REQUEST_METHOD"] == "POST") { // back button
    global $nextDir, $currentPath;
    
   
    $nextDir = $_POST['path']; // grabbing path after root path
    $currentPath = rootDir.$nextDir;

    $backButton=$_POST['backButton'];
    if ($backButton){
   
        $splitPath = explode("/",$nextDir);
        array_pop($splitPath); // to go back we need to remove the name of last Dir
        unset($splitPath[0]); // nothing in the 0th index
        $nextDir='';
        foreach ($splitPath as $path){
            $nextDir = $nextDir.'/'.$path; // creatring path after root
        }
        $currentPath = rootDir.$nextDir; // total path
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
            
                <p class="p-1 d-flex justify-content-center bg-white text-dark">Create Directory/File Or Upload A File in The Current Path</p>
                <div class="row m-1 ">
                    <div class="col-sm-7 border">
                    <form id="submit_form" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="input-group">
                            <input type="text" name="folderName" placeholder="Directory Name"><br> 
                        </div>
                        
                        <div class="input-group mt-1">
                            <input type="text" name="fileName" class="" placeholder="File Name" >
                            <span class="bg-white ms-2 me-2 ps-2 pe-2"><b> . </b> </span>
                            <input type="text" name="fileExtension" class="" placeholder="Extension" >
                        </div>
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                        <input id="submitButton" class="mt-2  btn btn-secondary" type="submit" value="Submit"><!-- submission -->
                    </form>

                    </div>
                    
                    <div class="col-sm-5 border">
                    <form id="submit_form2" method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                        <label class="pt-1" for="fileToUpload">To upload any external file to current directory:</label>
                        <br><input class="mt-1" type="file" name="fileToUpload" id="fileToUpload">
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                        <br> <input id="submitButton2" class="mt-2 btn btn-secondary" type="submit" value="Submit"><!-- submission -->
                    </form>
                   
                    </div>

                </div>
            
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
        <div class="container mt-1 mb-5"> 
            <div class="row">
<!-- folder show start -->               
                <div class="col-sm-4 border  border-5">
                    
<!-- select sorting option for folders start-->
                    <div class="container-fluid" > 
                        <div class="row justify-content-md-center" >
                            <select id="select1" class="form-select">
                                <option value="1">Sort By Alphabetical Order</option>
                                <option value="2">Sort By Creation time</option>
                            </select>
                        </div>
                    </div>
<!-- select sorting option for folders end-->

                    <!-- back button start -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <input type="text" name="backButton" value="<?php echo $nextDir; ?>" hidden>
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                        <input id='backButton' class="mt-2 btn btn-dark" type="submit" value='<<Back'>  <!-- make directory name submission -->
                    </form>
                    <!-- back button end -->

                    <p  class="mt-1">Current Path: <span id="currentPath">Root/<?php echo $nextDir; ?></span> </p> <!-- show current path -->
                    
                    <!-- button to: on click go to root directory -->
                    <a id="gotoHome" class="p-1 bg-info text-dark" href="index.php?go=" > <?php echo 'Goto Home Directory'; ?> </a> 
                    
                    <p><b>Directories/Folders:</b></p>

                    <?php $fileCountIndex= 0; // count index  for folders and files  ?>

<!-- folder name and delete button start-->
                    <div id='dirPrintUnderThisTag' class="">
            <?php

            foreach ($listOfFilesAndDirectories as $eachFile){

            if (is_dir($currentPath.'/'.$eachFile)){
            $fileCountIndex += 1;
            ?> 

                    <!-- each row -->
                        <div class="border-bottom border-1 mb-2 row">
                            <div class="col-8"> <a class="folderId text-dark" href="index.php?go=<?php echo $nextDir.'/'.$eachFile; ?> " ><?php echo "$fileCountIndex. "; echo $eachFile; ?> </a> </div>
                            <div class="col-4"> <a class="folderDelete bg-info text-dark" onclick="deleteDir('<?php echo $nextDir; ?>','<?php echo $eachFile; ?>' )">Delete</a> </div>
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
                <div class="col-sm-8 " id='fileCardJsTriger'>
                    
                    <p class="pt-1 d-flex justify-content-center bg-white text-dark">All files in the current path</p>

<!-- select sorting option for files -->
                    <div class="container-fluid" > 
                        <div class="row justify-content-md-center bg-white text-dark" >
                            <!-- button group for mark, unmark, delete, download files -->
                            <div class="mb-1 mt-1 col-lg-7  ">
                                <button id="markAll" type="button" class="">Mark All</button>
                                <button id="unmarkAll" type="button" class="">Unmark All</button>
                                <button id="downloadAllSelectedFlle" type="button" class="">Download</button>
                                <button id="deleteAllSelectedFiles" type="button" class="">Delete</button>
                                <button id="searchFile" type="button" class="">Search</button>
                            </div>

                            <select id="select2" class="col-lg-5 mb-1 mt-1" >
                                <option value="1">Sort By Alphabetical Order</option>
                                <option value="2">Sort By Creation Time</option>
                                <option value="3">Sort By File Size</option>
                            </select>
                        </div>
                    </div>
<!-- select sorting option for files end  -->

<!-- files card start -->
                    <div class="container-fluid">

<!-- loding icon show  -->
                        <div id='loadingIcon' class="text-center m-5 d-none"> 
                            Please Wait..
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden lodingWidth">Loading...</span>
                            </div>
                            Processing files to download 
                        </div>
                        <div id='loadingIconForSearching' class="text-center m-5 d-none"> 
                            Please Wait..
                            <div class="spinner-border" role="status">
                                <span class="visually-hidden lodingWidth">Searching...</span>
                            </div>
                        </div>
<!-- loding icon show  -->

                        <div id='filePrintUnderThisTag' class="row justify-content-md-center">

                        <?php
                        foreach ($onlyFiles as $eachFile){ // loop to show all files, not directories 
                          
       
                        ?> 
                        <!-- each file start -->
                            <div id='fileShow'  class="fileShowCard me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" data-filename='<?php echo $eachFile; ?>'> 
                                <div class="card-body">
                                    <h5 class="card-title cardTitleSelect"><?php echo $eachFile; ?></h5>
                                    
                                    <?php
                                    $fileSize=filesize($currentPath.'/'.$eachFile);
                                    $fileSize=$fileSize/1000000;
                                    ?>
                                    <p class="card-subtitle mb-2 text-muted cardTitleSelect"><?php  echo number_format($fileSize,2,'.','').'MB';?></p>
                                    
                                    <p class="card-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </p>

                                    <a class="deleteFile card-link text-dark " onclick="deletefile('<?php echo $nextDir; ?>','<?php echo $eachFile; ?>' )"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                            <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                                        </svg>
                                    </a> 
                                    <a class="downloadFile card-link" href="index.php?downloadPath=<?php echo $nextDir; ?>&downloadFileName=<?php echo $eachFile; ?> "> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cloud-download" viewBox="0 0 16 16">
                                            <path d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path d="M7.646 15.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 14.293V5.5a.5.5 0 0 0-1 0v8.793l-2.146-2.147a.5.5 0 0 0-.708.708l3 3z"/>
                                        </svg>
                                    </a> 
                                    <a class="renameIcon card-link" onclick="renameFile('<?php echo $nextDir; ?>','<?php echo $eachFile; ?>' )"> 
                                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
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
        <p class="mb-1">&copy; 2005–2022 Brotecs Technologies Limited</p>
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