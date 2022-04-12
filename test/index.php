<?php
define("rootDir","/home/user/Documents/sharef"); 




        $nextDir = '/abc2'; // grabbing path after root with the folder name which jus clicked
        
        $arrayToKeppFolderWithTime= [];

        // scan all files and DirS and file 
        $filesAndDir = scandir(rootDir.$nextDir); // grabing all files in the directory
        $filesAndDir = array_diff($files,array('.','..')); // removing extra dots
        // scan all files and DirS
        foreach ($filesAndDir as $eachDir){ 
            // if (is_dir(rootDir.$nextDir.'/'.$eachDir )){
                
            // }
        }
        echo ($filesAndDir[2]);



?>