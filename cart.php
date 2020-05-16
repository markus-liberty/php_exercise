<?php 
session_start();
include('templates/header.php');
if(!empty($_SESSION["cart_item"])){
	$count = count($_SESSION["cart_item"]);
} else {
	$count = 0;
}
?>  	
<section class="showcase">
  <div class="container">
    <div class="pb-2 mt-4 mb-2 border-bottom">

    </div>
	<div class="row">
		<div id="shopping-cart">

		<?php
		if(isset($_SESSION["cart_item"])){
		    $total_quantity = 0;
		    $total_price = 0;
		?>	
		<table class="tbl-cart" cellpadding="10" cellspacing="1" id="cart">
		<thead>
			<tr>
				<th style="text-align:left;">Name</th>
				<th style="text-align:left;">SKU</th>
				<th style="text-align:right;" width="5%">Quantity</th>
				<th style="text-align:right;" width="10%">Unit Price</th>
				<th style="text-align:right;" width="10%">Price</th>
				<th style="text-align:center;" width="5%">Remove</th>
			</tr>	
		</thead>
		<tbody id="render-cart-data">
		<?php		
		    foreach ($_SESSION["cart_item"] as $item){
		        $item_price = $item["quantity"]*$item["price"];
				?>
					<tr id="<?php echo $item["sku"]; ?>">
						<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" style="margin:20px;width: 100px;height: 80px;"/><?php echo $item["name"]; ?></td>
						<td><?php echo $item["sku"]; ?></td>
						<td>
							<input type="number" name="quantity" min="1" step="1" pattern="\d+" data-sku="<?php echo $item["sku"]; ?>" data-price="<?php echo $item_price; ?>"class="field" value=<?php echo $item['quantity']; ?> /> 
							<input type="hidden" name="newValue" data-id="<?php echo $item["id"]; ?>" >
						</td>
						<td  style="text-align:right;"><?php echo "".$item["price"]; ?></td>
						<td  id="unit_price<?php echo $item["sku"]; ?>" data-unit="<?php "".number_format($item_price,2); ?>" style="text-align:right;"><?php echo "".number_format($item_price,0); ?></td>
						<td style="text-align:center;"><a data-sku="<?php echo $item["sku"]; ?>" class="text-danger btnRemoveAction"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					</tr>
					<?php
					$total_quantity += $item["quantity"];
					$total_price += ($item["price"]*$item["quantity"]);
				}
				?>
			
				<tr>
					<td colspan="2" align="right">Total:</td>
					<td align="right" data-tren="<?php echo $total_quantity; ?>" id="render-qty"><?php echo $total_quantity; ?></td>
					<td align="right" colspan="2" data-tot="<?php echo number_format($total_price, 0); ?>" id="render-total"><?php echo number_format($total_price, 0); ?></td>
					<td></td>
				</tr>
				</tbody>
			<tfoot>
				<tr>
					<td colspan="2"><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
					<td ></td>	
					<td colspan="3"><a href="order.php" class="btn btn-warning">Make Your Payment!</a><i class="fa fa-angle-right"></i</td>
				</tr>
			</tfoot>
		</table>		
		  <?php
		} else {
		?>
		<table class="tbl-cart" cellpadding="10" cellspacing="1">
			<tfoot>
				<tr>
					<td colspan="4"><div class="no-records">Your Cart is Empty</div></td>
				</tr>
				<tr>
					<td colspan="2"><a href="index.php" class="btn btn-warning"><i class="fa fa-angle-left"></i> Continue Shopping</a></td>
					<td></td>	
					<td></td>
				</tr>
			</tfoot>
		</table>
		<?php 
		}
		?>
		</div>
 </div>

</div>
</section>
<?php include('templates/footer.php');?> 

<script type="text/javascript">
	jQuery(document).on('click', 'a.btnRemoveAction', function() {
		var sku = jQuery(this).data('sku');
	    jQuery.ajax({
	        type:'POST',
	        url:'remove.php',
	        data:{sku:sku},
	        dataType:'json',               
	        success: function (json) {
	        	if(json.total_quantity) {
	            	jQuery('#cart-count').html(json.count);
	            	jQuery('#render-qty').html(json.total_quantity);
	            	jQuery('#render-total').html("$ "+json.total_price);
	            	jQuery("#"+sku).empty();
            	} else {
            		jQuery('#render-cart-data').empty();
            	}
            },
	        error: function (xhr, ajaxOptions, thrownError) {
	            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
	        }        
	    });
	});

	$(document).ready(function(){
		var q = jQuery(this).data('tren');
		var t = jQuery(this).data('tot');
        $('a[href^="order.php"]').each(function(){ 
            var oldUrl = $(this).attr("href").toString(); // Get current url
            var newUrl = oldUrl.replace("order.php", "order.php?q="+q+"&pr="+t); // Create new url
            $(this).attr("href", newUrl); // Set herf value
        });
    });

	$(document).ready(function() { 
            $(".field").change(function() { 
				var total_price= 0;
				var total_quantity = 0
				var table_rows = $('table > tbody  > tr');

				for(var i=0; i< table_rows.length-1 ; i++){
					var row_data = $(table_rows[i]).find('td');
					var q= $(row_data[2]).find("input")[0].value;
					var unit_price = row_data[3].textContent;
					var p = row_data[4].textContent;
					total_quantity += parseInt(q)
					row_price = parseInt(unit_price)*parseInt(q);
					temp_sku =  row_data[1].textContent;
					jQuery('#unit_price'+temp_sku).html(row_price);
					total_price += row_price ;

				}

				
				jQuery('#render-qty').html(total_quantity);
				jQuery('#render-total').html(total_price);
					
				console.log(total_price)		
			
				var qty = jQuery(this)[0].value;
				console.log("HERE")
				console.log(qty);
				console.log("NO")

				var sku = jQuery(this).data('sku');
				console.log(sku)
				
				var item_id = jQuery(this).data('id');
				console.log(item_id)
				
				
					$('a[href^="order.php"]').each(function(){ 
						var oldUrl = $(this).attr("href").toString(); // Get current url
						oldUrl = oldUrl.substring(0, oldUrl.indexOf('?'));
						var newUrl = oldUrl.replace("order.php", "order.php?q="+total_quantity+"&pr="+total_price); // Create new url
						$(this).attr("href", newUrl); // Set herf value
					});
				

			jQuery.ajax({
				type:'POST',
				url:'addnew.php',
				data:{product_id:item_id, quantity:qty, sku:sku},
				dataType:'json',    
				beforeSend: function () {
					jQuery('button#product-'+item_id).button('loading');
				},
				complete: function () {
					jQuery('button#product-'+item_id).button('reset');
				},                
				success: function (json) {
					jQuery('#cart-count').html(json.count);
					jQuery("#add-item-bag").html('<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>Success!</strong> You have added  to your shopping cart!</div>');
				},
				error: function (xhr, ajaxOptions, thrownError) {
					console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}        
			});
		}); 
    }); 
</script>
