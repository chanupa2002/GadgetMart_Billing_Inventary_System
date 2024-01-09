<?php

    require_once('connection.php');

    $errors = array();
	$user_id = '';
	$pName = '';
	$pPrice = '';

	if (isset($_GET['user_id'])) {
		// getting the user information
		$user_id = mysqli_real_escape_string($connection, $_GET['user_id']);
		$query = "SELECT * FROM products WHERE id = {$user_id} LIMIT 1";

		$result_set = mysqli_query($connection, $query);

		if ($result_set) {
			if (mysqli_num_rows($result_set) == 1) {
				// user found
				$result = mysqli_fetch_assoc($result_set);
				$pName = $result['pName'];
				$pPrice = $result['pPrice'];

			} else {
				// user not found
				header('Location: modifyItem.php?err=user_not_found');	
			}
		} else {
			// query unsuccessful
			header('Location: modifyItem.php?err=query_failed');
		}
	}

	if (isset($_POST['submit'])) {
		$pName = $_POST['pName'];
		$pPrice = $_POST['pPrice'];

		$result_set = mysqli_query($connection, $query);

		if (empty($errors)) {
			// no errors found... adding new record
			$pName = mysqli_real_escape_string($connection, $_POST['pName']);
			$pPrice = mysqli_real_escape_string($connection, $_POST['pPrice']);
			// email address is already sanitized

			$query = "UPDATE products SET ";
			$query .= "pName = '{$pName}', ";
			$query .= "pPrice = '{$pPrice}' ";
			$query .= "WHERE id = {$user_id} LIMIT 1";

			$result = mysqli_query($connection, $query);

			if ($result) {
				// query successful... redirecting to users page
				header('Location: edit.php?user_modified=true');
			} else {
				$errors[] = 'Failed to modify the record.';
			}

		}

	}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
<?php
if(isset($messages)){
    foreach($messages as $singleMessage){
        echo '<div class="message"><span>'.$singleMessage.'</span> <i class="fas fa-times" onclick="this.parentElement.style.display=\'none\';"></i></div>';
    }
}
?>

    <?php include 'header.php'; ?>

    <div class="container">
        <section>
        <form action="" method="post" class="add-product-form">
                <h3>Modify Product</h3>
                <input type="text" name="pName" <?php echo 'value="' . $pName . '"'; ?>class="box" >
                <input type="number" name="pPrice" <?php echo 'value="' . $pPrice . '"'; ?>class="box" >
                <input type="submit" value="Save" name="submit" class="btn">
            </form>
        </section>
    </div>



    <script src="script.js"></script>
</body>
</html>