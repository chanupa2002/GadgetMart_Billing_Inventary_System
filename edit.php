
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
        $item_list .= "<td><a href=\"modifyItem.php?user_id={$row['id']}\">Edit</a></td>";
		$item_list .= "<td><a href=\"deleteItem.php?user_id={$row['id']}\" 
						onclick=\"return confirm('Are you sure?');\">Delete</a></td>";
        $item_list .= "</tr>";
	}

 ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styleEdit.css">
</head>
<body>
 
    <?php include 'header.php'; ?>


    <div><table class="masterlist">
			<tr>
				<th>Item Name</th>
				<th>Price</th>
			</tr>

			<?php echo $item_list; ?>

		</table>
		
    </div>


    <script src="script.js"></script>
</body>
</html>