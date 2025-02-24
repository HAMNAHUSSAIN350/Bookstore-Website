<?php
include 'connection.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
header('location:login.php');
}

if(isset($_POST['order_btn'])){
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $number = $_POST['number'];
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $method = mysqli_real_escape_string($conn, $_POST['method']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $placed_on = date('d-M-Y');

  $cart_total = 0;
  $cart_products[] = '';

  $cart_query = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
   if(mysqli_num_rows($cart_query) > 0){
      while($cart_item = mysqli_fetch_assoc($cart_query)){
         $cart_products[] = $cart_item['name'].' ('.$cart_item['quantity'].') ';
         $sub_total = ($cart_item['price'] * $cart_item['quantity']);
         $cart_total += $sub_total;
      }
   }

   $total_products = implode(' ',$cart_products);

   $order_query = mysqli_query($conn, "SELECT * FROM `orders` WHERE name = '$name' AND number = '$number' AND email = '$email' AND method = '$method' AND address = '$address' AND total_products = '$total_products' AND total_price = '$cart_total'") or die('query failed');

   if($cart_total == 0){
      $message[] = 'your cart is empty';
   }else{
      if(mysqli_num_rows($order_query) > 0){
         $message[] = 'order already placed!'; 
      }else{
         mysqli_query($conn, "INSERT INTO `orders`(user_id, name, number, email, method, address, total_products, total_price, placed_on) VALUES('$user_id', '$name', '$number', '$email', '$method', '$address', '$total_products', '$cart_total', '$placed_on')") or die('query failed');
         $_SESSION['order_message'] = 'Order placed successfully!';
         mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
      }
   }
}
?>

<!DOCTYPE html>
<html>
<style>
 /* Checkout page styles */
body.sub_page {
  background-color: #f7f7f7;
  font-family: Arial, sans-serif;
  color: #333;
  padding-top: 20px;
}

/* Display Order Section */
.display_order {
  margin: 20px;
  padding: 20px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.display_order h2 {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.single_order_product {
  display: flex;
  margin-bottom: 15px;
  padding: 10px;
  border-bottom: 1px solid #ddd;
}

.single_order_product img {
  width: 100px;
  height: 100px;
  object-fit: cover;
  margin-right: 15px;
  border-radius: 8px;
}

.single_des h3 {
  font-size: 18px;
  margin: 0 0 5px;
}

.single_des p {
  margin: 5px 0;
}

.checkout_grand_total {
  text-align: center;
  font-size: 20px;
  margin-top: 20px;
  font-weight: bold;
}

.checkout_grand_total span {
  color: #063547;
  font-size: 24px;
}

/* Contact Us Section */
.contact_us {
  background-color: #fff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
  margin: 20px;
}

.contact_us h2 {
  text-align: center;
  font-size: 24px;
  margin-bottom: 20px;
}

.contact_us input,
.contact_us select,
.contact_us textarea {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 8px;
  font-size: 16px;
  background-color: #f9f9f9;
  transition: 0.3s;
}

.contact_us input:focus,
.contact_us select:focus,
.contact_us textarea:focus {
  border-color: #063547;
  background-color: #fff;
}

.contact_us input[type="submit"] {
  background-color: #063547;
  color: white;
  font-size: 18px;
  cursor: pointer;
  border: none;
  padding: 15px;
  border-radius: 8px;
  transition: background-color 0.3s ease;
}

.contact_us input[type="submit"]:hover {
  background-color: #055276;
}

.contact_us input[type="submit"]:disabled {
  background-color: #ddd;
  cursor: not-allowed;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
  .single_order_product {
    flex-direction: column;
    align-items: center;
  }

  .single_order_product img {
    width: 80px;
    height: 80px;
    margin-bottom: 10px;
  }

  .checkout_grand_total span {
    font-size: 22px;
  }

  .contact_us {
    margin: 10px;
  }

  .contact_us input[type="submit"] {
    font-size: 16px;
  }
}

</style>
<?php include 'head.php'?>

<body class="sub_page">
<?php if(isset($_SESSION['order_message'])): ?>
    <div class="order_notification">
        <p><?php echo $_SESSION['order_message']; ?></p>
    </div>
    <script>
        setTimeout(function() {
            document.querySelector('.order_notification').style.display = 'none';
        }, 5000); // Message disappears after 5 seconds
    </script>
    <?php unset($_SESSION['order_message']); ?>
<?php endif; ?>

  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'userheader.php'?>
    <!-- end header section -->
  </div>
<section class="display_order">
  <h2>Ordered Products</h2>
  
  <div class="single_order_product">
    <img src="" alt="">
    <div class="single_des">
    <h3></h3>
    <p>Rs. </p>
    <p>Quantity : </p>
    </div>
    <section class="display_order">
  <h2>Ordered Products</h2>
  <?php
    $grand_total=0;
    $select_cart=mysqli_query($conn,"SELECT * FROM `cart` WHERE user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart)>0){
      while($fetch_cart=mysqli_fetch_assoc($select_cart)){
        $total_price=($fetch_cart['price'] * $fetch_cart['quantity']);
        $grand_total+=$total_price;
      
  ?>
  <div class="single_order_product">
    <img src="./uploaded_img/<?php echo$fetch_cart['image'];?>" alt="Product Image">
    <div class="single_des">
    <h3><?php echo $fetch_cart['name'];?></h3>
    <p>Rs. <?php echo $fetch_cart['price'];?></p>
    <p>Quantity : <?php echo $fetch_cart['quantity'];?></p>
    </div>

  </div>
  

  <?php
  }
}else{
  echo '<p class="empty">your cart is empty</p>';
}
  ?>
  </div>
  <div class="checkout_grand_total"> GRAND TOTAL : <span>$<?php echo $grand_total; ?></span></div>
</section>



<section class="contact_us">

<form action="" method="post">
   <h2>Add Your Details</h2>
   <input type="text" name="name" required placeholder="Enter your name" >

   <input type="phone" name="number" required placeholder="Enter your number">

   <input type="email" name="email" required placeholder="Enter your email">

   <select name="method" id="">
    <option value="cash on delivery">cash on delivery</option>
    <option value="gpay">gpay</option>
   </select>
  
   <textarea name="address" placeholder="Enter your address" id="" cols="30" rows="10"></textarea>
   
   <input type="submit" value="Place Your Order" name="order_btn" class="product_btn">
</form>
</section>
<?php include 'info.php'?>
<!-- footer section -->
<?php include 'footer.php'?>

<!-- footer section -->

<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->

</body>

</html>