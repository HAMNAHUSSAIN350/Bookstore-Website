<?php
include 'connection.php';
session_start();

$user_id = $_SESSION['user_id'];

if (!isset($user_id)) {
    header('location:login.php');
}

// Add to Cart Logic
if (isset($_POST['add_to_cart'])) {
  $pro_name = $_POST['product_name'];
  $pro_price = $_POST['product_price'];
  $pro_quantity = $_POST['product_quantity'];
  $pro_image = $_POST['product_image'];

  // Check if the product is already in the cart
  $check = mysqli_query($conn, "SELECT * FROM `cart` WHERE name='$pro_name' AND user_id='$user_id'") or die('query failed');

  if (mysqli_num_rows($check) > 0) {
      $_SESSION['cart_message'] = 'Already added to cart!';
  } else {
      // Insert the product into the cart
      mysqli_query($conn, "INSERT INTO `cart`(user_id, name, price, quantity, image) VALUES ('$user_id', '$pro_name', '$pro_price', '$pro_quantity', '$pro_image')") or die('query failed');
      $_SESSION['cart_message'] = 'Product added to cart!';
  }

  // Redirect to the same page to show the message
  header('Location: products.php');
  exit; // Ensure no further code is executed
}

?>

<!DOCTYPE html>
<html>
  <style>
    /* General Styling */
body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
}
/* Section Header Container */
.section-header {
    text-align: center;
    background:  #063547; /* Blue background */
    color: white;
    padding: 15px;
    margin-bottom: 20px auto;
    border-radius: 8px; 
    transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
}

/* Hover Effect */
.section-header:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

/* Title Styling */
.section-header .title {
    font-size: 18px;
    font-weight: bold;
    letter-spacing: 1px;
}

/* Main Heading */
.section-header h2 {
    font-size: 26px;
    margin-top: 5px;
}


/* Section Styling */
.products_cont {
    max-width: 1200px;
    margin: 50px auto;
    padding: 20px;
}

/* Grid Layout for Products */
.pro_box_cont {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
}

/* Individual Product Box */
.pro_box {
    width: 250px;
    padding: 15px;
    border: 1px solid #063547;
    text-align: center;
    background: #fff;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    transition: 0.3s;
}

.pro_box:hover {
    transform: translateY(-5px);
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

/* Product Image */
.pro_box img {
    width: 100%;
    height: 200px;
    object-fit: cover;
    border-radius: 5px;
}

/* Product Name */
.pro_box h3 {
    font-size: 18px;
    color: #333;
    margin: 10px 0;
}

/* Product Price */
.pro_box p {
    font-size: 16px;
    color: #666;
    margin: 5px 0;
}

/* Quantity Input */
.pro_box input[type="number"] {
    width: 50px;
    padding: 5px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

/* Add to Cart Button */
.product_btn {
    background-color: #063547;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

.product_btn:hover {
    background-color:  #063547;
}

/* Notification Styling */
.notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background-color: #063547;
    color: white;
    padding: 10px 15px;
    border-radius: 5px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    display: none; /* Initially hidden */
}

/* Responsive Design */
@media (max-width: 768px) {
    .pro_box {
        width: 90%;
    }
}

  </style>

<?php include 'head.php' ?>

<body>

<!-- header section starts -->
<?php include 'userheader.php' ?>
<!-- end header section -->

<section id="All Products" class="py-5 my-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="section-header align-center">
                    <div class="title">
                        <span>Some quality items</span>
                    </div>
                    <h2 class="section-title">All Products</h2>
                </div>

                <div class="product-list" data-aos="fade-up">
                    <div class="row">
                    <section class="products_cont">
    <div class="pro_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');

      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {

      ?>
          <form action="" method="post" class="pro_box">
            <img src="./uploaded_img/<?php echo $fetch_products['image']; ?>" alt="Product Image">
            <h3><?php echo $fetch_products['name']; ?></h3>
            <p>$ <?php echo $fetch_products['price']; ?></p>
          
            <input type="hidden" name="product_name" value="<?php echo $fetch_products['name'] ?>">
            <input type="number" name="product_quantity" min="1" value="1">
            <input type="hidden" name="product_price" value="<?php echo $fetch_products['price']; ?>">
            <input type="hidden" name="product_image" value="<?php echo $fetch_products['image']; ?>">

            <button type="submit" value="Add to Cart" name="add_to_cart" class="product_btn">Add to Cart</button>

          </form>

      <?php
        }
      } else {
        echo '<p class="empty">No Products Added Yet !</p>';
      }
      ?>
    </div>
</section>
  <?php include 'info.php' ?>

<!-- footer section -->
<?php include 'footer.php' ?>

<!-- jQuery -->
<script src="js/jquery-3.4.1.min.js"></script>
<!-- bootstrap js -->
<script src="js/bootstrap.js"></script>
<!-- custom js -->
<script src="js/custom.js"></script>

</body>
</html>
