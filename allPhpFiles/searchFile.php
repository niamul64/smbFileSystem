<?php
// all include files

include 'rootDir.php';
?>

<?php 
$exactMatch=array();
$relativeMatch=array();
$onlyExtentionMatch= array();
?>


<?php
function searchfiles($folder){
    global $exactMatch, $relativeMatch;
    $fileName= $_POST['fileName']; // file name entered by the user
    
    $filesAndDir = scandir($folder);
    $filesAndDir = array_diff($filesAndDir,array('.','..')); // removing extra dots
    foreach ($filesAndDir as $eachFile){ 
        if (!(is_dir($folder.'/'.$eachFile))){ // it is not folder  
            $splitString=explode(".",$fileName); // file extention separate
            $extention='';
            $fileNamePattern="/".$fileName."/i";
            if (count($splitString)){
                $extention= $splitString[count($splitString)-1]; // file extention grab
            }
            if ($fileName== $eachFile){ // if exactly match with input
                $fileSize=filesize($folder.'/'.$eachFile);
                array_push($exactMatch,array($fileSize,$eachFile,$folder));  
            }
            else if(preg_match($fileNamePattern, $eachFile)){
                $fileSize=filesize($folder.'/'.$eachFile);
                array_push($relativeMatch,array($fileSize,$eachFile,$folder)); 
            }
        }
        else{
            searchfiles($folder.'/'.$eachFile);// if it is dir then recursive call
        }
    }
}
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    
    $nextDir = $_POST['path']; // grabbing path after root with the folder name which jus clicked

    // calling recursive function 
    searchfiles(rootDir.$nextDir);

    $folderPath=''; // will keep current file path 
    
    if (count($exactMatch)){
        echo '<h4>Exact match:</h4>';
        foreach ($exactMatch as $eachFile){ // making each file as a card
            $tempParhAfterRoot= substr($eachFile[2], strlen(rootDir)); // remove the root path from file path
            if($tempParhAfterRoot!=$folderPath){
                $folderPath=$tempParhAfterRoot;
            }
    ?>
    <!-- each file start -->
    <div id='fileShow'  class="fileShowCard me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" > 
                        
                    <div class="badge badge-primary text-wrap text-dark col-12" >
                    Path:Root<?php  echo $folderPath;?>
                    </div>
                                    <div class="card-body">
                                        <h5 class="card-title cardTitleSelect"><?php echo $eachFile[1]; ?></h5>

                                        <p class="card-subtitle mb-2 text-muted cardTitleSelect"><?php  echo number_format($eachFile[0],2,'.','').'MB';?></p>
                                        <p class="card-text">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                            </svg>
                                        </p>
                                    </div>
                                </div>
                                <!-- each file end -->

    <?php // if and for loop ends
        }
    }
        ?>
    
    <?php
    if (count($relativeMatch)>0){

        echo '<h5>Relative match:</h5>';
        foreach ($relativeMatch as $eachFile){ // making each file as a card
            $tempParhAfterRoot= substr($eachFile[2], strlen(rootDir)); // remove the root path from file path
            if($tempParhAfterRoot!=$folderPath){
                $folderPath=$tempParhAfterRoot;
            }
            
            ?>
             <!-- each file start -->
             <div id='fileShow'  class="fileShowCard me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" > 
                <div class="badge badge-primary text-wrap text-dark col-12" >
                Path:Root<?php  echo $folderPath;?>
                </div>
             
                                            <div class="card-body">
                                                <h5 class="card-title cardTitleSelect"><?php echo $eachFile[1]; ?></h5>
                                                                          
                                                <p class="card-subtitle mb-2 text-muted cardTitleSelect"><?php  echo number_format($eachFile[0],2,'.','').'MB';?></p>
                                                <p class="card-text">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                                        <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                                        <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                                                    </svg>
                                                </p>

                                            </div>
                                        </div>
                                        <!-- each file end -->
            
            <?php // if and for loop ends
                }
            }
                ?>
                
                <?php

}
?>