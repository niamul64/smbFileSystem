<?php
define("rootDir","/home/user/Documents/sharef"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST ['path'])){ // if the user clicks on the directory to go insidde 
        $nextDir = $_POST['path']; // grabbing path after root with the folder name which jus clicked
        
        $arrayToKeppFolderWithTime= array();

        // scan all files and DirS and file 
        $filesAndDir = scandir(rootDir.$nextDir); // grabing all files in the directory
        $filesAndDir = array_diff($filesAndDir,array('.','..')); // removing extra dots
        // scan all files and DirS
        foreach ($filesAndDir as $eachDir){ 
            if (is_dir(rootDir.$nextDir.'/'.$eachDir )){ // if dir
                $timeDate= date (filemtime(rootDir.$nextDir.'/'.$eachDir));
                array_push($arrayToKeppFolderWithTime,array($timeDate,$eachDir));               
            }
        }
        rsort($arrayToKeppFolderWithTime);
        $fileCountIndex = 0;
        foreach ($arrayToKeppFolderWithTime as $eachDir){
            $fileCountIndex += 1;
            ?> 

            <!-- each row -->
                <div class="border-bottom border-1 mb-2 row">
                    <div class="col-8"> <a class="folderId text-dark" href="index.php?go=<?php echo $nextDir.'/'.$eachDir[1]; ?> " ><?php echo "$fileCountIndex. "; echo $eachDir[1]; ?> </a> </div>
                    <div class="col-4"> <a class="folderDelete bg-info text-dark" onclick="deleteDir('<?php echo $nextDir; ?>','<?php echo $eachDir[1]; ?>' )">Delete</a> </div>
                </div>
            <!-- each row -->
                
            <?php
        }        
    }
}
?>