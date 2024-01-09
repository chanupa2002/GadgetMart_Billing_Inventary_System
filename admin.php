<?php

    require_once('connection.php');

    if (isset($_POST['addProduct'])) {
            
        $pName = $_POST['productName'];
        $pPrice = $_POST['productPrice'];

            $pName = mysqli_real_escape_string($connection, $_POST['productName']);
            $pPrice = mysqli_real_escape_string($connection, $_POST['productPrice']);

            $query = "INSERT INTO products ( ";
            $query .= "pName, pPrice";
            $query .= ") VALUES (";
            $query .= "'{$pName}', '{$pPrice}'";
            $query .= ")";

            $result = mysqli_query($connection, $query);

    
            if ($result) {
                // query successful... redirecting to users page
                header('Location: admin.php?user_added=true');
                $message[] = 'Product added Successfully !';
            } else {
                echo "Failed to add the new product ! ";
                $message[] = 'Failed to add the new product ! ';
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
                <h3>Add a new Product</h3>
                <input type="text" name="productName" placeholder="Product name" class="box" required>
                <input type="number" name="productPrice" min="0"placeholder="Product Price" class="box" required>
                <input type="submit" value="Add the product" name="addProduct" class="btn">
            </form>
        </section>
    </div>



    <script src="script.js"></script>
</body>
</html>