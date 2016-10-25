<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>

<?php

$maindir = "Sports";

function listFolderFiles($dir){
    $array = scandir($dir);
    echo "<ol>";
    foreach($array as $item){
        if($item != '.' && $item != '..' && $item != '.DS_Store' && $item != "index.php" && $item != "php_form.php"){
            if(is_dir($dir.'/'.$item)){
            	echo "$item<br>";
            	listFolderFiles($dir.'/'.$item);
            } else {
            	echo "<a href='$dir/$item'>$item<br></a>";
            }
        }
    }
    echo "</ol>";
}

listFolderFiles($maindir);

?>

<a href="php_form.php">PHP Form</a>

</body>
</html>