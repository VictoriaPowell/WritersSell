<?php session_start(); ?>
<html>
	<head>
		<title>Cart</title>
		<style type="text/css">
			body { background-color: #fafca7; }
		</style>
	</head>
	<body>
	
	<?php 
	
		if(!isset($_SESSION['cart'])) // if cart doesn't exist
		{	
			$items_array = array(); // creates a new array to store items
			$_SESSION['cart'] = $items_array;
		}else{ //else retrieve past cart and store it in another variable
			$items_array = $_SESSION['cart'];
		}
	
		if(isset($_GET['itemid'])) // enters if query string has an item ID
		{
			$itemid = $_GET['itemid'];	// gets the item ID 

			if($itemid == '1')
			{
				$name = "No More";
				$price = 5;
			}
			if($itemid == '2')
			{
				$name = "Later Z";
				$price = 6;
			}
			if($itemid == '3')
			{
				$name = "Where I watch";
				$price = 2;
			}
			if($itemid == '4')
			{
				$name = "Pre Calculus";
				$price = 15;
			}
			
			if(!isset($items_array[$itemid]))
			{				
				$items_array[$itemid] = $itemid . "#" . $name . "#" . $price . "#1";
			}else{				
				$split = explode("#", $items_array[$itemid]);
				$split[3] = $split[3] + 1;
				$items_array[$itemid] = implode("#",$split);
			} 
			$_SESSION['cart'] = $items_array; // updates the session array
		}
		$total = 0;
		echo "<table width='100%' border='1' style='border:#5C01FE solid'>";
		echo "<tr border='1' style='border:#5C01FE solid'><th border='1' style='border:#5C01FE solid'>Item Number</th><th border='1' style='border:#5C01FE solid'>Item Name</th><th border='1' style='border:#5C01FE solid'>Qty.</th><th border='1' style='border:#5C01FE solid'>Item Price ($)</th></tr>";
		for($count=count($items_array);$count>=0;$count--)// loops through the array of all the items
		{
			if(isset($_SESSION['cart'][$count]))
			{
				$item_details = explode("#",$_SESSION['cart'][$count]);//splits the item information up
				
				// Print out a row for each item in the cart
				echo "<tr>";
				echo "<td>id: " . $item_details[0] . "</td>";
				echo "<td>" . $item_details[1] . "</td>";
				echo "<td>" . $item_details[3] . "</td>";
				echo "<td>$" . $item_details[3] * $item_details[2] . "</td>";
				echo "</tr>";
				
				$total += $item_details[3] * $item_details[2];	// Add item price to the total
			}
		}
		echo "<tr><td colspan='3' align='right'>Total:</td><td>$$total</td></tr>";
		echo "<table>";
		
		if ( isset ( $_GET['session_destroy'] ) && $_GET['session_destroy'] ==true ) {
			session_destroy();
		}
	?>
	
	<a href="../index.html">Continue Shopping</a>
	<br />
	<a href="<?php echo ( $_SERVER['PHP_SELF'] );?>?session_destroy=true">Clear Your Cart</a>
	<br />
	<a href="http://writerssell.com/account/checkout/">Go to Checkout</a>
	</body>
</html>