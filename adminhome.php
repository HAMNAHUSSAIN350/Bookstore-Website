<?php
include 'connection.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:login.php');
}

?>
<!DOCTYPE html>
<html>
<style>
 /* Global Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

body {
  background: #ffffff; /* White background */
  color: #000; /* Black text for contrast */
  display: flex;
  justify-content: center;
  align-items: flex-start;
  min-height: 100vh;
  flex-direction: column;
}

/* Header Styling */
header {
  background: #ffffff; /* Blue header background */
  color: #fff; /* White text in header */
  padding: 20px;
  text-align: center;
}

/* Admin Dashboard Styling */
.admin_dashboard {
  width: 100%;
  padding: 40px 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: space-around;
}
/* Welcome Admin Box Styling */
.welcome-box {
  background-color: #063547; /* Deep blue background */
  color: #fff; /* White text color */
  padding: 20px;
  text-align: center;
  border-radius: 10px; /* Rounded corners */
  margin: 20px 0; /* Add some spacing from the header */
  box-shadow: 0 0 10px rgba(6, 53, 71, 0.6); /* Optional: Blue glow effect */
}

.welcome-box h2 {
  margin: 0;
  font-size: 24px;
  font-weight: 600;
}



.admin_box_container {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  width: 100%;
}

/* Styling for each admin box */
.admin_box {
  background: #f0f0f0; /* Light gray background for admin boxes */
  border-radius: 8px;
  width: 280px;
  margin: 10px;
  padding: 20px;
  text-align: center;
  box-shadow: 0 0 15px 5px rgba(6, 53, 71, 0.6);  /* Blue neon glow */
  transition: all 0.3s ease;
}
.admin_box:hover {
  box-shadow: 0 0 25px 10px rgba(6, 53, 71, 0.8); /* Stronger blue neon glow on hover */
}

.admin_box h3 {
  color: #333; /* Dark text for numbers */
  font-size: 28px;
  margin-bottom: 30px;
}

.admin_box p {
  color: #777; /* Lighter text for descriptions */
  font-size: 16px;
}

/* Footer Styling */
footer {
  background: #ffffff; /* Blue footer background */
  color: #fff; /* White text */
  padding: 20px;
  text-align: center;
  position: relative;
  width: 100%;
  bottom: 0;
}

/* Button Styling for admin actions (optional) */
button {
  background: #ffffff; /* Blue button */
  color: #fff; /* White text */
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
  font-size: 16px;
}

button:hover {
  background: #ffffff; /* Darker blue when hovered */
}


</style>
<?php include 'adminhead.php'?>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'adminheader.php'?>

    <!-- end header section -->
    <section class="admin_dashboard">
    <div class="welcome-box">
    <h2>Welcome Admin</h2>
    </div>
    <div class="admin_box_container">
     <div class="admin_box">
    <?php
      $total_pendings = 0;
      $select_pending = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'pending'") or die('query failed');

      if(mysqli_num_rows($select_pending) > 0){
        while($fetch_pendings = mysqli_fetch_assoc($select_pending)){
          $total_price=$fetch_pendings['total_price'];
          $total_pendings+=$total_price;
        };
      };
    ?>
    <h3>$ <?php echo $total_pendings;?></h3>
    <p>Total Payments Pending </p>
    </div>

    <div class="admin_box">
    <?php
      $total_completed = 0;
      $selectcompleted = mysqli_query($conn, "SELECT total_price FROM `orders` WHERE payment_status = 'completed'") or die('query failed');

      if(mysqli_num_rows($selectcompleted) > 0){
        while($fetch_completed = mysqli_fetch_assoc($selectcompleted)){
          $total_price=$fetch_completed['total_price'];
          $total_completed+=$total_price;
        };
      };
    ?>
    <h3>$ <?php echo $total_completed;?></h3>
    <p>Completed Payments</p>
  </div>
  
  <div class="admin_box">
    <?php
      $select_orders=mysqli_query($conn,"SELECT * FROM `orders`") or die('query failed');
      $number_of_orders=mysqli_num_rows($select_orders);
    ?>
    <h3><?php echo $number_of_orders;?></h3>
    <p>Orders Placed</p>
  </div>

  <div class="admin_box">
    <?php
      $select_products=mysqli_query($conn,"SELECT * FROM `products`") or die('query failed');
      $number_of_products=mysqli_num_rows($select_products);
    ?>
    <h3><?php echo $number_of_products; ?></h3>
    <p>Products Added</p>
  </div>

  <div class="admin_box">
    <?php
      $select_users=mysqli_query($conn,"SELECT * FROM `register` WHERE user_type='user'") or die('query failed');
      $number_of_users=mysqli_num_rows($select_users);
    ?>
    <h3><?php echo $number_of_users; ?></h3>
    <p>User Present</p>
  </div>

  <div class="admin_box">
    <?php
      $select_admin=mysqli_query($conn,"SELECT * FROM `register` WHERE user_type='admin'") or die('query failed');
      $number_of_admin=mysqli_num_rows($select_admin);
    ?>
    <h3><?php echo $number_of_admin; ?></h3>
    <p>Admin Present</p>
  </div>

  <div class="admin_box">
    <?php
      $select_accounts=mysqli_query($conn,"SELECT * FROM `register`") or die('query failed');
      $number_of_accounts=mysqli_num_rows($select_accounts);
    ?>
    <h3><?php echo $number_of_accounts; ?></h3>
    <p>Total Accounts</p>
  </div>

  <div class="admin_box">
    <?php
      $select_messages=mysqli_query($conn,"SELECT * FROM `message`") or die('query failed');
      $number_of_messages=mysqli_num_rows($select_messages);
    ?>
    <h3><?php echo $number_of_messages; ?></h3>
    <p>New Messages</p>
  </div>

</div>

</section>

   <?php include 'footer.php'?>
</body>
</html>

    
     