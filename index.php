<?php
session_start();

$db = new mysqli('localhost', 'root', 'password', 'testing');

if($db-> conect_errno > 0)
    die('Unable to connect' . $db -> connect_error);
else
    echo "You are fine";

$sql = "INSERT INTO 'products'('name', 'image', 'price') VALUES('game', '13212.jpg', '23');";

if($db->query($sql) === TRUE){
    echo "RECORD WAS DONE";
}else{
    echo $db->connect_error;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

</body>
</html>