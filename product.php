<?php 
session_start();
include('templates/header.php');
if(!empty($_SESSION["cart_item"])){
	$count = count($_SESSION["cart_item"]);
} else {
	$count = 0;
}

$i = $_REQUEST['i'];
?>


<div id="product-grid">
	<?php
	$db = new mysqli('localhost', 'root', 'password', 'sample');
	$sql = "SELECT * FROM products WHERE id=$i";
	if($result = $db->query($sql)){
		while ($row = mysqli_fetch_assoc($result)) {
	?>
		<div class="box">  
    		<a href="#" class="image fit">
				<img src="<?php echo $row["image"];?>" alt="" /></a>  
			<div class="inner">  
				<h3><?php echo $row["name"]; ?></h3>  
   				<p><?php echo $row["description"]; ?></p> 
				<input type="number" class="product-quantity" id="qty-<?php echo $row["id"]; ?>" name="quantity" value="1" size="2" />
				<button type="button" class="btnAddAction" data-itemid="<?php echo $row["id"]; ?>" id="product-<?php echo $row["id"]; ?>" data-action="action" data-sku="<?php echo $product_array[$key]["sku"]; ?>" data-proname="<?php echo $product_array[$key]["sku"]; ?>"> Add to Cart</button>
			</div>  
		</div> 
	<?php
		}
	}
	?>
</div>

<?php include('templates/footer.php');?> 