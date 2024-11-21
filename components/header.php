<header class="header">

<a href="add_film.php" class="logo">
        <img src="images/logo.png" alt="">
    </a>

    <nav class="navbar">
        <a href="_index.php#home">home</a>
        <a href="_index.php#about">about</a>
      
        <a href="_index.php#films">films</a>
        <a href="_index.php#events">events</a>
        <a href="_index.php#review">review</a>
        <a href="_index.php#contact">contact</a>
         <a href="orders.php">my orders</a>
         <?php
            $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $count_cart_items->execute([$user_id]);
            $total_cart_items = $count_cart_items->rowCount();
         ?>
         <a href="shopping_cart.php" class="cart-btn">cart<span>                       <?= $total_cart_items; ?>          </span></a>
      </nav>
  
    </nav>

    <div class="icons">
        <div class="fas fa-search" id="search-btn"></div>
       
        <div class="fas fa-bars" id="menu-btn"></div>
        <a href="index.html" class="fas fa-sign-out-alt"></a>
       
        
    </div>

    <div class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </div>

</header>
