<?php 
     include 'config.php';
     session_start();
      

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
    <title>login</title>
      <!-- linking style sheets -->
      <link rel="stylesheet" href="style_home_sign.css">
</head>
<body>
<div class="sign-form-container">
        <div id="close-login-btn" class="fa-solid fa-xmark"></div>
        <form action=""  method="POST" enctype="multipart/form-data">
                                         
                  
                   <h3>Login</h3>;
                <?php
                   if(isset($message)){
                    foreach($message as $message){
                       echo '<div class="message">'.$message.'</div>';
                    }
                 }
                 else{
                    echo '<div class="message">info error</div>';
                 }

                 ?>
                    <span>User Email</span>
                    <input type="email" name="lemail" class="box" placeholder="Enter your email"  required>
                    <span>Password</span>
                    <input type="password" name="lpass" class="box" placeholder="Enter your password" required>
                     
                    <input type="submit" name="submit" value="login" class="btn" >
                    <p>Fogot passowrd?<a href="#">Click here</a></p>

                  
               
               
                <!-- <div class="checkbox">
                         <input type="checkbox" name="" id="remember-me">
                         <label for="remember-me">Remember Me</label>
                     </div> -->
           
            <p>Don't have an account? <a href="sign.php">Create an account</a></p>
        </form>
    </div>


    
</body>
</html>