
<?php session_start(); ?>
<?php require_once('connection.php'); ?>

<?php 
	

	$item_list = '';

	// getting the list of items

    $query = "SELECT * FROM products WHERE pPrice IS NOT NULL ORDER BY id";

	$items = mysqli_query($connection, $query);

	
		global $connection;

		if (!$items) {
			die("Database query failed: " . mysqli_error($connection));
		}


	while ($row = mysqli_fetch_assoc($items)) {
		$item_list .= "<tr class='vg'>";
		$item_list .= "<td>{$row['pName']}</td>";
		$item_list .= "<td>{$row['pPrice']}</td>";

		//Add to cart creating
		$item_list .= "<td><form action='products.php' method='POST'>";
        $item_list .= "<input type='number' name='qty' value=1 class='qtyInput'></td>";
        $item_list .= "<td><input type='hidden' name='item' value='{$row['pName']}'>";
        $item_list .= "<input type='hidden' name='price' value='{$row['pPrice']}'>";
        $item_list .= "<input type='submit' name='add' value='Add' class='addBtn'>";
        $item_list .="</form></td>";
        $item_list .= "</tr>";
	}

	// Add to Cart

    if(isset($_POST['add']))
    {
        if(!isset($_SESSION['cart']))
        {
            $_SESSION['cart'] =  array();
        }
    
        $item = array("item"=> $_POST['item'],"price"=> $_POST['price'],"qty"=> $_POST['qty']);
        $_SESSION['cart'][] = $item;

        header("Location: products.php");
        exit();

    }

 ?>


<?php 

    // Displaying the cart

     $cart_list = "";
     $Total = 0.00;

    if(isset($_SESSION['cart'])){
        foreach($_SESSION['cart'] as $index => $row)
        {
                $Total += $row['price'] * $row['qty'];

                $cart_list .= "<tr>";
                $cart_list .= "<td>" . ($index + 1) . "</td>";
                $cart_list .= "<td>{$row['item']}</td>";
                $cart_list .= "<td>{$row['price']}</td>";


                // Remove Button

                $cart_list .= "<form action='products.php' method='POST'>";
                $cart_list .= "<td><label>x {$row['qty']}</label>";
                $cart_list .= "<input type='hidden' name='index' value='{$index}'>";
                $cart_list .= "<input type='submit' name='remove' value='Remove' class='removeBtn'>";
                $cart_list .="</form></td>";
                $cart_list .= "</tr>";

        }
    }
    // Remove items from the cart

    if(isset($_POST['remove']))
    {
        $index = $_POST['index'];
        
        if(isset($_SESSION['cart'][ $index]))
        {
            unset($_SESSION['cart'][ $index ]);

            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }

        header("Location: products.php");
        exit();
    }

    //clear items in the array

    if(isset($_POST["clear"])){
        
        if(isset($_SESSION["cart"])){
            $_SESSION = array();
        }

        header("Location: products.php");
        exit();
    }

    if(isset($_POST["purchase"])){
    
        header("Location: printBill.php");
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styleProducts.css">
</head>
<body>
 
    <?php include 'header.php'; ?>

<div>
    <div><table class="masterlist">
			<tr>
				<th>Item Name</th>
				<th>Price</th>
                <th>Qunatity</th>
			</tr>

			<?php echo $item_list; ?>

		</table>
		
    </div>

	<div>

        <table class="masterlist2">

            <thead>
                <tr>
                    <th>Item No</th>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                </tr>
            </thead>

            <tbody>
                
                <?php echo $cart_list; ?>

                <tr>
                    <td colspan="3"></td>
                    <td> 
                        <?php echo "Total : ".$Total.".00"; ?> 
                        <form action="products.php"  method="POST">
                            <input type="submit" name='clear' value='Clear' class="refreshBtn">
                        </form>

                        <form action="products.php"  method="POST">
                            <input type="submit" name='purchase' value='Purchase' class="purchaseBtn">
                        </form>
                        
                    </td>

                    

                </tr>

            </tbody>



        </table>

    </div>
    
</div>


    <script src="script.js"></script>
</body>
</html>