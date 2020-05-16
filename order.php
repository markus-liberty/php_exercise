<?php 
session_start();
include('templates/header.php');
if(!empty($_SESSION["cart_item"])){
	$count = count($_SESSION["cart_item"]);
} else {
	$count = 0;
}

$total = $_REQUEST['q'];
$price = $_REQUEST['pr']
?>  


<form action="action.php" method="post">
            <label for="name">Total Products:</label><br>
			<input type="text" id="total" name="total" value="<?php echo $total; ?>"readonly><br>
            <label for="name">Total Amount:</label><br>
			<input type="text" id="amount" name="amount" value="<?php echo $price; ?>" readonly><br>
		    <label for="name">Name:</label><br>
			<input type="text" id="name" name="name"><br>
			<label for="phone">Phone:</label><br>
			<input type="text" id="phone" name="phone">
			<label for="email">Email:</label><br>
			<input type="email" name="email" id="email">
			<label for="address">Address:</label><br>
			<input type="text" id="address" name="address">
			<label for="date">Delivery Date:</label><br>
			<input type="date" id="order" name="order-date" value=<?php echo date('y-m-d');?> min="<?php ?>"><br>
			<label for="time">Delivery Time:</label><br>
			<input type="time" name="order-time" min="07:00" max="21:00" step="600"><br>
			<input type="submit" value="Send" style="margin-top:20px;">
		</form>

        <?php include('templates/footer.php');?> 