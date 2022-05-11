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

<?php
        // header('Pragma: no-cache');
        // header ("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        // header('Content-Type: application/octet-stream');
        // header("Content-Type: " . mime_content_type($file_url));
        // header("Content-Type: application/force-download");
        // header("Content-Transfer-Encoding: Binary"); 
        // header("Content-length: ".filesize($file_url));
        // header("Content-disposition: attachment; filename=\"" . basename($folderNameThatWeWantToDownload) . "\""); 
        // header("Content-disposition: attachment; filename=\"" . basename($folderNameThatWeWantToDownload) . "\""); 
        // header("Content-disposition: attachment; filename=".$folderNameThatWeWantToDownload); 
        // flush();
        // readfile($file_url); 


        // header('Content-Description: File Transfer');
        // header('Content-Type: application/octet-stream');
        // header("Content-disposition: attachment; filename=\"" . basename($folderNameThatWeWantToDownload) . "\""); 
        // header('Expires: 0');
        // header('Cache-Control: must-revalidate');
        // header('Pragma: public');
        // header('Content-Length: ' . filesize($file_url));
        // flush(); // Flush system output buffer
        // readfile($file_url);
        // die();
?>