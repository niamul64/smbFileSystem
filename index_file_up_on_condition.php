<?php
define("rootDir","/home/user/Documents/sharef"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['tmp'])){

        $tmp=$_POST['tmp'];
        $value =move_uploaded_file($tmp,rootDir.$_POST['path'].'/'. $_POST["fileName"]);
        echo $_POST["path"];
    }
}

?>