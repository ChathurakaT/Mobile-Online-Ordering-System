<?php
include("connection/connect.php");
error_reporting(0);
session_start();

$product_name = isset($_GET['product_name']) ? mysqli_real_escape_string($db, $_GET['product_name']) : '';

$query = "
    SELECT 
        shop.title AS shop_name, 
        shop.address, 
        product.img AS product_image,
        product.title AS product_name, 
        product.price, 
        product.description 
    FROM 
        product 
    INNER JOIN 
        shop 
    ON 
        product.rs_id = shop.rs_id 
    WHERE 
        product.title = '$product_name'";


$result = mysqli_query($db, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    echo "Product not found.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <style>
    /* Product Details Section */
    .product-container {
    max-width: 1200px;
    margin: 100px auto 30px; /* Added top margin for space below the navbar */
    background: #ffffff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}


    .product-container h1 {
        text-align: center;
        color: #2c3e50;
        font-family: 'Poppins', sans-serif;
        font-size: 28px;
        margin-bottom: 20px;
    }

    .product-details {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        margin-top: 20px;
    }

    .product-details img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .product-details-text {
        flex: 2;
        padding: 20px;
    }

    .product-details-text p {
        font-size: 18px;
        color: #555;
        line-height: 1.6;
        font-family: 'Roboto', sans-serif;
    }

    .product-details-text p strong {
        color: #34495e;
    }

    .back-to-shops-btn {
        display: inline-block;
        text-decoration: none;
        background-color: #28a745;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        font-size: 16px;
        transition: background-color 0.3s ease;
        margin-top: 30px;
    }

    .back-to-shops-btn:hover {
        background-color: #218838;
    }

/* Shopping Cart Section */
.widget.widget-cart {
    background: #ffffff;
    margin: 30px auto;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.widget-heading {
    border-bottom: 2px solid #f1f1f1;
    margin-bottom: 15px;
}

.widget-title {
    font-size: 20px;
    font-family: 'Poppins', sans-serif;
    margin: 0;
}

.title-row {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

.title-row a i {
    color: #e74c3c;
    cursor: pointer;
    transition: color 0.3s;
}

.title-row a i:hover {
    color: #c0392b;
}

.form-group.row.no-gutter {
    margin: 0;
    padding: 10px 0;
}

.price-wrap {
    margin-top: 20px;
}

.price-wrap h3.value {
    color: #28a745;
    font-size: 24px;
    margin: 10px 0;
}

.price-wrap .btn {
    background-color: #28a745;
    color: #fff;
    padding: 10px 20px;
    border-radius: 5px;
    font-size: 16px;
    transition: background-color 0.3s ease;
}

.price-wrap .btn:hover {
    background-color: #218838;
}

   
   
</style>

</head>

<body style="margin: 0; font-family: Arial, sans-serif; background-color: #f9f9f9;">

    <!-- Header (Fixed Navigation Bar) -->
    <header id="header" class="header-scroll top-header headrom" style="position: fixed; top: 0; width: 100%; z-index: 1000; background-color: #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
        <nav class="navbar navbar-dark">
            <div class="container">
                <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                <a class="navbar-brand" href="index.php"> 
                    <img class="img-rounded" src="images/logo.png" alt="" height="40px"> 
                </a>
                <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                        <li class="nav-item"> <a class="nav-link active" href="shops.php">Mobile Shops<span class="sr-only"></span></a> </li>
                        
                        <?php
                        if (empty($_SESSION["user_id"])) { // if user is not logged in
                            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>';
                            echo '<li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
                        } else {
                            // if user is logged in
                            echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a> </li>';
                            echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <!-- Product Details Section -->
<div class="product-container">
    <h1><?php echo htmlspecialchars($product['product_name']); ?></h1>
    <div class="product-details">
        <div style="flex: 1; text-align: center; padding: 10px;">
            <img src="admin/shop_img/product/<?php echo htmlspecialchars($product['product_image']); ?>" alt="Product Image" style="max-width: 100%; height: auto; border-radius: 8px;">
        </div>
        <div class="product-details-text">
            <p><strong>Price:</strong> Rs.<?php echo htmlspecialchars($product['price']); ?></p>
            <p><strong>Description:</strong> <?php echo htmlspecialchars($product['description']); ?></p>
            <p><strong>Shop:</strong> <?php echo htmlspecialchars($product['shop_name']); ?></p>
            <p><strong>Address:</strong> <?php echo htmlspecialchars($product['address']); ?></p>

            <!-- Add Checkout Button -->
            <form action="checkout.php" method="POST" style="display: inline;">
    <input type="hidden" name="action" value="check">
    <button type="submit" class="btn btn-success" style="background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px;">Check Out</button>
</form>

        </div>
    </div>

    <div style="text-align: center; margin-top: 30px;">
        <a href="javascript:history.back()" style="display: inline-block; text-decoration: none; background-color: #28a745; color: #fff; padding: 10px 20px; border-radius: 5px; font-size: 16px;">Back to Previous Page</a>
    </div>
</div>


    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row top-footer">
                <div class="col-xs-12 col-sm-3 how-it-works-links color-gray">
                    <h5>How it Works?</h5>
                    <ul>
                        <li><a href="#">Choose your Mobile Phone</a></li>
                        <li><a href="#">Payment</a></li>
                        <li><a href="#">Enjoy your Item :)</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 pages color-gray">
                    <h5>Legal</h5>
                    <ul>
                        <li><a href="#">Terms & Conditions</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 payment-options color-gray">
                    <h5>All Major Credit Cards Accepted</h5>
                    <ul>
                        <li><a href="#"><img src="images/paypal.png" alt="Paypal"></a></li>
                        <li><a href="#"><img src="images/mastercard.png" alt="Mastercard"></a></li>
                        <li><a href="#"><img src="images/maestro.png" alt="Maestro"></a></li>
                    </ul>
                </div>
                <div class="col-xs-12 col-sm-3 address color-gray">
                    <h5>Call us at: <a href="tel:+94 77 406 4350">+94774064350</a></h5>
                </div>
            </div>
        </div>
    </footer>

</body>


</html>
