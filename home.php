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

<?php include 'head.php'?>


<body>

  <div class="hero_area">
    <!-- header section strats -->
    <?php include 'userheader.php'?>

    <!-- end header section -->
    <!-- slider section -->
    <section class="slider_section ">
      <div id="customCarousel1" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h5>
                      Bostorek Bookstore
                    </h5>
                    <h1>
                      For All Your <br>
                      Reading Needs
                    </h1>
                    <p>
                    Explore the world of words with us. Discover new authors, genres, and titles to fuel your passion for reading
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h5>
                      Bostorek Bookstore
                    </h5>
                    <h1>
                      For All Your <br>
                      Reading Needs
                    </h1>
                    <p>
                    Get lost in the pages of our vast collection. From classics to bestsellers, we have something for every book lover
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container ">
              <div class="row">
                <div class="col-md-6">
                  <div class="detail-box">
                    <h5>
                      Bostorek Bookstore
                    </h5>
                    <h1>
                      For All Your <br>
                      Reading Needs
                    </h1>
                    <p>
                    Where stories come alive. Browse our shelves, attend our events, and connect with fellow book enthusiasts
                    </p>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="img-box">
                    <img src="images/slider-img.png" alt="">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel_btn_box">
          <a class="carousel-control-prev" href="#customCarousel1" role="button" data-slide="prev">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#customCarousel1" role="button" data-slide="next">
            <i class="fa fa-angle-right" aria-hidden="true"></i>
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
  <!-- about section -->

  <!-- end about section -->

  <!-- client section -->

  <section class="client_section layout_padding">
    <div class="container ">
      <div class="heading_container heading_center">
        <h2>
          What Says Customers
        </h2>
        <hr>
      </div>
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="client_container ">
            <div class="detail-box">
              <p>
              I stumbled upon this hidden gem and I'm so glad I did! The staff is knowledgeable and friendly, and the selection is incredible. I've already found several new favorite authors!
              </p>
              <span>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </span>
            </div>
            <div class="client_id">
              <div class="img-box">
                <img src="images/c1.jpg" alt="">
              </div>
              <div class="client_name">
                <h5>
                  Jone Mark
                </h5>
                <h6>
                  Student
                </h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-6 mx-auto">
          <div class="client_container ">
            <div class="detail-box">
              <p>
              This bookstore is my happy place. The atmosphere is cozy and inviting, and the events they host are always fascinating. I've met so many interesting people here!
              </p>
              <span>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </span>
            </div>
            <div class="client_id">
              <div class="img-box">
                <img src="images/c2.jpg" alt="">
              </div>
              <div class="client_name">
                <h5>
                  Anna Crowe
                </h5>
                <h6>
                  Student
                </h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-6 mx-auto">
          <div class="client_container ">
            <div class="detail-box">
              <p>
              I was blown away by the personalized service I received at this bookstore. The staff took the time to understand my reading preferences and made some fantastic recommendations. I'll be back!
              </p>
              <span>
                <i class="fa fa-quote-left" aria-hidden="true"></i>
              </span>
            </div>
            <div class="client_id">
              <div class="img-box">
                <img src="images/c3.jpg" alt="">
              </div>
              <div class="client_name">
                <h5>
                  Hilley James
                </h5>
                <h6>
                  Student
                </h6>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end client section -->

  

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