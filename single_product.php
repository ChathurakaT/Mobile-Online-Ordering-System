<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php"); // connect to db
error_reporting(0);
session_start();

$product_id = $_GET['product_id']; // Get the product ID from URL
include_once 'product-action.php'; //including controller

// Fetch the product details
$query = "SELECT * FROM product WHERE d_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $product_id);
$stmt->execute();
$product = $stmt->get_result()->fetch_assoc();

?>
<head>
    <title><?php echo $product['title']; ?> - Product Details</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="Phone.png">
    <title>Mobile Phones</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
    <!-- Add other necessary CSS links here -->
</head>


<body>
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt="" height="40px"> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                       <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="shops.php">Mobile Shop <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Sign Up</a> </li>';
							}
						else
							{
									
									
									echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Your Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">LogOut</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- top Links -->
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                      
                        <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="shops.php">Choose Mobile Shop</a></li>
                        <li class="col-xs-12 col-sm-4 link-item active"><span>2</span><a href="product.php?res_id=<?php echo $_GET['res_id']; ?>">Pick your favourite Mobile Phone</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Get delivered & Pay</a></li>
                    </ul>
                </div>
            </div>
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
			<?php $ress= mysqli_query($db,"select * from shop where rs_id='$_GET[res_id]'");
									     $rows=mysqli_fetch_array($ress);
										  
										  ?>
            <section class="inner-page-hero bg-image" data-image-src="images/img/cover.png">
                <figure><?php echo '<img src="images/img/cover.png" alt="Shop logo" style="margin-bottom:-250px; margin-top:-100px; height:350px;">'; ?></figure>
                <div class="profile">
                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12  col-md-4 col-lg-4 profile-img">
                                <div class="image-wrap">
                                    <figure><?php echo '<img src="admin/shop_img/'.$rows['image'].'" alt="Shop logo">'; ?></figure>
                                </div>
                            </div>
							
                            <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 profile-desc">
                                <div class="pull-left right-text ">
                                    
                                    <h6><a href="#"><?php echo $rows['title']; ?></a></h6>
                                    <p><?php echo $rows['address']; ?></p>
                                    
                                  
                                   
                                  
                                </div>
                            </div>
							
							
                        </div>
                    </div>
                </div>
            </section> 


            <div class="product-details" style="max-width: 800px; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                <h2 style="color: #333; text-align: center; font-size: 28px;"><?php echo $product['title']; ?></h2>
                <div style="text-align: center;">
                    <img src="admin/shop_img/product/<?php echo $product['img']; ?>" alt="Product Image" style="width: 100%; max-width: 400px; border-radius: 8px; margin-bottom: 20px;">
                </div>
                <p style="color: #666; font-size: 16px; text-align: center;"><?php echo $product['description']; ?></p>
                <p style="color: #333; font-size: 18px; text-align: center; font-weight: bold;">Price: Rs.<?php echo $product['price']; ?></p>
                <div style="text-align: center; margin-top: 20px;">
                    <a href="product.php?res_id=<?php echo $_GET['res_id']; ?>" style="color: #fff; background-color: #007bff; padding: 10px 20px; border-radius: 5px; text-decoration: none;">Back to Products</a>
                </div>
            </div>

<!-- Customer Reviews Section -->
            <div class="customer-reviews" style="max-width: 800px; margin: 40px auto 0; padding: 20px; border: 1px solid #ddd; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: Arial, sans-serif;">
                <h3 style="color: #333; font-size: 24px; text-align: center; margin-bottom: 20px;">Customer Reviews</h3>

                <?php
                // Fetch customer reviews from the database for the specific product
                $product_title = $product['title'];
                $reviews_query = mysqli_query($db, "SELECT * FROM product_reviews WHERE product_title='$product_title' ORDER BY review_date DESC");

                if (mysqli_num_rows($reviews_query) > 0) {
                    while ($review = mysqli_fetch_assoc($reviews_query)) {
                        // Display each review with rating as stars
                        $stars = str_repeat('⭐', $review['rating']);
                        echo '<div class="review" style="border-bottom: 1px solid #ddd; padding: 10px 0; margin-bottom: 10px;">';
                        echo '<p style="font-weight: bold; color: #333;">' . $review['user_id'] . ' - <span style="font-weight: normal; color: #888; font-size: 14px;">' . $review['review_date'] . '</span></p>';
                        echo '<p style="color: #FFD700; font-size: 18px; margin: 5px 0;">' . $stars . '</p>';
                        echo '<p style="color: #666; font-size: 16px;">' . $review['review'] . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p style="color: #666; font-size: 16px; text-align: center;">No reviews available for this product.</p>';
                }
                ?>
            </div>



    <footer class="footer">
            <div class="container">
                <!-- top footer statrs -->
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
                            <li><a href="#">Terms & Conditions</a> </li>
                           
                            <li><a href="#">Privacy Policy</a> </li>
                       
                        </ul>
                    </div>
                    
                    <div class="col-xs-12 col-sm-3 payment-options color-gray">
                            <h5>All Major Credit Cards Accepted</h5>
                            <ul>
                                <li>
                                    <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                </li>
                                <li>
                                    <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-3 address color-gray">
                            
                            <h5>Call us at: <a href="tel:+94 774064350">+94 774064350</a></h5></div>
                </div>
                <!-- top footer ends -->
        </footer>
</body>
</html>

    
        