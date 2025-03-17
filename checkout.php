<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
include_once 'product-action.php';
error_reporting(0);
session_start();


if (empty($_SESSION["user_id"])) {
    header('location:login.php');
    exit;
} else {
    $item_total = 0;

    if (isset($_POST['submit'])) {
        foreach ($_SESSION["cart_item"] as $item) {
            $item_total += ($item["price"] * $item["quantity"]);

            $SQL = "INSERT INTO users_orders (u_id, title, quantity, price) 
                    VALUES ('" . $_SESSION["user_id"] . "', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "')";
            mysqli_query($db, $SQL);
        }

        unset($_SESSION["cart_item"]); // Clear the cart

        // Redirect to 'your_orders.php' page
        header('location:your_orders.php');
        exit;
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Order Checkout</title>
    <!-- CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <div class="site-wrapper">
        <!-- Header -->
        <header id="header" class="header-scroll top-header headrom">
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php">
                        <img class="img-rounded" src="images/logo.png" alt="" height="40px">
                    </a>
                    <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                            <li class="nav-item"><a class="nav-link active" href="shops.php">Mobile Shops</a></li>
                            <?php
                            if (empty($_SESSION["user_id"])) {
                                echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>';
                                echo '<li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a></li>';
                            } else {
                                echo '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a></li>';
                                echo '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>';
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="page-wrapper">
            <!-- Progress Steps -->
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="shops.php">Choose Mobile Shop</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick your favourite Mobile Item</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Payment</a></li>
                    </ul>
                </div>
            </div>

            <div class="container">
                <?php if (!empty($success)): ?>
                    <span style="color:green;"><?php echo $success; ?></span>
                <?php endif; ?>
            </div>

            <!-- Checkout Section -->
            <div class="container m-t-30">
                <form action="" method="post">
                    <div class="widget clearfix">
                        <div class="widget-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="cart-totals margin-b-20">
                                        <div class="cart-totals-title">
                                            <h4>Cart Summary</h4>
                                        </div>
                                        <?php
$item_total = 0;

// Ensure the cart session contains data
if (!empty($_SESSION["cart_item"])) {
    foreach ($_SESSION["cart_item"] as $item) {
        $item_price = isset($item["price"]) ? $item["price"] : 0;
        $item_quantity = isset($item["quantity"]) ? $item["quantity"] : 0;
        $item_total += ($item_price * $item_quantity);
    }
}
?>

<div class="cart-totals-fields">
    <table class="table">
        <tbody>
            <tr>
                <td>Cart Subtotal</td>
                <td>Rs. <?php echo isset($item_total) ? $item_total : 0; ?></td>
            </tr>
            <tr>
                <td class="text-color"><strong>Total</strong></td>
                <td class="text-color"><strong>Rs. <?php echo isset($item_total) ? $item_total : 0; ?></strong></td>
            </tr>
        </tbody>
    </table>
</div>

                                    </div>

                                    <!-- Payment Options -->
                                    <div class="payment-option">
                                        <ul class="list-unstyled">
                                            <li>
                                                <label class="custom-control custom-radio m-b-20">
                                                    <input name="mod" id="radioStacked1" checked value="COD" type="radio" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Cash on delivery</span>
                                                </label>
                                            </li>
                                            <li>
                                                <label class="custom-control custom-radio m-b-10">
                                                    <input name="mod" type="radio" value="paypal" class="custom-control-input">
                                                    <span class="custom-control-indicator"></span>
                                                    <span class="custom-control-description">Credit Card
                                                        <img src="images/paypal.jpg" alt="" width="90">
                                                    </span>
                                                </label>
                                            </li>
                                        </ul>
                                        <p class="text-xs-center"> <a href=""></a><input type="submit" onclick="return confirm('Are you sure?');" name="submit"  class="btn btn-outline-success btn-block" value="Order now"> </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row top-footer">
                        <div class="col-xs-12 col-sm-3 how-it-works-links color-gray">
                            <h5>How it Works?</h5>
                            <ul>
                                <li><a href="#">Choose your Item</a></li>
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
                            <h5>Call us at: <a href="tel:+94774064350">+94 774064350</a></h5>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/productpick.min.js"></script>
</body>
</html>
