<?php


require_once("config.php");
if (!isset($_SESSION["login_sess"])) {
    header("location:login.php");
}


if(isset($_POST['order'])){

    $name = mysqli_real_escape_string($dba, $_POST['name']);
    $number = mysqli_real_escape_string($dba, $_POST['number']);
    $email = mysqli_real_escape_string($dba, $_POST['email']);
    $address = mysqli_real_escape_string($dba, $_POST['address'].', '. $_POST['country'].' - '. $_POST['pin_code']);
    $placed_on = date('d-M-Y');
    $total = 0;
    $cart_products[] = '';
    $cart_query = mysqli_query($mydb, "SELECT * FROM `cart`") or die('query failed');
    if(mysqli_num_rows($cart_query) > 0){
        while($cart_item = mysqli_fetch_assoc($cart_query)){
            $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
            $sub_total = ($cart_item['price'] * $cart_item['quantity']);
            $total += $sub_total;
        }
    }
    $total_products = implode(', ',$cart_products);
    $order_query = mysqli_query($dba, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND address = '$address' AND totprod = '$total_products' AND totprice = '$total'") or die('query failed');

    if($total == 0){
        $message[] = 'Your cart is empty!';
    }
    else{
        mysqli_query($dba, "INSERT INTO `orders` (name, number, email, address, totprod, totprice, orderdt) VALUES('$name', '$number', '$email', '$address', '$total_products', '$total', '$placed_on')") or die('query failed');
        mysqli_query($dba, "DELETE FROM `cart`") or die('query failed');
        $message[] = 'Order placed successfully!';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

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

<h1>CHECKOUT FORM</h1>

<section class="checkout">

    <form action="" method="POST">
        <div class="flex">
            <div class="inputBox">
                <span>Full name :</span>
                <input type="text" name="name">
            </div>
            <div class="inputBox">
                <span>Phone number :</span>
                <input type="number" name="number" min="0">
            </div>
            <div class="inputBox">
                <span>E-mail :</span>
                <input type="email" name="email">
            </div>
            <div class="inputBox">
                <span>Address:</span>
                <input type="text" name="address">
            </div>
            <div class="inputBox">
                <span>Country :</span>
                <input type="text" name="country">
            </div>
            <div class="inputBox">
                <span>Pincode :</span>
                <input type="number" min="0" name="pin_code">
            </div>
        </div>
        <input type="submit" name="order" value="Order now" class="btn">

    </form>

</section>








<script src="js/ascript.js"></script>

</body>
</html>