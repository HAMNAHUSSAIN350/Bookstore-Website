<?php
include 'connection.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}

?>

<!DOCTYPE html>
<html>

<?php include 'head.php' ?>

<body>
  
<?php
include 'userheader.php';
?>

<section class="orders">
  <h2>Placed Orders</h2>
  <div class="orders_cont">
    <?php
    $order_query=mysqli_query($conn,"SELECT * FROM `orders` WHERE user_id='$user_id'") or die('query failed');

    if(mysqli_num_rows($order_query)>0){
      while($fetch_orders=mysqli_fetch_assoc($order_query)){

      
    ?>
    <div class="orders_box">
      <p> placed on : <span><?php echo $fetch_orders['placed_on']; ?></span> </p>
      <p> name : <span><?php echo $fetch_orders['name']; ?></span> </p>
      <p> number : <span><?php echo $fetch_orders['number']; ?></span> </p>
      <p> email : <span><?php echo $fetch_orders['email']; ?></span> </p>
      <p> address : <span><?php echo $fetch_orders['address']; ?></span> </p>
      <p> payment method : <span><?php echo $fetch_orders['method']; ?></span> </p>
      <p> your orders : <span><?php echo $fetch_orders['total_products']; ?></span> </p>
      <p> total price : <span>$<?php echo $fetch_orders['total_price']; ?>/-</span> </p>
      <p> payment status : <span style="color:<?php if($fetch_orders['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'blue'; } ?>;"><?php echo $fetch_orders['payment_status']; ?></span> </p>
    </div>
    <?php
    }
  }else{
    echo '<p class="empty">no orders placed yet!</p>';
  }
    ?>
  </div>
</section>
<?php include 'info.php' ?>
<?php
include 'footer.php';
?>
<!-- jQery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="https://kit.fontawesome.com/eedbcd0c96.js" crossorigin="anonymous"></script>
<script src="js/custom.js"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
</script>
<!-- End Google Map -->

</body>
</html>

