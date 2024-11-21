<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   setcookie('user_id', create_unique_id(), time() + 60*60*24*30);
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>My Orders</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">

   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   



<section class="orders">

   <h1 class="heading">my orders</h1>

   <div class="box-container">

      <?php
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE user_id = ? ORDER BY date DESC");
      $select_orders->execute([$user_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
            $select_film = $conn->prepare("SELECT * FROM `film` WHERE id = ?");
            $select_film->execute([$fetch_orders['film_id']]);
            if($select_film->rowCount() > 0){
               while($fetch_film = $select_film->fetch(PDO::FETCH_ASSOC)){
      ?>
    <div class="box" <?php if($fetch_ordesr['status'] == 'canceled'){echo 'style="border:.2rem solid red";';}; ?>>
      <a href="view_order.php?get_id=<?= $fetch_orders['id']; ?>">
         <p class="date"><i class="fa fa-calendar"></i><span><?= $fetch_orders['date']; ?></span></p>
         <img src="uploaded_files/<?= $fetch_film['image']; ?>" class="image" alt="">
         <h3 class="name"><?= $fetch_film['name']; ?></h3>
         <p class="price"><i class="fas fa-dollar-sign"></i> <?= $fetch_orders['price']; ?> x <?= $fetch_orders['seats']; ?></p>
         <p class="status" style="color:<?php if($fetch_orders['status'] == 'delivered'){echo 'green';}elseif($fetch_orders['status'] == 'canceled'){echo 'red';}else{echo 'orange';}; ?>"><?= $fetch_orders['status']; ?></p>
      </a>
   </div>
   <?php
            }
         }
      }
   }else{
      echo '<p class="empty">no orders found!</p>';
   }
   ?>

   </div>

</section>














<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>



<script src="js/script.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>