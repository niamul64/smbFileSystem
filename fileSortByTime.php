<?php
define("rootDir","/home/user/Documents/sharef"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST ['path'])){ // if the user clicks on the directory to go insidde 
        $nextDir = $_POST['path']; // grabbing path after root with the folder name which jus clicked
        
        $arrayToKeepFileWithSize= array();

        // scan all files and DirS and file 
        $filesAndDir = scandir(rootDir.$nextDir); // grabing all files in the directory
        $filesAndDir = array_diff($filesAndDir,array('.','..')); // removing extra dots
        // scan all files and DirS
        foreach ($filesAndDir as $eachFile){ 
            if (is_dir(rootDir.$nextDir.'/'.$eachFile )){ // if not dir
                continue;
             
            }else{
                $timeDate= date (filemtime(rootDir.$nextDir.'/'.$eachFile));
                array_push($arrayToKeepFileWithSize,array($timeDate,$eachFile));  
            }
        }
        rsort($arrayToKeepFileWithSize);

        foreach ($arrayToKeepFileWithSize as $eachFile){            
            ?> 
            <!-- each card -->

                <div id='fileShow' class="fileShowCard me-2 ms-2 m-1 float-start card col-12 col-xl-3 col-lg-4 col-md-5 col-sm-10" > 
                    <div class="card-body">
                        <h5 class="card-title cardTitleSelect"><?php echo $eachFile[1]; ?></h5>
                        
                        <?php
                        $fileSize=filesize(rootDir.$nextDir.'/'.$eachFile[1]);
                        $fileSize=$fileSize/1000000;
                        ?>
                        
                        <h6 class="card-subtitle mb-2 text-muted cardTitleSelect"><?php  echo number_format($fileSize,2,'.','').'MB';?></h6>
                        <p class="card-text">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-card-text" viewBox="0 0 16 16">
                                <path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h13zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-13z"/>
                                <path d="M3 5.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 8zm0 2.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </p>

                        <a class="deleteFile card-link text-dark " onclick="deletefile('<?php echo $nextDir; ?>','<?php echo $eachFile[1]; ?>' )"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
                            </svg>
                        </a> 
                        <a class="downloadFile card-link" href="index.php?downloadPath=<?php echo $nextDir; ?>&downloadFileName=<?php echo $eachFile[1]; ?> "> 
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

            <!-- each card end--> 
            <?php
        }        
    
    }

}
?>