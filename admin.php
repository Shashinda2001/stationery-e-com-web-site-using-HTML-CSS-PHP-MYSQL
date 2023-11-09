<?php 
     include 'config.php';
     session_start();


     if(isset($_SESSION['user_id'])){
        $id=$_SESSION['user_id'];
     }

     if(isset($_SESSION['user_id'])){
        $choose=mysqli_query($conn,"SELECT *FROM userinfo WHERE userId='$id'");
        $row=mysqli_fetch_assoc($choose);

        $u=$row['userEmail'];
        $p= $row['userPassword'];

        $take=mysqli_query($conn,"SELECT *FROM admin_info WHERE adminMail='$u' and adminPass='$p'");
        if(!mysqli_num_rows($take)>0){
            header('Location:home_page.php');
    
        }     
                   
    }
    else{
        header('Location:home_page.php');
    }



    if(isset($_POST['submit'])){

        $product=$_POST['name'];
        $quantity=$_POST['quantity'];
        $descript=$_POST['description'];
        $price=$_POST['price'];
        $option=$_POST['option'];
        $p_image = $_FILES['p_image']['name'];
        $p_image_tmp_name = $_FILES['p_image']['tmp_name'];
        $p_image_folder = 'uploaded_img/'.$p_image;
        $p_image_folder_arrivals = 'arrivals/'.$p_image;
        $p_image_folder_featured = 'featured/'.$p_image;

        $check=mysqli_query($conn,"SELECT *FROM items WHERE pName='$product' and pOption='$option'");

        if(mysqli_num_rows($check)>0){
            $row=mysqli_fetch_assoc($check);
            $quantity=$quantity+$row['pQuantity'];
            $id=$row['pId'];
          
            $add=mysqli_query($conn,"UPDATE items SET  pQuantity='$quantity',pDesc='$descript',pPrice='$price',pImg='$p_image' WHERE pId='$id'");
            if($add){
                if($option=='New Arrivals'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_arrivals);
                    $message[]='product add succesfully into folder_arrivals';
                  }

                
                else if($option=='Featured Stationery Items'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_featured);
                    $message[]='product add succesfully into folder_featured';
                    
                }
                else if($option=='Old stuff'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder);
                    $message[]='product add succesfully into folder_uploaded';
                    
                }
                

            }
            else{
                $message[]='not updated';
            }

           
        }
        else{

        

        $insert=mysqli_query($conn,"INSERT INTO items(pName,pQuantity,pDesc,pPrice,pOption,pImg)
           VALUES('$product','$quantity','$descript','$price','$option','$p_image')") or die('query failed');

           if($insert){
                if($option=='New Arrivals'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_arrivals);
                    $message[]='product add succesfully into folder_arrivals';
                  }

                
                else if($option=='Featured Stationery Items'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder_featured);
                    $message[]='product add succesfully into folder_featured';
                    
                }
                else if($option=='Old stuff'){
                    move_uploaded_file($p_image_tmp_name,$p_image_folder);
                    $message[]='product add succesfully into folder_uploaded';
                    
                }

            }
            else{
                $message[]='image not uploaded';
            }
           

        } 
           



    }

    //  delete 

    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $delete_query = mysqli_query($conn, "DELETE FROM `items` WHERE pId = $delete_id ") or die('query failed');
        if($delete_query){
        //    header('location:admin.php');
           $message[] = 'product has been deleted';
        }else{
        //    header('location:admin.php');
           $message[] = 'product could not be deleted';
        }
     }

     //  desc and asc 

     if(isset($_GET['order1'])){
        $_SESSION['order']='desc';
        $select_products = mysqli_query($conn, "SELECT * FROM `items` ORDER BY pID desc");
     }

     else if(isset($_GET['order2'])){
        $_SESSION['order']='asc';
        $select_products = mysqli_query($conn, "SELECT * FROM `items` ORDER BY pID asc");
     }
     else if(isset($_SESSION['order'])){
       $order=$_SESSION['order'];
       $select_products = mysqli_query($conn, "SELECT * FROM `items` ORDER BY pID $order");
     }
     else{
        $select_products = mysqli_query($conn, "SELECT * FROM `items` ORDER BY pID desc");
     }


    //  update 

       if(isset($_POST['update_product'])){

         $update_id = $_SESSION['upid'];
        //  $message[]=$update_p_id;
        //  header('location:admin.php');

         $update_p_name = $_POST['update_p_name'];
         $update_p_quantity = $_POST['update_p_quantity'];
         $update_p_description = $_POST['update_p_description'];

         $update_p_price = $_POST['update_p_price'];
         $update_p_option = $_POST['update_p_option'];
         $update_p_image = $_FILES['update_p_image']['name'];
         $update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
         
         $update_p_uploaded_img= 'uploaded_img/'.$update_p_image;
         $update_p_arrivals = 'arrivals/'.$update_p_image;
         $update_p_featured = 'featured/'.$update_p_image;

         $update_query = mysqli_query($conn, "UPDATE items SET pName = '$update_p_name', pQuantity='$update_p_quantity', pDesc=' $update_p_description', pOption='$update_p_option', pPrice = '$update_p_price', pImg = '$update_p_image' WHERE pId = '$update_id'");
         
         if($update_query){
           

            if($update_p_option=='New Arrivals'){
                move_uploaded_file($update_p_image_tmp_name, $update_p_arrivals);
                $message[] = 'product updated succesfully';
                header('location:admin.php');
              }

            
            else if($update_p_option=='Featured Stationery Items'){
                move_uploaded_file($update_p_image_tmp_name,$update_p_featured);
                $message[] = 'product updated succesfully';
               header('location:admin.php');
            }
            else if($update_p_option=='Old stuff'){
                move_uploaded_file($update_p_image_tmp_name,$update_p_uploaded_img);
                $message[] = 'product updated succesfully';
                header('location:admin.php');
                
            }
            else{
                $message[] = 'product picture not updated';
                header('location:admin.php');
            }
         }
       }
       
         
     
         
     
     

     // rest
     if(isset($_GET['cancel'])){

        echo "<script>document.querySelector('.edit-form-container').style.display = 'none';</script>";
        // echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
     }


     
?>

   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>

     <!-- linking fontawsome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style_home_sign.css">
    <!-- linking style sheets -->
    <link rel="stylesheet" href="style_home.css">
    <!-- linking swiper -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
</head>
<body>
<header class="header">
        <div class="header-1">
            <img src="logo.png" height="50px" width="150px">
            
            
        </div>

        <div class="header-2">
            <nav class="navbar">
                <a href="home_page.php">Home</a>
                <a href="home_page.php#featured">Featured</a>
                <a href="home_page.php#arrivals">Arrivals</a>
                <a href="home_page.php#reviews">Reviews</a>
                <a href="home_page.php#blogs">Blogs</a>
                <a href="admin.php">admin panal</a>
                 
               
               
            </nav>
        </div>
    </header>

      <!-- add product -->
      <div class="product-container">
        <div id="" class="signdiv"></div>
        <form action="" method="POST" enctype="multipart/form-data">

            <h3>add product</h3>

            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>

      <div class="indiv">
      <span>product name</span>
            <input type="text" name="name" class="box" placeholder="name" id="" required>
            <span>quantity</span>
            <input type="number" name="quantity" class="box" placeholder="quantity" id="" required>
            <span>description</span>
            <input type="text" name="description" class="box" placeholder="description" id="" required>
           


      </div>

      <div class="indiv">
      <span>price</span>
            <input type="number" min="0" name="price" class="box" placeholder="price" id="" required>

        
        <span>select option</span>
        <select id="" name="option" class="box">
        
            <option   value="Featured Stationery Items">Featured Stationery Items</option>
            <option   value="New Arrivals">New Arrivals</option>
            <option   value="Old stuff">Old stuff</option>
        </select>

      <span>image</span>     
            <input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>       
            

      </div>

      <input type="submit" name="submit" value="add" class="btn" >
            
           
           
             
        </form>
    </div>



    <!-- filter -->

    <a style="width: 120px; float:right; margin-right: 20px;" href="admin.php?order1='desc'>" class="option-btn">Descending</a>
    <a style="width: 120px; margin-left: 20px;" href="admin.php?order2='asc'>" class="option-btn">Ascending</a>
   
    
    <!-- product table -->
<section class="display-product-table" style="margin-bottom: 40px;">

<table>

   <thead>
      <th>image</th>
      <th>product</th>
      <th>type</th>
      <th>quantity</th>
      <th>description</th>
      <th>price</th>
      <th>action</th>
   </thead>

   <tbody>
      <?php
      
        //  $select_products = mysqli_query($conn, "SELECT * FROM `items` ORDER BY pID desc");
         if(mysqli_num_rows($select_products) > 0){
            while($row = mysqli_fetch_assoc($select_products)){
      ?>

      <tr>


      <?php
       if($row['pOption']=='Featured Stationery Items'){
       echo '<td><img src="featured/'.$row['pImg'].'" height="100" alt=""></td>';
       }
 
       if($row['pOption']=='New Arrivals'){
        echo '<td><img src="arrivals/'.$row['pImg'].'" height="100" alt=""></td>'; 
       }
 
       if($row['pOption']=='Old stuff'){
        echo '<td><img src="uploaded_img/'.$row['pImg'].'" height="100" alt=""></td>'; 
       } 
      
      ?>
         <td><?php echo $row['pName']; ?></td>
         <td><?php echo $row['pOption']; ?></td>
         <td><?php echo $row['pQuantity']; ?></td>
         <td><?php echo $row['pDesc']; ?></td>
         <td>$<?php echo $row['pPrice']; ?>/-</td>
         <td>
         <a href="admin.php?delete=<?php echo $row['pId']; ?>" class="delete-btn" onclick="return confirm('are your sure you want to delete this?');"> <i class="fas fa-trash"></i> delete</a>
            <a href="admin.php?edit=<?php echo $row['pId']; ?>" class="option-btn"> <i class="fas fa-edit"></i> update </a>
         </td>
      </tr>

      <?php
         };    
         }
         else{
            echo "<div class='empty'>no product added</div>";
         };
      ?>
   </tbody>
</table>

</section>

<!-- edit form -->

</section>

<section class="edit-form-container">

   <?php
   
   if(isset($_GET['edit'])){
      $edit_id = $_GET['edit'];
      $edit_query = mysqli_query($conn, "SELECT * FROM `items` WHERE pId = $edit_id");
      if(mysqli_num_rows($edit_query) > 0){
        while( $fetch_edit = mysqli_fetch_assoc($edit_query)){
            
   ?>

   <form action="" method="post" enctype="multipart/form-data">
       
      <?php
       if($fetch_edit['pOption']=='Featured Stationery Items'){
       echo '<img src="featured/'.$fetch_edit['pImg'].'" height="100" alt="">';
       }
 
       if($fetch_edit['pOption']=='New Arrivals'){
        echo '<img src="arrivals/'.$fetch_edit['pImg'].'" height="100" alt="">'; 
       }
 
       if($fetch_edit['pOption']=='Old stuff'){
        echo '<img src="uploaded_img/'.$fetch_edit['pImg'].'" height="100" alt="">'; 
       } 
      
      ?>
      <input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['pName']; ?>">
      <input type="number" min="0" class="box" required name="update_p_quantity" value="<?php echo $fetch_edit['pQuantity']; ?>">
      <input type="text" class="box" required name="update_p_description" value="<?php echo $fetch_edit['pDesc']; ?>">
      <input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['pPrice']; ?>">

      <select id="" name="update_p_option" class="box">
        
            <option   value="Featured Stationery Items">Featured Stationery Items</option>
            <option   value="New Arrivals">New Arrivals</option>
            <option   value="Old stuff">Old stuff</option>
        </select>
      
      <?php $_SESSION['upid']=$fetch_edit['pId']; ?>  
      <input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
      <input type="submit" value="update the prodcut" name="update_product" class="btn">
       
      <a href="admin.php?reset='reset'" class="btn">cansel</a>
   </form>

   <?php
            
         };
        };
         echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
      };
   ?>

</section>






<!-- ////////////////////////////////////bottom nan -->


   
<nav class="bottom-navbar">

 

        <a href="home_page.php" class="fa-solid fa-house"></a>
        <a href="home_page.php#featured" class="fa-solid fa-list-ul"></a>
        <a href="#home_page.php#arrivals" class="fa-solid fa-tag"></a>
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