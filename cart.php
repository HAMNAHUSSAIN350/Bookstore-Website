<?php
include 'connection.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}

if(isset($_POST['update_cart'])){
  $cart_id=$_POST['cart_id'];
  $cart_quantity=$_POST['cart_quantity'];
  mysqli_query($conn,"UPDATE `cart` SET quantity='$cart_quantity' WHERE id='$cart_id'") or die('query failed');
  $message[]='Cart Quantity Updated';
}

if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `cart` WHERE id='$delete_id'") or die('query failed');
  header('location:cart.php');
}

if(isset($_GET['delete_all'])){
  mysqli_query($conn, "DELETE FROM `cart` WHERE user_id = '$user_id'") or die('query failed');
  header('location:cart.php');
}

?>

<!DOCTYPE html>
<html>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap');

/* Global reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

/* Body styling */
body {
  background: #f8f8f8;
  padding: 0;
  margin: 0;
}

/* Shopping cart section */
.shopping_cart {
  padding: 40px;
  background-color: #fff;
  max-width: 1200px;
  margin: 0 auto;
}

/* Cart heading */
.shopping_cart h1 {
  text-align: center;
  font-size: 36px;
  color: #333;
  margin-bottom: 20px;
  font-weight: 600;
}

/* Cart container */
.cart_box_cont {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 20px;
  padding: 20px;
  justify-items: center;
}

/* Cart box */
.cart_box {
  background: #fff;
  padding: 20px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  text-align: center;
  position: relative;
}

.cart_box img {
  max-width: 100%;
  height: auto;
  border-radius: 5px;
  margin-bottom: 15px;
}

.cart_box h3 {
  font-size: 18px;
  color: #333;
  margin-bottom: 10px;
}

.cart_box p {
  font-size: 16px;
  color: #333;
  margin-bottom: 10px;
}

.cart_box .product_btn {
  background-color: #063547;
  color: #fff;
  padding: 10px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  font-size: 16px;
  transition: background-color 0.3s ease;
}

.cart_box .product_btn:hover {
  background-color: #0ef;
}

.cart_box a.fas.fa-times {
  position: absolute;
  top: 10px;
  right: 10px;
  font-size: 20px;
  color: #063547;
  text-decoration: none;
}

.cart_box a.fas.fa-times:hover {
  color: #063547;
}

/* Cart total section */
.cart_total {
  background: #fff;
  padding: 20px;
  box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  text-align: center;
  margin-top: 40px;
}

.cart_total h2 {
  font-size: 24px;
  color: #333;
  margin-bottom: 20px;
}

.cart_total .btns_cart {
  display: flex;
  justify-content: center;
  gap: 15px;
}

.cart_total .btns_cart a {
  background-color: #063547;
  color: white;
  padding: 12px 25px;
  font-size: 16px;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease;
}

.cart_total .btns_cart a:hover {
  background-color: #0ef;
}

.cart_total .disabled {
  background-color: #ccc;
  pointer-events: none;
}

/* Empty cart message */
.empty {
  font-size: 18px;
  color: #333;
  text-align: center;
  margin-top: 30px;
}

/* Admin header and footer adjustments */
.adminheader, .footer {
  background-color: #282c34;
  color: white;
  text-align: center;
  padding: 15px 0;
}

.adminheader a, .footer a {
  color: white;
  text-decoration: none;
}

.adminheader a:hover, .footer a:hover {
  color: #0ef;
}

</style>
<?php include 'head.php'?>


<body>
<span class="icon"><ion-icon name="person"></ion-icon></span>
  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'userheader.php'?>

    <!-- end header section -->
    <section class="shopping_cart">
  <h1>Products Added</h1>

  <div class="cart_box_cont">
    <?php
    $grand_total=0;
    $select_cart=mysqli_query($conn, "SELECT * FROM `cart` where user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($select_cart)>0){
      while($fetch_cart=mysqli_fetch_assoc(($select_cart))){


    ?>
    <div class="cart_box">
      <a href="cart.php?delete=<?php echo $fetch_cart['id'];?>" class="fas fa-times" onclick="return confirm('Are you sure you want to delete this product from cart');"></a>
      <img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="Product Image">
      <h3><?php echo $fetch_cart['name']; ?></h3>
      <p>$ <?php echo $fetch_cart['price']; ?></p>

      <form action="cart.php" method="post">
        <input type="hidden" name="cart_id" value="<?php echo $fetch_cart['id'];?>">
        <input type="number" name="cart_quantity" min="1" value="<?php echo $fetch_cart['quantity'];?>">
        <input type="submit" value="Update" name="update_cart" class="product_btn">
      </form>
      <p>Total : <span>$<?php echo $sub_total = ($fetch_cart['quantity'] * $fetch_cart['price']); ?></span></p>
    </div>
    <?php
    $grand_total+=$sub_total;
      }
    }else{
      echo '<p class="empty">Your Cart is Empty!</p>';
    }
    ?>
  </div>
   
  <div class="cart_total">
    <h2>Total Cart Price : <span>$ <?php echo $grand_total;?></span></h2>
    <div class="btns_cart">
    <a href="cart.php?delete_all" class="product_btn <?php echo ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('Are you sure you want to delete all cart items from cart?');">Delete All</a>
      <a href="products.php" class="product_btn">Continue Shopping</a>
      <a href="checkout.php" class="product_btn <?php echo ($grand_total > 1)?'':'disabled'; ?>">Checkout</a>
    </div>
  </div>
  </div>
    
</section>

<!-- end info section -->
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