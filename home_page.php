<?php 
    //  include 'config.php';
    //  session_start();


    //  if(isset($_SESSION['user_id'])){
    //     $id=$_SESSION['user_id'];
    //  }

    include 'header.php';

     if(isset($_POST['logout'])){
        session_destroy();
        header('Location:home_page.php');
     }

     if(isset($_POST['submit'])){

        
        $lemail = mysqli_real_escape_string($conn, $_POST['lemail']);
        $lpass = mysqli_real_escape_string($conn, md5($_POST['lpass']));
        
     
        $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userEmail='$lemail' and userPassword='$lpass'");
     
        if(mysqli_num_rows($choose)>0){
         $row=mysqli_fetch_assoc($choose);
         $_SESSION['user_id'] = $row['userId'];
         header('Location:home_page.php');
        }
        else{

            header('Location:login.php');
        }
    }


     


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="favicon.png" type="image/png">
    <title>Penpix Stationeries</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style_home.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>
    <!-- header section starts -->

    <?php
    // include 'header.php';
    ?>
   
    <!-- header section ends -->

    <!-- bottom navbar starts -->
   

    <!-- login form -->
    <div class="login-form-container">
        <div id="close-login-btn" class="fa-solid fa-xmark"></div>
        <form action=""  method="POST" enctype="multipart/form-data">
           
            <?php
                  if(isset($_SESSION['user_id'])){
                    $ses=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                    $fetch=mysqli_fetch_assoc($ses);

                    echo "<span>" . $fetch['userName'] . "</span>";
                    echo "<span>" . $fetch['userEmail'] . "</span>";
                    echo '<input type="submit" class="btn" name="logout" value="logout">';
                  }
                  else{
                  echo' 
                   <h3>Login</h3>';
                   if(isset($message)){
                    foreach($message as $message){
                       echo '<div class="message">'.$message.'</div>';
                    }
                 }

                   echo '
                    <span>User Email</span>
                    <input type="email" name="lemail" class="box" placeholder="Enter your email"  required>
                    <span>Password</span>
                    <input type="password" name="lpass" class="box" placeholder="Enter your password" required>
                     
                    <input type="submit" name="submit" value="login" class="btn" >
                    <p>Fogot passowrd?<a href="#">Click here</a></p>';

                  }
               
                ?>
                <!-- <div class="checkbox">
                         <input type="checkbox" name="" id="remember-me">
                         <label for="remember-me">Remember Me</label>
                     </div> -->
           
            <p>Don't have an account? <a href="sign.php">Create an account</a></p>
        </form>
    </div>


     
   
    <!-- Home section starts -->
    <section class="home" id="home">

        <div class="row">

            <div class="content">
                <h3>Upto 75% off</h3>
                <p>
                    We are excited to offer you an exclusive opportunity to embark on your education journey with our special discount offer.
                    Visit us today and experience the joy of discovering new worlds within the pages of our discounted stationeries.
                </p>
                <a href="#" class="btn">Shop Now</a>
            </div>
            <div class="swiper stationery-slider">
                <div class="swiper-wrapper">

                <!-- <a href="cart.php" class="swiper-slide"><img src="images/book1.png" alt=""></a> -->
                 <?php 
                  $gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Old stuff'");
                  if(mysqli_num_rows($gal)>0){
                      while($set=mysqli_fetch_assoc($gal)){
                          echo ' <a  href="cart.php#old" class="swiper-slide"><img src="uploaded_img/'.$set['pImg'].'" alt=""></a> ';  
                      }
                  }
                 ?> 

                <!-- <a href="cart.php" class="swiper-slide"><img src="images/calculator.jpg" alt=""></a>
                <a href="cart.php" class="swiper-slide"><img src="images/pencilcase.png" alt=""></a>
                <a href="cart.php" class="swiper-slide"><img src="images/pen.png" alt=""></a>
                <a href="cart.php" class="swiper-slide"><img src="images/schoolbag.png" alt=""></a>
                <a href="cart.php" class="swiper-slide"><img src="images/insBox.png" alt=""></a> -->

                </div>
            </div>
        </div>

    </section>
    <!-- Home section ends -->
   

    <!-- icons section starts -->

    <section class="icons-container">

        <div class="icons">
            
            <i class="fa-solid fa-motorcycle"></i>
            <div class="content">
                <h3> Free dilivery</h3>
                <p> Free dilivery for purchases over RS.2000</p>
            </div>
            
        </div>

        
        <div class="icons">

            <i class="fa-solid fa-lock"></i>
            <div class="content">
                <h3>Secure Payments</h3>
                <p>100% secure payment methods</p>
            </div>
            
        </div>

        <div class="icons">
            
            <i class="fa-solid fa-rotate-right"></i>
            <div class="content">
                <h3>Easy Returns</h3>
                <p>Returns within 7 days</p>
            </div>
            
        </div>

        <div class="icons">
            
            <i class="fa-solid fa-phone"></i>
            <div class="content">
                <h3>24/7 hours service</h3>
                <p>Call us anytime</p>
            </div>
            
        </div>

    </section>

    <!-- icons section ends -->

    <!-- featured items scetion stars -->
    

    <section class="featured" id="featured">

        <h1 class="heading"><span>Featured Stationery Items</span></h1>

        <div class="swiper featured-slider">
            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/crbooks.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>CR Books</h3>
                        <div class="price">Rs.350 <span>Rs.560</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/board.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>White Board</h3>
                        <div class="price">Rs.8800 <span>Rs.9700</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

              <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/glue.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Glue Sticks</h3>
                        <div class="price">Rs.420 <span>Rs.480</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/schoolbag.png" alt="">
                    </div>
                    <div class="content">
                        <h3>School Bags</h3>
                        <div class="price">Rs.3750 <span>Rs.4300</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/scissor.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Scissors</h3>
                        <div class="price">Rs.350 <span>Rs.460</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/carrom.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Carrom Board</h3>
                        <div class="price">Rs.6650 <span>Rs.7200</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/pencils.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Pencil packs</h3>
                        <div class="price">Rs.540 <span>Rs.660</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/crayons.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Crayons Pack</h3>
                        <div class="price">Rs.450 <span>Rs.500</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/pencilcase.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Pencil Cases</h3>
                        <div class="price">Rs.350 <span>Rs.400</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="icons">
                        <a href="#" class="fa-solid fa-magnifying-glass"></a>
                        <a href="#" class="fa-regular fa-heart"></a>
                        <a href="#" class="fa-regular fa-eye"></a>
                    </div>
                    <div class="image">
                        <img src="featured/file.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>File Cases</h3>
                        <div class="price">Rs.230 <span>Rs.260</span></div>
                        <a href="#" class="btn">Add to Cart</a>
                    </div>
                </div> 

            </div>

             <div class="swiper-button-next"></div>
             <div class="swiper-button-prev"></div>

        </div>

    </section>

    <!-- featured section ends -->

    <!-- newsletter section starts -->

    <section class="newsletter">

        <form action="">
            <h3>Subscribe For Latest Updates</h3>
            <input type="email" name="" placeholder="Enter your email" class="box">
            <input type="submit" value="Subscribe" class="btn">
        </form>
    </section>
    <!-- newsletter section ends -->

    <!-- Arrivals section starts -->

    <section class="arrivals" id="arrivals">

        <h1 class="heading"><span>New Arrivals</span></h1>

        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">

                <a href="#" class=" swiper-slide box">
                <div class="image">
                    <img src="arrivals/backpack.jpeg" alt="">
                </div>
                <div class="content">
                    <h3>Backpack</h3>
                    <div class="price">RS.5700 <span>RS.6250</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="arrivals/clay.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Natural Clay</h3>
                        <div class="price">RS.160 <span>RS.190</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    </a>

                    <a href="#" class="swiper-slide box">
                        <div class="image">
                            <img src="arrivals/blackboard.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>Black Board</h3>
                            <div class="price">RS.8000 <span>RS.8500</span></div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        </a>

                        <a href="#" class="swiper-slide box">
                            <div class="image">
                                <img src="arrivals/lunchbox.jpg" alt="">
                            </div>
                            <div class="content">
                                <h3>Lunch Box Pack</h3>
                                <div class="price">RS.1200 <span>RS.1350</span></div>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            </a>

                            <a href="#" class="swiper-slide box">
                                <div class="image">
                                    <img src="arrivals/puncher.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Hole Puncher</h3>
                                    <div class="price">RS.430 <span>RS.490</span></div>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                </a>

                                <a href="#" class="swiper-slide box">
                                    <div class="image">
                                        <img src="arrivals/sidebag.png" alt="">
                                    </div>
                                    <div class="content">
                                        <h3>Sidebags</h3>
                                        <div class="price">RS.2850 <span>RS.3000</span></div>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>
                                    </a>
            </div>
        </div>
        
        <div class="swiper arrivals-slider">
            <div class="swiper-wrapper">

                <a href="#" class="swiper-slide box">
                <div class="image">
                    <img src="arrivals/desk.jpg" alt="">
                </div>
                <div class="content">
                    <h3>Desk & Chair</h3>
                    <div class="price">RS.5200 <span>RS.5800</span></div>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
                </a>

                <a href="#" class="swiper-slide box">
                    <div class="image">
                        <img src="arrivals/marker.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>MArker Pens</h3>
                        <div class="price">RS.120<span>RS.145</span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                    </a>

                    <a href="#" class="swiper-slide box">
                        <div class="image">
                            <img src="arrivals/bottle.jpg" alt="">
                        </div>
                        <div class="content">
                            <h3>Water Bottles</h3>
                            <div class="price">RS.780 <span>RS.830</span></div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                        </a>

                        <a href="#" class="swiper-slide box">
                            <div class="image">
                                <img src="arrivals/toys.jpg" alt="">
                            </div>
                            <div class="content">
                                <h3>Toy Car</h3>
                                <div class="price">RS.3400 <span>RS.3700</span></div>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                            </a>

                            <a href="#" class="swiper-slide box">
                                <div class="image">
                                    <img src="arrivals/deskorganizer.jpg" alt="">
                                </div>
                                <div class="content">
                                    <h3>Desk Organizer</h3>
                                    <div class="price">RS.970 <span>RS.1120</span></div>
                                    <div class="stars">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star-half-alt"></i>
                                    </div>
                                </div>
                                </a>

                                <a href="#" class="swiper-slide box">
                                    <div class="image">
                                        <img src="arrivals/atlas.jpg" alt="">
                                    </div>
                                    <div class="content">
                                        <h3>Atlas Book</h3>
                                        <div class="price">RS.640<span>RS.670</span></div>
                                        <div class="stars">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star-half-alt"></i>
                                        </div>
                                    </div>
                                    </a>
            </div>
        </div>
    </section>
    <!-- Arrivals section ends -->

    <!-- deal section starts -->

    <section class="deal">

        <div class="content">
            <h3>Deal of the Day</h3>
            <h1>Upto 50% Off</h1>
            <p>Discover unbeatable deals on high-quality stationery essentials in our Deal Section!
                unleash your productivity and creativity without stretching your budget. Hurry, these deals won't last forever.
                 Elevate your stationery collection today while saving big!
            </p>
            <a href="#" class="btn">Shop Now</a>
        </div>

        <div class="image">
            <img src="arrivals/deals.jpg" alt="">

        </div>
    </section>
    <!-- deal section ends -->

    <!-- Reviews section starts -->

    <section class="reviews" id="reviews">

        <h1 class="heading"><span>Customers Reviews</span></h1>

                <div class="swiper reviews-slider">
                    <div class="swiper-wrapper">

                        <div class="swiper-slide box">
                            <h3>Bhashana Chamodhya</h3>
                            <p>"This shop is a creative haven! As a writer, I find inspiration in the carefully curated selection of notebooks and pens. 
                                I'm amazed at how this place manages to ignite my imagination every time I visit."
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                           <div class="swiper-slide box">
                            <h3>Sevindu Punsara</h3>
                            <p>
                                "I stumbled upon this stationery shop while wandering around town, and it's now my go-to place for gifts.
                                From adorable journals to fun office gadgets, you're sure to find something that brings a smile to your face."
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-alt"></i>
                            </div>
                        </div>

                        <div class="swiper-slide box">
                            <h3>Sathishkumar</h3>
                            <p>
                                "The shop has a decent selection, but the customer service can be hit or miss.
                                 Some of the staff are helpful and knowledgeable, while others seem disinterested."
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                            </div>
                        </div>

                        <div class="swiper-slide box">
                            <h3>Peheliya Dhanuka</h3>
                            <p>"This shop is a creative haven! As a writer, I find inspiration in the carefully curated selection of notebooks and pens. 
                                I'm amazed at how this place manages to ignite my imagination every time I visit."
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                        </div>

                        <div class="swiper-slide box">
                            <h3>Chamodh Jayasumana</h3>
                            <p>
                                "This stationery shop is a paradise for stationary addicts like me.
                                 From elegant fountain pens to cute washi tapes, they have it all. I'm amazed at how this palce manages.""
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-alt"></i>
                            </div>
                        </div>

                        <div class="swiper-slide box">
                            <h3>Nuwandi Siriwardhana</h3>
                            <p>
                                "The products are pretty standard, and I didn't find anything that stood out as unique or exceptional.
                                 Prices are reasonable, though, so it might still be worth a visit if you're in need of basic supplies." 
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-alt"></i>
                            </div>
                        </div>

                        <div class="swiper-slide box">
                            <h3>Helali Perera</h3>
                            <p>
                                "This stationery shop is a paradise for stationary addicts like me. 
                                From elegant fountain pens to cute washi tapes, they have it all. This palce is worth to shop."
                            </p>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                        </div>
            </div>
        </div>
    </section>
    <!-- Reviews section ends -->

    <!-- blogs section starts -->

    <section class="blogs" id="blogs">

        <h1 class="heading"><span>Our Blogs</span></h1>

        <div class="swiper blogs-slider">

            <div class="swiper-wrapper">

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog5.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>The Future of Social Security</h3>
                        <p>A forward-looking blog post discussing potential future changes to the social security system, 
                            including demographic shifts, funding challenges, and potential policy reforms.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog1.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>The Power of Connection</h3>
                        <p>Social media's early days were primarily about connecting friends and family across distances. 
                            People shared personal updates, photos.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog2.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3> Nurturing a Lifelong Love for Books</h3>
                        <p>Provide tips for parents and caregivers on instilling a love of reading in children.
                             Suggest age-appropriate books, reading strategies, and interactive activities to engage young readers.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog3.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>A Sanctuary for the Mind</h3>
                        <p>Libraries are more than just repositories of books; they are sanctuaries for the mind. 
                            Walking through their hushed corridors, we find respite from the chaos of everyday life.
                        </p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>

                <div class="swiper-slide box">
                    <div class="image">
                        <img src="blogs/blog4.jpg" alt="">
                    </div>
                    <div class="content">
                        <h3>Time as a Canvas</h3>
                        <p>Just as an artist wields a brush, time offers us a canvas upon which we paint the masterpiece of our lives. 
                            Each day is a brushstroke, contributing to the unique story we craft.</p>
                        <a href="#" class="btn">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blogs section ends -->

    <!-- footer section starts -->
  <?php 
   include 'footer.php';
  
  ?>


   
  

</body>
</html>