<?php
include 'connection.php';
session_start();

$user_id=$_SESSION['user_id'];

if(!isset($user_id)){
  header('location:login.php');
}
if(isset($_POST['send'])){

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $number = $_POST['number'];
  @$msg = mysqli_real_escape_string($conn, $_POST['message']);
  
  $select_message = mysqli_query($conn, "SELECT * FROM `message` WHERE name = '$name' AND email = '$email' AND number = '$number' AND message = '$msg'") or die('query failed');
  
  if(mysqli_num_rows($select_message) > 0){
     $message[] = 'message sent already!';
  }else{
     mysqli_query($conn, "INSERT INTO `message`(user_id, name, email, number, message) VALUES('$user_id', '$name', '$email', '$number', '$msg')") or die('query failed');
     $message[] = 'message sent successfully!';
  }
  
  }

?>

<!DOCTYPE html>
<html>

<?php include 'head.php'?>

</head>

<body class="sub_page">
      
  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'userheader.php'?>

    <!-- end header section -->
  </div>

  <!-- contact section -->

  <section class="contact_section layout_padding">
    <div class="container">
      <div class="row">
        <div class="col-md-6 ">
          <div class="heading_container ">
            <h2 class="">
              Contact Us
            </h2>
          </div>
          <form action="contact.php" method="post">
            <div>
              <input type="text" name="name" required placeholder="Enter your Name">
            </div>
            <div>
              <input type="email" name="email" required placeholder="Enter your Email">
            </div>
            <div>
              <input type="text" name="number" required placeholder="Enter your Phone Number" />
            </div>
            <div>
              <input type="message" class="message-box" required placeholder="Message">
            </div>
            <div class="btn-box">
              <button type="submit" name="send">
                SEND
              </button>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/contact-img.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end contact section -->

  <!-- info section -->
  <?php include 'info.php' ?>
  <!-- end info section -->
   
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