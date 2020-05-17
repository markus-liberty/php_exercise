<?php
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $order = $_POST['order-date'];
    $time = $_POST['order-time'];
    $total = $_POST['total'];
    $amount = $_POST['amount'];


    if(isset($_POST['Send'])){
        $to = $email; // this is your Email address
        $toadmin = "admin@example.com";
        $from = "reciept@example.com"; // this is the sender's Email address
        $subject = "Form submission";
        $subject2 = "Someone has ordered from your store, here are the details: ";
        $message = "Your Name: " . $name . "\nYour order date: " . $date . "\nYour reservation time:" . $time . "\nYour total number of products: " . $total . "\nYour total amount: " . $amount;
        $message2 = "His Name: " . $name . "His Email: " . $email . "His Address: " . $address . "\nHis order date: " . $date . "\nHis reservation time:" . $time;
    
        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        mail($toadmin,$subject2,$message2,$headers2); // sends a copy of the message to the sender
        echo "Mail Sent. Thank you " . $first_name . ", we will contact you shortly.";
    }

    $servername = "localhost";
    $username = "root";
    $password = "password";
    $dbname = "sample";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $sql = ("INSERT INTO orders (name, phone, email, address, orders, time, total, amount) VALUES ('".$name."', '".$phone."', '".$email."', '".$address."', '".$order."', '".$time."', '".$total."', '".$amount."')");
    
    if($conn->query($sql) === TRUE){
        echo "RECORD WAS DONE";
    }else{
        echo"SHIT";
    }
?>