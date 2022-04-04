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
    
<!-- container-fluid class start -->
    <div class="container-fluid"> 
        <main>
            <div class=" text-center">
            <h2>File Explorer</h2>
            
            </div>
        </main>

<!-- form start -->
        <div class="border p-1 container-xl">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>" enctype="multipart/form-data">
                <p class="p-1 d-flex justify-content-center bg-white text-dark">Create directory/file or upload a file in the current path:</p>
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

<!-- main body start -->
        <div class="container mt-4"> 
            <div class="row">
<!-- folder show start -->               
                <div class="col-sm-5 border  border-5">

                    <!-- back button start -->
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <input type="text" name="backButton" value="<?php echo $nextDir; ?>" hidden>
                        <input type="text" name="path" value="<?php echo $nextDir; ?>" hidden>
                        <input id='backButton' class="mt-2 btn btn-dark" type="submit" value='<<Back'>  <br> <!-- make directory name submission -->
                    </form>
                    <!-- back button end -->

                    <p class="mt-1">Current Path: Root/</p> <!-- show current path -->

                    <p><b>Directories/Folders:</b></p>

                </div>
<!-- folder show end -->

<!-- file show start -->
                <div class="col-sm-7">
                <p class="p-1 d-flex justify-content-center bg-white text-dark">Create directory/file or upload a file in the current path:</p>
                </div>
<!-- file show start -->

            </div>
        </div>
<!-- main body end -->


    </div>
<!-- container-fluid class end-->


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
   
    
    <script src="script.js"></script>
</body>
</html>