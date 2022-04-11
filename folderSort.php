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
                echo ($eachDir);
                echo date ("F d Y H:i:s.", filemtime(rootDir.$nextDir.'/'.$eachDir));

                
            }
        }
        
    }
}
?>