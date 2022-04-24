<?php
// all include files

include 'rootDir.php';
?>

<?php
$zip_file= "/home/user/Documents".'/'."zipFile.zip"; // zip file creating location

$zip = new ZipArchive(); // zip file obj
$zip->open($zip_file, ZipArchive::CREATE | ZipArchive::OVERWRITE); // crating zip file


if ($_SERVER["REQUEST_METHOD"] == "GET") {
     
    $fileNames = $_GET['fileNames']; // file names to download
    $pathAfterRoot = $_GET['downloadPath']; 
    


    foreach ($fileNames as $file) {
        $zip->addFile(rootDir.'/'.$pathAfterRoot.'/'.$file, $file );
    }
    $zip->close();
    // $zipFileUrl=$zip_file;

    // if (file_exists($zipFileUrl)){// checking: if file exists
    //     header('Content-Type: application/octet-stream');
    //     header("Content-Transfer-Encoding: Binary"); 
    //     header("Content-disposition: attachment; filename=\"" . basename($zipFileUrl) . "\""); 
    //     readfile($zipFileUrl); 
    // }
}

?>
