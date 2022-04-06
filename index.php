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
//all get request

//all get request End
?>
<?php
//all get post request

//all get post request End
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
                    <br> <input class="mt-2  btn btn-secondary" type="submit" value="Submit"><!-- submission -->
                </div>
                
             
            </form>
        
        </div>
<!-- form end -->

<hr class='bg-success'>

<?php 
}
?>

<?php
function printListOfDirectoriesAndFiles($files){
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
                        <input id='backButton' class="mt-2 btn btn-dark" type="submit" value='<<Back'>  <br> <!-- make directory name submission -->
                    </form>
                    <!-- back button end -->

                    <p class="mt-1">Current Path: Root/<?php echo $nextDir; ?> </p> <!-- show current path -->
                    
                    <!-- button to: on click go to root directory -->
                    <a class="p-1 bg-info text-dark" href="index.php?go=" > <?php echo 'Goto Home Directory'; ?> </a> 
                    
                    <p><b>Directories/Folders:</b></p>

<!-- folder name and delete button start-->
                    <div class="">
                    
                    <!-- each row -->
                        <div class="border-bottom border-1 mb-2 row">
                            <div class="col-8"> <a class="text-dark" href="">folder 0</a> </div>
                            <div class="col-4"> <a class="bg-info text-dark" href="">Delete</a> </div>
                        </div>
                        
                    
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

                            <div class="me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" >
                                <div class="card-body">
                                    <h5 class="card-title">text.txt</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">size: 5KB</h6>
                                    <p class="card-text">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                            <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                            <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                        </svg>
                                    </p>
                                    <a href="#" class="card-link">edit</a>
                                    <a href="#" class="card-link">delete</a>
                                </div>
                            </div>
                            
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

    
    <script src="script.js"></script>
</body>
</html>