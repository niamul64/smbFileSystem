<?php

include_once('smb.php');
include( 'smb://smbuser:@192.168.0.109/public files/');



$files = readfile("smb://smbuser:@192.168.0.109/public files/text.txt");
print $files;
 
?>