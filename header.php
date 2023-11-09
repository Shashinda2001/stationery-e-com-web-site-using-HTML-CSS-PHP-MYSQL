<?php 
     include 'config.php';
     session_start();

     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];

        $wishcheck=mysqli_query($conn,"SELECT*FROM wish_list_users WHERE userId='$id'");

        $cartcheck=mysqli_query($conn,"SELECT*FROM cart_list_users WHERE userId='$id'");
       
        if(mysqli_num_rows($wishcheck)==0){     
            $create=mysqli_query($conn,"CREATE TABLE wish_list_".$id." (
                wishId INT AUTO_INCREMENT PRIMARY KEY,
                pId VARCHAR(255) NOT NULL, 
                product_name VARCHAR(255) NOT NULL)");

                mysqli_query($conn,"INSERT INTO wish_list_users(userId) VALUES ('$id')");
        }

        // if(mysqli_num_rows($cartcheck)==0){
        //     $create=mysqli_query($conn,"CREATE TABLE cart_list_".$id." (
        //         cartId INT AUTO_INCREMENT PRIMARY KEY,
        //         pId VARCHAR(255) NOT NULL, 
        //         pName VARCHAR(255) NOT NULL,
        //         pPrice INT(255) NOT NULL,
        //         pQuantityget INT(255))");

        //         mysqli_query($conn,"INSERT INTO cart_list_users(userId) VALUES ('$id')");

        // }
          
     }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<header class="header">
        <div class="header-1">
            <img src="logo.png" height="50px" width="150px">
            <form action="" class="search-form">
                <input type="search" name="" id="search-box" placeholder="Search">
                <label for="search-box" class="fa-solid fa-magnifying-glass"></label>
            </form>
            <div class="icons">
                <div id="search-btn" class="fa-solid fa-magnifying-glass"></div>
               <a href="cart.php" id="shopping-cart"><i class="fa-solid fa-cart-shopping"></i></a>
                <div id="login-btn" class="fa-solid fa-user"></div>
            </div>
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="home_page.php#home">Home</a>
                <a href="home_page.php#featured">Featured</a>
                <a href="home_page.php#arrivals">Arrivals</a>
                <a href="home_page.php#reviews">Reviews</a>
                <a href="home_page.php#blogs">Blogs</a>
                <?php

if(isset($_SESSION['user_id'])){
                $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['userEmail'];
                $p= $row['userPassword'];

                $take=mysqli_query($conn,"SELECT *FROM admin_info WHERE adminMail='$u' and adminPass='$p'");
                if(mysqli_num_rows($take)>0){
                    echo '<a href="admin.php">admin panel</a>';  
            
                } 
                           
            }
                ?>
               
               
            </nav>
        </div>
    </header>

    <nav class="bottom-navbar">
        <a href="home_page.php#home" class="fa-solid fa-house"></a>
        <a href="home_page.php#featured" class="fa-solid fa-list-ul"></a>
        <a href="home_page.php#arrivals" class="fa-solid fa-tag"></a>
        <a href="home_page.php#reviews" class="fa-regular fa-comment"></a>
        <a href="home_page.php#blogs" class="fa-brands fa-blogger"></a>
        <?php

if(isset($_SESSION['user_id'])){
                $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
                $row=mysqli_fetch_assoc($choose);

                $u=$row['userEmail'];
                $p= $row['userPassword'];

                $take=mysqli_query($conn,"SELECT *FROM admin_info WHERE adminMail='$u' and adminPass='$p'");
                if(mysqli_num_rows($take)>0){
                    echo'<a href="admin.php" class="fas fa-user-shield"></a>';  
            
                } 
                           
            }
                ?>

    </nav>
    
</body>
</html>