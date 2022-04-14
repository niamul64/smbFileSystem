<?php
define("rootDir","smb://192.168.0.109/public%20files"); 




       // grabbing path after root with the folder name which jus clicked
        
    

        // scan all files and DirS and file 
        $filesAndDir = scandir("smb://192.168.0.109/public%20files"); // grabing all files in the directory
        
echo "hi";
print_r($filesAndDir);



?>