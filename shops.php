<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

// Retrieve the search term from the URL
$search_query = isset($_GET['search']) ? mysqli_real_escape_string($db, $_GET['search']) : '';

// If a search query is present, filter shops based on it
if (!empty($search_query)) {
    // SQL query to join the shop table with the product table based on shop_id
    $query = "
        SELECT 
            shop.rs_id, 
            shop.title AS shop_name, 
            shop.address, 
            shop.image, 
            product.title AS product_name
        FROM 
            shop 
        INNER JOIN 
            product 
        ON 
            shop.rs_id = product.rs_id
        WHERE 
            product.title LIKE '%$search_query%'";
} else {
    // Default query to fetch all shops if no search term is provided
    $query = "SELECT shop.rs_id, shop.title AS shop_name, shop.address, shop.image FROM shop";
}

$result = mysqli_query($db, $query);

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="shop.png">
    <title>Mobile Shops</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
</head>

<body>
    <!-- header section -->
    <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" height="40px"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="shops.php">Mobile Shops<span class="sr-only"></span></a> </li>
                            
                           
							<?php
						if(empty($_SESSION["user_id"])) // if user is not login
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
							}
						else
							{
									//if user is login
									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>
							 
                        </ul>
						 
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>

    <div class="page-wrapper">
        <!-- Page Content Section -->
        <?php
if (!empty($search_query)) {
    echo '
    <div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="shops.php">Choose Mobile Shop</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick your favourite Mobile Phone</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">payment</a></li>
                </ul>
            </div>
          </div>
    <div class="result-show">
            <div class="container">
                <div class="row">
                    <h3>Search Results for "' . htmlspecialchars($search_query) . '"</h3>
                </div>
            </div>
          </div>';
} else {
    echo '<div class="top-links">
            <div class="container">
                <ul class="row links">
                    <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="shops.php">Choose Mobile Shop</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Pick your favourite Mobile Phone</a></li>
                    <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">payment</a></li>
                </ul>
            </div>
          </div>';
}
?>

        </div>
        <div class="inner-page-hero bg-image" data-image-src="images/img/cover.png">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
        <!-- Displaying Shops -->
        <section class="shops-page">
            <div class="container">
                <div class="row">
                    <!-- Left sidebar (popular tags) -->
                    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                        <div class="widget clearfix">
                            <div class="widget-heading">
                                <h3 class="widget-title text-dark">Popular tags</h3>
                                <div class="clearfix"></div>
                            </div>
                            <div class="widget-body">
                                <ul class="tags">
                                    <li><a href="#" class="tag">Apple</a></li>
                                    <li><a href="#" class="tag">Samsung</a></li>
                                    <li><a href="#" class="tag">Huawei</a></li>
                                    <li><a href="#" class="tag">OPPO</a></li>
                                    <li><a href="#" class="tag">Vivo</a></li>
                                    <li><a href="#" class="tag">Xiaomi</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Right Content -->
                    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                        <div class="bg-gray shop-entry">
                        <div class="row">
    <?php
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                    <div class="entry-logo">
                        <a class="img-fluid" href="product.php?res_id=' . $row['rs_id'] . '">
                            <img src="admin/shop_img/' . $row['image'] . '" alt="Shop logo">
                        </a>
                    </div>
                    <div class="entry-dscr">
                        <h5>' . htmlspecialchars($row['product_name']) . '</h5>
                        <span>Shop: ' . htmlspecialchars($row['shop_name']) . '</span><br>
                        <span>Address: ' . htmlspecialchars($row['address']) . '</span>
                    </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                    <div class="right-content bg-white">
                        <div class="right-review">';
            
            // Check if the product is searched
            if (!empty($search_query)) {
                // Display "View Product" button for searched products
                echo '<a href="product_detail.php?product_name=' . urlencode($row['product_name']) . '" class="btn theme-btn-dash">View Product</a>';
            } else {
                // Display "View Menu" button for mobile shops
                echo '<a href="product.php?res_id=' . $row['rs_id'] . '" class="btn theme-btn-dash">View Menu</a>';
            }

            echo '      </div>
                    </div>
                  </div>';
        }
    } else {
        echo '<div class="col-12"><p class="text-center">No results found for "' . htmlspecialchars($search_query) . '".</p></div>';
    }
    ?>
</div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

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
    </div>

    <!-- JavaScript files -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/productpick.min.js"></script>
</body>

</html>
