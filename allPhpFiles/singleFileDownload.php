<?php
// all include files

include 'rootDir.php';
?>

<?php

    global $nextDir;
    $nextDir = $_GET['downloadPath']; // for keeping the file path after root path
    $currentPath = rootDir.$nextDir; // the full file path
    $folderNameThatWeWantToDownload= $_GET['downloadFileName']; // grabbing the file name which we want to download
    $file_url = $currentPath.'/'.$folderNameThatWeWantToDownload;
    // deleting process
    if (file_exists($file_url)){// checking: if file exists
        ob_end_clean();
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($folderNameThatWeWantToDownload) . "\""); 
        readfile($file_url);
        exit;
         
    }

?>
