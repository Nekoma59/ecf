<?php

include 'components/connect.php';
session_start();
if(isset($_SESSION["user_id"]))
    $user_id=$_SESSION["user_id"];
else
    header('location: View/login.php');



if(isset($_POST['add_to_cart'])){

   $id = create_unique_id();
   $film_id = $_POST['film_id'];
   $film_id = filter_var($film_id, FILTER_SANITIZE_STRING);
   
   
   $seats = $_POST['seats'];
   $seats = filter_var($seats, FILTER_SANITIZE_STRING);
 
   
   $verify_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ? AND film_id = ?");   
   $verify_cart->execute([$user_id, $film_id]);

   $max_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
   $max_cart_items->execute([$user_id]);

   if($verify_cart->rowCount() > 0){
      $warning_msg[] = 'Already added to cart!';
   }elseif($max_cart_items->rowCount() == 10){
      $warning_msg[] = 'Cart is full!';
   }else{

      $select_price = $conn->prepare("SELECT * FROM `film` WHERE id = ? LIMIT 1");
      $select_price->execute([$film_id]);
      $fetch_price = $select_price->fetch(PDO::FETCH_ASSOC);

      $insert_cart = $conn->prepare("INSERT INTO `cart`(id, user_id, film_id, price, seats) VALUES(?,?,?,?,?)");
      $insert_cart->execute([$id, $user_id, $film_id,$fetch_price['price'], $seats]);
      $success_msg[] = 'Added to cart!';
   }

}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CinEPhoria</title>
    
  


    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<!-- header section starts  -->

<header class="header">

<a href="add_film.php" class="logo">
        <img src="images/logo.png" alt="">
    </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
      
        <a href="#films">films</a>
        <a href="#events">events</a>
        <a href="#review">review</a>
        <a href="#contact">contact</a>
         <a href="orders.php">my orders</a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="shopping_cart.php" class="cart-btn">cart<span>                       <?= $total_cart_items; ?>          </span></a>
         <a href="View/updateuser.php">update account</a>
         <a href="View/deleteuser0.php">Delete account</a>
      </nav>
        <!--<a href="#blogs">blogs</a>-->
    </nav>

    <div class="icons">
        <div class="fas fa-search" id="search-btn"></div>
       
        <div class="fas fa-bars" id="menu-btn"></div>
        <a href="logout.php" class="fas fa-sign-out-alt"></a>
       
        
    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

</header>


<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="content">
        <h3>It's The Great Art Theater</h3>
        <p>Plus Qu'Un Simple Théâtre</p>
       
    </div>

</section>

<!-- home section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>

        <div class="content">
            <h3>what makes our cinema special?</h3>
            <p>Our cinema is special because we offer a unique and immersive movie-going experience that is designed to transport our audience into the world of the films they are watching.</p>
            
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->


<!-- Film section starts -->

<section class="films" id="films">

    <h1 class="heading"> our <span>films</span> </h1>
    <div class="box-container">

    <?php 
      $select_film = $conn->prepare("SELECT * FROM `film`");
      $select_film->execute();
      if($select_film->rowCount() > 0){
         while($fetch_film = $select_film->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="POST" class="box">
      <img src="uploaded_files/<?= $fetch_film['image']; ?>" class="image" alt="">
      <h3 class="name"><?= $fetch_film['name'] ?></h3>
      <input type="hidden" name="film_id" value="<?= $fetch_film['id']; ?>">
      <div class="flex">
         <p class="price">Dt  <?= $fetch_film['price'] ?></p>
         <input type="number" name="seats" required min="1" value="1" max="99" maxlength="2" class="seats">
    
        </div>
      <input type="submit" name="add_to_cart" value="add to cart" class="btn">
      
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>
      
             
   </div>
 

</section>


<!-- Film section ends -->

<!-- events section starts  -->


<section class="events" id="events">

    <h1 class="heading"> our <span>events</span> </h1>

    <div class="box-container">

        <div class="box">
            <div class="image">
                <img src="images/blog-1.png" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">conférence</a>
                <span>by admin / 21st may, 2021</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="images/blog-2.png" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">séminaire</a>
                <span>by admin / 21st may, 2021</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

        <div class="box">
            <div class="image">
                <img src="images/blog-3.png" alt="">
            </div>
            <div class="content">
                <a href="#" class="title">évènement associative</a>
                <span>by admin / 21st may, 2021</span>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, dicta.</p>
                <a href="#" class="btn">read more</a>
            </div>
        </div>

    </div>

</section>

<!-- events section ends -->


<!-- review section starts  -->

<section class="review" id="review">

    <h1 class="heading"> <span>CUSTOMER'S</span> REVIEW </h1>

    <div class="row">

        <form action="">
            <h3>comment</h3>
            
            <div class="inputBox">
                <label for="comment"></label>
               <textarea id="comment" name="comment"></textarea>
                </div>
               
            <a href="..." class="btn">see comments</a> <!--tekteb fi blasset  ... esm el page -->
            <input type="submit" value="submit" class="btn">
        </form>

    </div>

</section>

<!-- review section ends -->

<!-- contact section starts  -->

<section class="contact" id="contact">

    <h1 class="heading"> <span>contact</span> us </h1>

    <div class="row">

        <iframe class="map" src="https://www.google.com/maps/place/ESPRIT/@36.8981804,10.1878963,16.99z/data=!4m10!1m2!2m1!1sESPRIT!3m6!1s0x12e2cb7454c6ed51:0x683b3ab5565cd357!8m2!3d36.8992878!4d10.1893674!15sCgZFU1BSSVQiA4gBAZIBEnByaXZhdGVfdW5pdmVyc2l0eeABAA!16s%2Fg%2F11bwdw7k77?authuser=0" allowfullscreen="" loading="lazy"></iframe>

        <form action="">
            <h3>get in touch</h3>
            <div class="inputBox">
                <span class="fas fa-user"></span>
                <input type="text" placeholder="name">
            </div>
            <div class="inputBox">
                <span class="fas fa-envelope"></span>
                <input type="email" placeholder="email">
            </div>
            <div class="inputBox">
                <span class="fas fa-phone"></span>
                <input type="number" placeholder="number">
            </div>
            <input type="submit" value="contact now" class="btn">
        </form>

    </div>

</section>

<!-- contact section ends -->


<!-- footer section starts  -->

<section class="footer">

    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
        <a href="#" class="fab fa-pinterest"></a>
    </div>

    <div class="links">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#films">films</a>
        <a href="#review">review</a>
        <a href="#event">events</a>
        <a href="#contact">contact</a>
       
    </div>

    <div class="credit">created by <span>...</span> | all rights reserved</div>

</section>

<!-- footer section ends -->
<!-- custom js file link  -->
<script src="js/script.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/alert.php'; ?>

</body>
</html>