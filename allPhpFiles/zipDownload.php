<?php
// all include files

include 'rootDir.php';
?>

<?php
// download zip file foe multifile download (temporary)
if (isset($_GET ['pathAfterRootFromMultiDownload'])){ 
    global $nextDir;
    $nextDir = $_GET['pathAfterRootFromMultiDownload']; // grabbing path after root with the folder name which jus clicked 
    $currentPath = rootDir.$nextDir; // making the full path
    $zipFileUrl=zipForMultiDownload.'/'."zipFile.zip";
    if (file_exists($zipFileUrl)){// checking: if file exists
        header('Content-Type: application/octet-stream');
        header("Content-Transfer-Encoding: Binary"); 
        header("Content-disposition: attachment; filename=\"" . basename($zipFileUrl) . "\""); 
        readfile($zipFileUrl);
        shell_exec('rm -rf ' . $zipFileUrl); 
        //unlink($zipFileUrl);
        header('Pragma: no-cache');

    }
}
// download zip file foe multifile download (temporary) End.
?>