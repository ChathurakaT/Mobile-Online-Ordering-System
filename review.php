<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");
error_reporting(0);
session_start();

if(empty($_SESSION['user_id']))  //if usser is not login redirected back to login page
{
	header('location:login.php');
}
else
{
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="ecommerce.png">
    <title>Your Orders</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet">
<style type="text/css" rel="stylesheet">


.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  /* IE6-9 fallback on horizontal gradient */
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}


table { 
	width: 750px; 
	border-collapse: collapse; 
	margin: auto;
	
	}

/* Zebra striping */
tr:nth-of-type(odd) { 
	background: #eee; 
	}

th { 
	background: rgb(9, 53, 165);; 
	color: white; 
	font-weight: bold; 
	
	}

td, th { 
	padding: 10px; 
	border: 1px solid #ccc; 
	text-align: left; 
	font-size: 14px;
	
	}

/* 
Max width before this PARTICULAR table gets nasty
This query will take effect for any screen smaller than 760px
and also iPads specifically.
*/
@media 
only screen and (max-width: 760px),
(min-device-width: 768px) and (max-device-width: 1024px)  {

	table { 
	  	width: 100%; 
	}

	/* Force table to not be like tables anymore */
	table, thead, tbody, th, td, tr { 
		display: block; 
	}
	
	/* Hide table headers (but not display: none;, for accessibility) */
	thead tr { 
		position: absolute;
		top: -9999px;
		left: -9999px;
	}
	
	tr { border: 1px solid #ccc; }
	
	td { 
		/* Behave  like a "row" */
		border: none;
		border-bottom: 1px solid #eee; 
		position: relative;
		padding-left: 50%; 
	}

	td:before { 
		/* Now like a table header */
		position: absolute;
		/* Top/left values mimic padding */
		top: 6px;
		left: 6px;
		width: 45%; 
		padding-right: 10px; 
		white-space: nowrap;
		/* Label the data */
		content: attr(data-column);

		color: #000;
		font-weight: bold;
	}

}

	</style>

	</head>

<body>
    
       <!--header starts-->
       <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" height="40px" alt="" > </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Home <span class="sr-only">(current)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="shops.php">Mobile Shops <span class="sr-only"></span></a> </li>
                            
                           
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
            <!-- top Links -->
           
            <!-- end:Top links -->
            <!-- start: Inner page hero -->
            <div class="inner-page-hero bg-image" data-image-src="images/img/2.jpg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
            <!-- //results show -->

            <?php
            // Check if 'title' is set in the URL
            if (isset($_GET['title'])) {
                $product_title = $_GET['title'];
               
            } else {
                echo "No product title provided.";
            }
        ?>
             
            <section class="shops-page" style="margin-bottom: 100px; margin-top:-100px;" >
    <h3 style="text-align: center; font-weight: bold; margin-top: 0px;">Customer Reviews</h3>

    <div style="width: 60%; margin: auto; background-color: #f9f9f9; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <form method="post" action="submit_review.php">

            <div style="margin-bottom: 15px;">
                <label for="review" style="display: block; font-weight: bold;">Product Name:</label>
                <input value="<?php echo $product_title; ?>" id="name" name="name" rows="1" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: vertical;" edi></input>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="review" style="display: block; font-weight: bold;">Write a Review:</label>
                <textarea id="review" name="review" rows="4" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; resize: vertical;" required></textarea>
            </div>

            <div style="margin-bottom: 15px;">
                <label for="rating" style="display: block; font-weight: bold;">Rate Us:</label>
                <select id="rating" name="rating" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
                    <option value="5">5 - Excellent</option>
                    <option value="4">4 - Very Good</option>
                    <option value="3">3 - Good</option>
                    <option value="2">2 - Fair</option>
                    <option value="1">1 - Poor</option>
                </select>
            </div>


            <div style="text-align: center;">
                <button type="submit" style="background-color: rgb(9, 53, 165); color: white; padding: 10px 20px; border: none; border-radius: 4px; font-size: 16px; cursor: pointer;">Submit Review</button>
            </div>
        </form>

        

        <?php if (isset($_SESSION['review_message'])): ?>
                <div style="text-align: center; color: green; font-weight: bold;">
            <?php
                echo $_SESSION['review_message'];
                unset($_SESSION['review_message']); // Clear message after displaying it
            ?>
                </div>
            <?php endif; ?>
        
        
    </div>
</section>

</section>
      
            <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container" >
                <!-- top footer statrs -->
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
                            
                            <h5>Call us at: <a href="tel:+94 77 406 4350">+94 774064350</a></h5></div>
                </div>
                <!-- top footer ends -->
        </footer>
        </div>
  
    <!-- Bootstrap core JavaScript
    ================================================== -->
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
<?php
}
?>