
<?php session_start(); ?>
<?php require_once('connection.php'); ?>


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
                $cart_list .= "<form action='printBill.php' method='POST'>";
                $cart_list .= "<td><label>x {$row['qty']}</label>";
                $cart_list .= "<input type='hidden' name='index' value='{$index}'>";
                $cart_list .="</form></td>";
                $cart_list .= "</tr>";

        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="styleprintBill.css">
</head>
<body>
 
    <header class="header">
        <div class="flex">
            <a href="#" class="logo">CA Gadget Mart</a>
        </div>

        <nav class="navbar">

        </nav>

    </header>

<main class="billArea">

    <h1 class="billH">CA Gadget Mart</h1>

    <div>
        <form action="" method="post" class="detailsForm">
                <p class="nameLb"> Name : <input type="text" name="name" placeholder="Type Customer name" class="name" required></p>
                <p class="dateLb"> Date : <input type="date" name="date" min="0"placeholder="Date" class="date" required></p>
        </form>
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
                    </td>
                </tr>
            </tbody>

        </table>
    </div>

    <p class="thankingMsg">Thank you come Again ! </p>

</main>

    <div>
        <form action="/action_page.php" method="get" class="buts">
            <div><button type="submit" formaction="products.php" class = "backBtn">Back</button></div>
            <div><button type="submit" id="print" formaction="products.php" class="printBtn">Print</button></div>
        </form>
    </div>


    <script src="script.js"></script>
</body>
</html>