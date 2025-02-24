<?php
include 'connection.php';
session_start();

$user_id=$_SESSION['user_id'];

 //if(!isset($_SESSION['user_id'])){
  //header('location:login.php');
  //exit(); 
//}
?>

<!DOCTYPE html>
<html>

<?php include 'head.php'?>

<body class="sub_page">

  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'userheader.php'?>
    <!-- end header section -->
  </div>

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container ">
      <div class="row">
        <div class="col-md-6">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                About Our Bookstore
              </h2>
            </div>
            <p>
            Welcome to Bostorek Bookstore , a haven for book lovers. Founded in 1997, we're dedicated to fostering a community of readers and promoting literacy"
            </p>
            <button class="product_btn" onclick="window.location.href='contact.php'">Contact Us</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

  <!-- info section -->
  <?php include 'info.php'?>
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