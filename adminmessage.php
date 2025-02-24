<?php
include 'connection.php';
session_start();

$admin_id=$_SESSION['admin_id'];

if(!isset($admin_id)){
  header('location:login.php');
}
if(isset($_GET['delete'])){
  $delete_id=$_GET['delete'];
  mysqli_query($conn,"DELETE FROM `message` WHERE id='$delete_id'");
  $message[]='1 message has been deleted';
  header("location:adminmessage.php");
}

?>
<!DOCTYPE html>
<style>
  /* General Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: Arial, sans-serif;
}

/* Hero area and header */
.hero_area {
  background-color: #f4f4f4;
  padding: 20px;
}

/* Admin messages section */
.adminmessage {
  padding: 30px;
  background-color: #ffffff;
}

.admin_box_container {
  display: flex;
  flex-direction: column;
  gap: 20px;
}

/* Each message box */
.admin_box {
  background-color: #f9f9f9;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
  padding: 20px;
  transition: transform 0.3s ease-in-out;
}

.admin_box:hover {
  transform: translateY(-5px);
}

/* Styling for message content */
.admin_box p {
  margin: 10px 0;
  color: #333333;
}

.admin_box span {
  color: #555555;
}

/* Delete button */
.delete-btn {
  display: inline-block;
  background-color:  #063547;
  color: white;
  padding: 8px 15px;
  border-radius: 5px;
  text-decoration: none;
  margin-top: 10px;
  font-weight: bold;
  transition: background-color 0.3s;
}

.delete-btn:hover {
  background-color:  #063547;
}

/* Empty message */
.empty {
  text-align: center;
  font-size: 18px;
  color: #888888;
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
  color:  #063547;
}


</style>
<?php include 'adminhead.php'?>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'adminheader.php'?>

    <!-- end header section -->
    <section class="adminmessage">
    <div class="admin_box_container">
    <?php
      $select_msgs=mysqli_query($conn,"SELECT * FROM `message`") or die('query failed');
      if(mysqli_num_rows($select_msgs)>0){
        while($fetch_msgs=mysqli_fetch_assoc($select_msgs)){  
    ?>
    <div class="admin_box">
      <p>Name : <span><?php echo $fetch_msgs['name']; ?></span></p>
      <p>Number : <span><?php echo $fetch_msgs['number']; ?></span></p>
      <p>Email : <span><?php echo $fetch_msgs['email']; ?></span></p>
      <p>Message : <span><?php echo $fetch_msgs['message']; ?></span></p>
      <a href="adminmessage.php?delete=<?php echo $fetch_msgs['id']; ?>" onclick="return confirm('Are you sure you want to delete this message?');" class="delete-btn">delete</a>
    </div>
    <?php
      };
    }
    else{
      echo '<p class="empty">You Have No Messages!</p>';
    }
    ?>
  </div>
</section>
    <?php include 'footer.php'?>
</body>
</html>