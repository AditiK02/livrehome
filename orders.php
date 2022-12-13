<?php
require_once("config.php");
if (!isset($_SESSION["login_sess"])) {
    header("location:login.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="prifilelog.css">

</head>
<body>
   
<section>
  <nav>

    <div class="logo">
      <img src="image/logo.png">
   </div>
    <ul>
        <li><a href="proj.html">Home</a></li>
        <li><a href="Arrivals.html">Arrivals</a></li>
        <li><a href="Reviews.html">Reviews</a></li>
        <li><a href="Blog.html">Blogs</a></li>
        <li><a href="About.html">About</a></li>
        <li><a href="account.php">Profile</a></li>
    </ul>

    <div class="social_icon">
        <i class="fa-solid fa-magnifying-glass"></i>
        <i class="fa-solid fa-heart"></i>
    </div>

 </nav>
</section>

<h1>YOUR ORDERS</h1>

<section class="placed-orders">
    <div class="box-container">

    <?php
        $select_orders = mysqli_query($mydb, "SELECT * FROM `orders`") or die('query failed');
        if(mysqli_num_rows($select_orders) > 0){
            while($fetch_orders = mysqli_fetch_assoc($select_orders)){
    ?>
    <div class="box">
        <p> Order Date: <?php echo $fetch_orders['orderdt']; ?></p>
        <p> Name: <?php echo $fetch_orders['name']; ?></p>
        <p> Phone number: <?php echo $fetch_orders['number']; ?></p>
        <p> E-mail: <?php echo $fetch_orders['email']; ?></p>
        <p> Address: <?php echo $fetch_orders['address']; ?></p>
        <p> Your orders: <?php echo $fetch_orders['totprod']; ?></p>
        <p> Total price: ₹<?php echo $fetch_orders['totprice']; ?></p>
        <p> Payment status: Payment on delivery</p>
    </div>
    <?php
        }
    }else{
        echo '<p class="empty">No orders placed yet!</p>';
    }
    ?>
    </div>

</section>



<script src="js/ascript.js"></script>

</body>
</html>