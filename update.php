<?php
	session_start();
	$json = array();
	$total_quantity = 0;
	$total_price = 0;
    $count = 0;
    
    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "sample";

    $sku = $_POST["sku"];

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

	if(!empty($_SESSION["cart_item"]) && count($_SESSION["cart_item"])>0) {
        $sql = "SELECT price FROM products WHERE sku='$sku'";
        if($result = $conn->query($sql)){
            $f_result = mysqli_fetch_assoc($result);
            $unit_price =  number_format($f_result["price"], 2);
            $price = $_POST["quantity"] * $unit_price;
            $json['price'] = $price;
        }else{
            $json['price'] = "Error!";
        }
        
		
		
	}
	header('Content-Type: application/json');
	echo json_encode($json);		
	?>
