<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Document</title>
</head>
<body>
    
    <?php 
    $nextDir='';
    if (isset($_GET ['name'])){ // if the user clicks on the directory to go insidde 
        global $nextDir;
        $nextDir = $_GET['name']; // grabbing path after root with the folder name which jus clicked 
    }
    else{
        echo "no get";
    }
    
    ?>


<h1> <?php echo "my name is: ". $nextDir;?></h1>
<script src="/testAjax/js.js"></script>
</body>
</html>