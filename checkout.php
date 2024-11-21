<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

if(isset($_POST['place_order'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   

   $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $verify_cart->execute([$user_id]);
   
   if(isset($_GET['get_id'])){

      $get_film = $conn->prepare("SELECT * FROM `film` WHERE id = ? LIMIT 1");
      $get_film->execute([$_GET['get_id']]);
      if($get_film->rowCount() > 0){
         while($fetch_f= $get_film->fetch(PDO::FETCH_ASSOC)){
            $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name,  email,film_id, price, seats) VALUES(?,?,?,?,?,?,?)");
            $insert_order->execute([create_unique_id(), $user_id, $name,  $email,  $fetch_f['id'], $fetch_f['price'], 1]);
            header('location:orders.php');
         }
      }else{
         $warning_msg[] = 'Something went wrong!';
      }

   }elseif($verify_cart->rowCount() > 0){

      while($f_cart = $verify_cart->fetch(PDO::FETCH_ASSOC)){

         $insert_order = $conn->prepare("INSERT INTO `orders`(id, user_id, name,  email,film_id, price, seats) VALUES(?,?,?,?,?,?,?)");
         $insert_order->execute([create_unique_id(), $user_id, $name,  $email,  $f_cart['id'], $f_cart['price'], $f_cart['seats']]);

      }

      if($insert_order){
         $delete_cart_id = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
         $delete_cart_id->execute([$user_id]);
         header('location:orders.php');
      }

   }else{
      $warning_msg[] = 'Your cart is empty!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/header.php'; ?>

<section class="checkout">

   <h1 class="heading">checkout summary</h1>

   <div class="row">

      <form action="" method="POST">
         <h3>billing details</h3>
         <div class="flex">
            <div class="box">
               <p>your name <span>*</span></p>
               <input type="text" name="name" required maxlength="50" placeholder="enter your name" class="input">
              
               <p>your email <span>*</span></p>
               <input type="email" name="email" required maxlength="50" placeholder="enter your email" class="input">
             </div>
            </div>
            <div class="box">
               <p>pin code <span>*</span></p>
               <input type="number" name="pin_code" required maxlength="6" placeholder="e.g. 123456" class="input" min="0" max="999999">
            </div>
         <input type="submit" value="place order" name="place_order" class="btn">
      </form>

      <div class="summary">
         <h3 class="title">cart items</h3>
         <?php
            $grand_total = 0;
            if(isset($_GET['get_id'])){
               $select_get = $conn->prepare("SELECT * FROM `film` WHERE id = ?");
               $select_get->execute([$_GET['get_id']]);
               while($fetch_get = $select_get->fetch(PDO::FETCH_ASSOC)){
         ?>
         <div class="flex">
            <img src="uploaded_files/<?= $fetch_get['image']; ?>" class="image" alt="">
            <div>
               <h3 class="name"><?= $fetch_get['name']; ?></h3>
               <p class="price"><i class="fas fa-dollar-sign"></i> <?= $fetch_get['price']; ?> x 1</p>
            </div>
         </div>
         <?php
               }
            }else{
               $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $select_cart->execute([$user_id]);
               if($select_cart->rowCount() > 0){
                  while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
                     $select_film = $conn->prepare("SELECT * FROM `film` WHERE id = ?");
                     $select_film->execute([$fetch_cart['film_id']]);
                     $fetch_film = $select_film->fetch(PDO::FETCH_ASSOC);
                     $sub_total = ($fetch_cart['seats'] * $fetch_film['price']);

                     $grand_total += $sub_total;
            
         ?>
         <div class="flex">
            <img src="uploaded_files/<?= $fetch_film['image']; ?>" class="image" alt="">
            <div>
               <h3 class="name"><?= $fetch_film['name']; ?></h3>
               <p class="price"><i class="fas fa-dollar-sign"></i> <?= $fetch_film['price']; ?> x <?= $fetch_cart['seats']; ?></p>
            </div>
         </div>
         <?php
                  }
               }else{
                  echo '<p class="empty">your cart is empty</p>';
               }
            }
         ?>
         <div class="grand-total"><span>grand total :</span><p><i class="fas fa-dollar-sign"></i> <?= $grand_total; ?></p></div>
      </div>

   </div>

</section>





<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>