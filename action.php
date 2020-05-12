<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $order = $_POST['order'];
    $time = $_POST['order-time'];

    $email_from = 'yourname@yourwebsite.com';

	$email_subject = "New Form submission";

	$email_body = "You have received a new message from the user $name.\n".
                            "Here is the message:\n $phone $email $address $order $time".

    $to = $visitor_email.", apollomarko@zoho.com";

    $headers = "From: $email_from \r\n";
    
    $headers .= "Reply-To: $visitor_email \r\n";
    
    mail($to,$email_subject,$email_body,$headers);


    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "testing";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO orders (name, phone, email, address, date, time)
    VALUES ('$name', '$phone', '$email', '$address', '$date', '$time')";


?>