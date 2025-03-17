<!DOCTYPE html>
<html lang="en">
<?php
include("connection/connect.php");  //include connection file
error_reporting(0);  // using to hide undefine undex errors
session_start(); //start temp session until logout/browser closed

?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="homepage.png">
    <title>Home</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/main.css" rel="stylesheet"> 
 
</head>

<body class="home">
    
        <!--header starts-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/logo.png" alt=""  height="40px"> </a>
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
        <!-- banner part starts -->
        <section class="hero bg-image" data-image-src="images/img/new.jpg">
            <div class="hero-inner">
                <div class="container text-center hero-text font-white">
                    <h1>Online Mobile Shop System</h1>
                    <h5 class="font-white space-xs">You Can Order Quickly </h5>
                    <div class="banner-form">


                    <div class="container mt-4">
    <form method="get" action="shops.php">
        <div class="form-group row">
            <div class="col-md-10">
                <!-- Input field for search -->
                <input type="text" name="search" class="form-control" placeholder="Search for shops or products" required>
            </div>
            <div class="col-md-2">
                <!-- Submit button -->
                <button type="submit" class="btn theme-btn btn-block">Search</button>
            </div>
        </div>
    </form>
</div>


                    </div>
                    <div class="steps">
                        <div class="step-item step1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                <g fill="#FFF">
                                    <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z"></path>
                                    <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z"></path>
                                </g>
                            </svg>
                            <h4><span>1. </span>Choose Mobile Shop</h4> </div>
                        <!-- end:Step --><img  src=images/5.png width="40px" height="40px"  alt="">
                        <div class="step-item step2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="#FFF" data-name="Layer 2"><g data-name="smartphone"><rect width="512" height="512" transform="rotate(90 12 12)" opacity="0"/>
                            <path d="M17 2H7a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zm1 17a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1z"/><circle cx="12" cy="16.5" r="1.5"/><path d="M14.5 6h-5a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2z"/>
                        </g>
                    </g>
                </svg>
                            <h4><span>2. </span>Order Mobile Phone</h4> </div>
                        <!-- end:Step --> <img  src=images/5.png width="40px" height="40px"  alt="">
                        <div class="step-item step3">
                            <img  src=images/4.png width="40px" height="40px"  alt="">
                           <h4><span>3. </span>Payment</h4> </div>
                        <!-- end:Step -->
                    </div>
                    <!-- end:Steps -->
                </div>
            </div>
            <!--end:Hero inner -->
        </section>
        <!-- banner part ends -->
      
	  
	
        <!-- Popular block starts -->
        <section class="popular">
            <div class="container">
                <div class="title text-xs-center m-b-30">
                    <h2>Tranding Products</h2>
                    <p class="lead">“End-users, not technologies, shape the market. Consequently, marketers need to stay abreast not only of technological developments but also of the way people respond to them.”</p>
                </div>
                <div class="row">
				
				
				
						<?php 
						// fetch records from database to display popular first 3 products from table
						$query_res= mysqli_query($db,"select * from product LIMIT 4"); 
									      while($r=mysqli_fetch_array($query_res))
										  {
													
						                       echo '  <div class="col-xs-12 col-sm-6 col-md-3 product-item">
														<div class="product-item-wrap">
															<div class="figure-wrap bg-image" data-image-src="admin/shop_img/product/'.$r['img'].'">
																
															</div>
															<div class="content">
																<h5><a href="product.php?res_id='.$r['rs_id'].'">'.$r['title'].'</a></h5>
																<div class="product-name">'.$r['description'].'</div>
																<div class="price-btn-block"> <span class="price">Rs.'.$r['price'].'</span> <a href="product.php?res_id='.$r['rs_id'].'" class="btn theme-btn-dash pull-right">View Menu</a> </div>
															</div>
															
														</div>
												</div>';
													
										  }
						
						
						?>					
                 
                </div>
            </div>
        </section>
        <!-- Popular block ends -->
        <!-- How it works block starts -->
        <section class="how-it-works">
            <div class="container">
                <div class="text-xs-center">
                    <h2>Easy 3 Steps Order</h2>
                    <!-- 3 block sections starts -->
                    <div class="row how-it-works-solution">
                        <div class="col-xs-12 col-sm-12 col-md-3 how-it-works-steps white-txt col1">
                            <div class="how-it-works-wrap">
                                <div class="step step-1">
                                    <div class="icon" data-step="1">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 483 483" width="512" height="512">
                                            <g fill="#FFF">
                                                <path d="M467.006 177.92c-.055-1.573-.469-3.321-1.233-4.755L407.006 62.877V10.5c0-5.799-4.701-10.5-10.5-10.5h-310c-5.799 0-10.5 4.701-10.5 10.5v52.375L17.228 173.164a10.476 10.476 0 0 0-1.22 4.938h-.014V472.5c0 5.799 4.701 10.5 10.5 10.5h430.012c5.799 0 10.5-4.701 10.5-10.5V177.92zM282.379 76l18.007 91.602H182.583L200.445 76h81.934zm19.391 112.602c-4.964 29.003-30.096 51.143-60.281 51.143-30.173 0-55.295-22.139-60.258-51.143H301.77zm143.331 0c-4.96 29.003-30.075 51.143-60.237 51.143-30.185 0-55.317-22.139-60.281-51.143h120.518zm-123.314-21L303.78 76h86.423l48.81 91.602H321.787zM97.006 55V21h289v34h-289zm-4.198 21h86.243l-17.863 91.602h-117.2L92.808 76zm65.582 112.602c-5.028 28.475-30.113 50.19-60.229 50.19s-55.201-21.715-60.23-50.19H158.39zM300 462H183V306h117v156zm21 0V295.5c0-5.799-4.701-10.5-10.5-10.5h-138c-5.799 0-10.5 4.701-10.5 10.5V462H36.994V232.743a82.558 82.558 0 0 0 3.101 3.255c15.485 15.344 36.106 23.794 58.065 23.794s42.58-8.45 58.065-23.794a81.625 81.625 0 0 0 13.525-17.672c14.067 25.281 40.944 42.418 71.737 42.418 30.752 0 57.597-17.081 71.688-42.294 14.091 25.213 40.936 42.294 71.688 42.294 24.262 0 46.092-10.645 61.143-27.528V462H321z" />
                                                <path d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z" /> </g>
                                        </svg>
                                    </div>
                                    <h3>Choose a Mobile Shop</h3>
                        
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-2 how-it-works-steps white-txt col2">
                        <img  src=images/6.png width="200px" height="200px" class="arrowImage1" alt="">
                        </div>
                        
                        <div class="col-xs-12 col-sm-12 col-md-3 how-it-works-steps white-txt col2">
                            <div class="step step-2">
                                <div class="icon" data-step="2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <g fill="#FFF" data-name="Layer 2"><g data-name="smartphone"><rect width="512" height="512" transform="rotate(90 12 12)" opacity="0"/>
                            <path d="M17 2H7a3 3 0 0 0-3 3v14a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V5a3 3 0 0 0-3-3zm1 17a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V5a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1z"/><circle cx="12" cy="16.5" r="1.5"/><path d="M14.5 6h-5a1 1 0 0 0 0 2h5a1 1 0 0 0 0-2z"/>
                        </g>
                    </g>
                </svg>
                                </div>
                                <h3>Choose your favorite Mobile Phone</h3>
                                <p>We are serving you more than 300+ popular Mobile phones and Accessories.</p>
                            </div>
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-md-2 how-it-works-steps white-txt col2">
                        <img  src=images/6.png width="200px" height="200px" class="arrowImage2" alt="">
                        </div>
                       
                        <div class="col-xs-12 col-sm-12 col-md-2 how-it-works-steps white-txt col3">
                            <div class="step step-3">
                                <div class="icon" data-step="3"><img  src=images/4.png  alt="">
                                      </div>
                                <h3>Payment</h3>
                                <p>100% safe Payment , We give money back gurenty</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- 3 block sections ends -->
                <div class="row">
                    <div class="col-sm-12 text-center">
                        <p class="pay-info">Pay by Cash on delivery or Card Payment</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- How it works block ends -->
        <!-- Featured shops starts -->
        <section class="featured-shops">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="title-block pull-left">
                            <h4>Featured Mobile Shops</h4> </div>
                    </div>
                    <div class="col-sm-8">
                        <!-- shops filter nav starts -->
                        <div class="shops-filter pull-right">
                            <nav class="primary pull-left">
                                <ul>
                                    <li><a href="#" class="selected" data-filter="*">all</a> </li>
									<?php 
									// display categories here
									$res= mysqli_query($db,"select * from shop_category");
									      while($row=mysqli_fetch_array($res))
										  {
											echo '<li><a href="#" data-filter=".'.$row['c_name'].'"> '.$row['c_name'].'</a> </li>';
										  }
									?>
                                   
                                </ul>
                            </nav>
                        </div>
                        <!-- shops filter nav ends -->
                    </div>
                </div>
                <!-- shops listing starts -->
                <div class="row">
                    <div class="shop-listing">
                        
						
						<?php  //fetching records from table and filter using html data-filter tag
						$ress= mysqli_query($db,"select * from shop");  
									      while($rows=mysqli_fetch_array($ress))
										  {
													// fetch records from shop_category table according to catgory ID
													$query= mysqli_query($db,"select * from shop_category where c_id='".$rows['c_id']."' ");
													 $rowss=mysqli_fetch_array($query);
						
													 echo ' <div class="col-xs-12 col-sm-12 col-md-6 single-shop all '.$rowss['c_name'].'">
														<div class="shop-wrap">
															<div class="row">
																<div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
																	<a class="shop-logo" href="product.php?res_id='.$rows['rs_id'].'" > <img src="admin/shop_img/'.$rows['image'].'" alt="shop logo"> </a>
																</div>
																<!--end:col -->
																<div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
																	<h5><a href="product.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].'</span>
																	
																</div>
																<!-- end:col -->
															</div>
															<!-- end:row -->
														</div>
														<!--end:Shop wrap -->
													</div>';
										  }
						
						
						?>
						
							
						
					
                    </div>
                </div>
                <!-- shops listing ends -->
               
            </div>
        </section>
        <!-- Featured shops ends -->
        
        <!-- start: FOOTER -->
        <footer class="footer">
            <div class="container">
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
                            
                        <h5>Call us at: <a href="tel:+94 77 406 4350">+94774064350</a></h5></div>
                </div>
                <!-- top footer ends -->
        </footer>
        <!-- end:Footer -->
    
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