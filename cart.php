
<?php
require_once("config.php");
if (!isset($_SESSION["login_sess"])) {
    header("location:login.php");
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];
    mysqli_query($mydb, "DELETE FROM `cart` WHERE id = '$delete_id'") or die('query failed');
    header('location:cart.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>

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
        <a href="cart.php"><i class="fas fa-shopping-cart"></i></a>
    </div>

 </nav>
</section>



    <h1>SHOPPING CART</h1>

    <section class="shopping-cart">

        <div class="box-container">

            <?php
            $total = 0;
            $select_cart = mysqli_query($dbc,"SELECT * FROM `cart`") or die('query failed');
            if (mysqli_num_rows($select_cart) > 0) {
                while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
            ?>
                    <div class="box">
                        <a href="cart.php?delete=<?php echo $fetch_cart['id']; ?>" class="fas fa-times" onclick="return confirm('delete this from cart?');"></a>

                        <div class="name"><?php echo $fetch_cart['name']; ?></div>
                        <div class="price">₹<?php echo $fetch_cart['price']; ?></div>
                        <div class="sub-total"> Product total: ₹<?php echo $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></div>
                    </div>
            <?php
                    $total += $sub_total;
                }
            } else {
                echo '<p class="empty">Cart is empty</p>';
            }
            ?>
        </div>
        <div class="cart-total">
            <p>Grand total: ₹<?php echo $total; ?></p>
            <a href="proj.html" class="option-btn">Continue shopping</a>
            <a href="checkout.php" class="btn  <?php echo ($grand_total > 1) ? '' : 'disabled' ?>">Checkout</a>
        </div>

    </section>

   

    <script src="ascript.js"></script>
</body>
</html>