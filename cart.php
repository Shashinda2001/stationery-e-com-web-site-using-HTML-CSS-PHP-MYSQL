 <?php
include 'config.php';
include 'header.php';

// session_start();

//      if(isset($_SESSION['user_id'])){
//         $id=$_SESSION['user_id'];
//      }
?>
 
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <!-- linking fontawsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style_home.css">
    <!-- linking swiper -->
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/> -->

    <style>
    .icon-heart {
        color: red; /* Change the color to red */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
        padding-right: 20px;
    }

    .icon-eye {
        color: blue; /* Change the color to blue */
        font-size: 24px; /* Change the font size to 24 pixels */
        padding-bottom: 5px;
    }
</style>
 </head>
 <body>


 


        <!-- ---------------------start------------------ -->
        <?php 

echo '<section class="featured" id="old">

<h1 class="heading"><span>Old Stuff</span></h1>

<div class="swipers featured-sliders" style="display:flex;">

<section class="gallery" id="gallery">

  <div class="box-container">';

$gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Old stuff'");

if(mysqli_num_rows($gal)>0){
    while($set=mysqli_fetch_assoc($gal)){
     
        echo '
    <div class="box">
        <img src="uploaded_img/'.$set['pImg'].'" alt="">
        <div class="content">

        <div class="icons">';

        if(isset($id)){
            echo'<a href="cart.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
        }
        else{
            echo'<a href="login.php" class="icon-heart far fa-heart"></a>';
        }
                 echo'  <a href="cart.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>
                 
                </div>

                <h3 style="font-family: cursive;">'.$set['pName'].'</h3>
                <h2 style="font-family: cursive;">'.'$'.$set['pPrice'].'/-'.'</h2>';
                if(isset($id)){
                    echo '<a href="cart.php?cart='.$set['pId'].'" class="btn1">add a cart</a>';
                }
                else{
                    echo '<a href="login.php" class="btn1">add a cart</a>';
                }
       echo ' </div>
    </div>
    ';
        
    }
}
echo '</div>
</section>
</div>
</section>';

?>
        

   

<!-- ARRIVALS -->

<?php 

echo '<section class="featured" id="arrival">

<h1 class="heading"><span>Arrivals</span></h1>

<div class="swipers featured-sliders" style="display:flex;">

<section class="gallery" id="gallery">

  <div class="box-container">';

$gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='New Arrivals'");

if(mysqli_num_rows($gal)>0){
    while($set=mysqli_fetch_assoc($gal)){
     
        echo '
    <div class="box">
        <img src="arrivals/'.$set['pImg'].'" alt="">
        <div class="content">

        <div class="icons">';

        if(isset($id)){
            echo'<a href="cart.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
        }
        else{
            echo'<a href="login.php" class="icon-heart far fa-heart"></a>';
        }
                 echo'  <a href="cart.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>
                 
                </div>

                <h3 style="font-family: cursive;">'.$set['pName'].'</h3>
                <h2 style="font-family: cursive;">'.'$'.$set['pPrice'].'/-'.'</h2>';
                if(isset($id)){
                    echo '<a href="cart.php?cart='.$set['pId'].'" class="btn1">add a cart</a>';
                }
                else{
                    echo '<a href="login.php" class="btn1">add a cart</a>';
                }
       echo ' </div>
    </div>
    ';
        
    }
}
echo '</div>
</section>
</div>
</section>';

?>

<!-- FEATURED -->
<!-- <a style="width: 120px; margin-left: 20px;" href="admin.php?order2="asc">" class="option-btn">Ascending</a> -->
<?php 

echo '<section class="featured" id="featured">

<h1 class="heading"><span>Featured Stationery Items</span></h1>

<div class="swipers featured-sliders" style="display:flex;">

<section class="gallery" id="gallery">

  <div class="box-container">';

$gal=mysqli_query($conn,"SELECT *FROM items WHERE pOption='Featured Stationery Items'");

if(mysqli_num_rows($gal)>0){
    while($set=mysqli_fetch_assoc($gal)){
     
        echo '
    <div class="box">
        <img src="featured/'.$set['pImg'].'" alt="">
        <div class="content">

        <div class="icons">';

       
        if(isset($id)){
            echo'<a href="cart.php?wish='.$set['pId'].'" class="icon-heart far fa-heart"></a>';
        }
        else{
            echo'<a href="login.php" class="icon-heart far fa-heart"></a>';
        }
                 echo'  <a href="cart.php?view='.$set['pId'].'" class="icon-eye far fa-eye"></a>
                 
                </div>

                <h3 style="font-family: cursive;">'.$set['pName'].'</h3>
                <h2 style="font-family: cursive;">'.'$'.$set['pPrice'].'/-'.'</h2>';
                if(isset($id)){
                    echo '<a href="cart.php?cart='.$set['pId'].'" class="btn1">add a cart</a>';
                }
                else{
                    echo '<a href="login.php" class="btn1">add a cart</a>';
                }
       echo ' </div>
    </div>
    ';    
    }
}
echo '</div>
</section>
</div>
</section>';
?>



<!-- /////////////// -->
<?php 
    // $show = mysqli_query($conn, "SELECT * FROM `items`");
    // if(mysqli_num_rows($show) > 0){
    //   while( $add = mysqli_fetch_assoc($show)){

    //     echo ' <div class="swiper-wrapper" style="display:flex; border:solid; width:180px">

    //     <div class="swiper-slide box">
    //         <div class="icons">


    //             <a href="#" class="fa-solid fa-magnifying-glass"></a>
    //             <a href="#" class="fa-regular fa-heart"></a>
    //             <a href="#" class="fa-regular fa-eye"></a>
    //         </div>
    //         <div class="image">
    //             <img src="uploaded_img/'.$add['pImg'].'" alt="" style="width: 100px;">
    //         </div>
    //         <div class="content">
    //             <h3>'.$add['pName'].'</h3>
    //             <h3>'.$add['pDesc'].'</h3>
    //             <h3>'.$add['pQuantity'].'</h3>
                
    //             <div class="price">'.$add['pPrice'].'<span>Rs.560</span></div>
    //             <a href="#" class="btn">Add to Cart</a>
    //         </div>
    //     </div>

         
    // </div>';
    //   }}
    ?>


 <!-- </div>

            <div class="box-container">
            <div class="box">
                <img src="images/back.jpg" alt="">
                <div class="content">
                    <h3>best spares</h3>
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Est, pariatur? Consequatur dignissimos reprehenderit voluptates. Quia.</p>
                    <a href="" class="btn">buy now</a>
                </div>
            </div>
-->


<!-- ///////////////// -->



<!-- script -->

<script src="index.js"></script>

<!-- view popup -->

<section class="viewbox">

  <div class="infobox">

  <?php 
if(isset($_GET['view'])){
    $viewId=$_GET['view'];

    $info= mysqli_query($conn, "SELECT * FROM `items` WHERE pId = $viewId");
    if(mysqli_num_rows($info) > 0){
      while( $dis = mysqli_fetch_assoc($info)){

        if(isset($id)){
            echo'<a href="cart.php?wish='.$dis['pId'].'" class="icon-heart far fa-heart"></a>';
        }
        else{
            echo'<a href="login.php" class="icon-heart far fa-heart"></a>';
        }
        echo '<a href="cart.php?close='.$dis['pId'].'" class="icon-eye fas fa-times"></a>'."<br>";
         
        if($dis['pOption']=='Featured Stationery Items'){
            echo '<img src="featured/'.$dis['pImg'].'" width="444px" alt="">';
            }
      
            if($dis['pOption']=='New Arrivals'){
             echo '<img src="arrivals/'.$dis['pImg'].'" width="444px" alt="">'; 
            }
      
            if($dis['pOption']=='Old stuff'){
             echo '<img src="uploaded_img/'.$dis['pImg'].'" width="444px" alt="">'; 
            }
           
           
           
           
           echo '
           <div style="width:444px; margin:auto;">
           <h3 style="font-size:18px">'.$dis['pName'].'</h3>
            <p style="text-align: justify; font-family: cursive; font-size:16px;text-align:center;">'.$dis['pDesc'].'</p>
            <h2 style="font-size:18px">'.'$'.$dis['pPrice'].'/-'.'</h2>';
            if(isset($id)){
                echo '<a href="cart.php?cart='.$dis['pId'].'" class="btn1">add a cart</a>';
            }
            else{
                echo '<a href="login.php" class="btn1">add a cart</a>';
            }
           echo' </div>';

            
            
            echo "<script>document.querySelector('.viewbox').style.display = 'flex';</script>";

      }}
          
    
    
}

?>
 


  </div>


</section>


<!-- footer -->
<section class="footer">

<div class="box-container">

    <div class="box">
        <h3>Our Locations</h3>
        <a href="#" ><i class="fa-solid fa-location-dot"></i>Mawanella</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Aavase</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Matara</a>
        <a href="#"><i class="fa-solid fa-location-dot"></i>Rock-view garden</a>
    </div>

    <div class="box">
        <h3>Quick Links</h3>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Home</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Featured</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Arrivals</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Reviews</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Blogs</a> 
    </div>

    <div class="box">
        <h3>Extra Links</h3>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Account info</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Order Items</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Payment Methods</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Privacy Policy</a>
        <a href="#"><i class="fa-solid fa-arrow-right"></i>Our Services</a> 
    </div>

    <div class="box">
        <h3>Contact Info</h3>
        <a href="#"><i class="fa-solid fa-phone"></i>077-0211220</a>
        <a href="#"><i class="fa-solid fa-phone"></i>077-5328271</a>
        <a href="#"><i class="fa-solid fa-envelope"></i>shiwanthafernando33879@gmail.com</a>
    </div>

</div>
<div class="share">
    <a href="#" class="fa-brands fa-facebook"></a>
    <a href="#" class="fa-brands fa-whatsapp"></a>
    <a href="#" class="fa-brands fa-linkedin"></a>
    <a href="#" class="fa-brands fa-instagram"></a>
</div>
<div class="credit">All Rights Reserved</div>
</section>



 
 
    
 </body>
 </html>