<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
  header('location:login.php');
  exit();
}


if (isset($_POST['add_products_btn'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $price = $_POST['price'];
  $image = $_FILES['image']['name'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_size = $_FILES['image']['size'];
  $image_folder = "uploaded_img/" . $image;

  
  $select_product_name = mysqli_query($conn, "SELECT name FROM `products` WHERE name='$name'") or die('query failed');
  if (mysqli_num_rows($select_product_name) > 0) {
    $message[] = 'The given product is already added';
  } else {
    if ($image_size > 2000000) {
      $message[] = 'Image size is too large';
    } else {
      $add_product_query = mysqli_query($conn, "INSERT INTO `products`(name, price, image) VALUES ('$name', '$price', '$image')") or die('query failed');
      if ($add_product_query) {
        move_uploaded_file($image_tmp_name, $image_folder);
        $message[] = "Product added successfully!";
      } else {
        $message[] = "Product failed to be added!";
      }
    }
  }
}


if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];

  $delete_img_query = mysqli_query($conn, "SELECT image FROM `products` WHERE id='$delete_id'") or die('query failed');
  $fetch_del_img = mysqli_fetch_assoc($delete_img_query);
  unlink('./uploaded_img/' . $fetch_del_img['image']);

  mysqli_query($conn, "DELETE FROM `products` WHERE id='$delete_id'") or die('query failed');
  header('location:adminproducts.php');
  exit();
}


if(isset($_POST['update_product'])){

  $update_p_id = $_POST['update_p_id'];
  $update_name = $_POST['update_name'];
  $update_price = $_POST['update_price'];

  mysqli_query($conn, "UPDATE products SET name = '$update_name', price = '$update_price' WHERE id = '$update_p_id'") or die('query failed');

  $update_image = $_FILES['update_image']['name'];
  $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
  $update_image_size = $_FILES['update_image']['size'];
  $update_folder = 'uploaded_img/'.$update_image;
  $update_old_image = $_POST['update_old_image'];

  if(!empty($update_image)){
     if($update_image_size > 2000000){
        $message[] = 'image file size is too large';
     }else{
        mysqli_query($conn, "UPDATE products SET image = '$update_image' WHERE id = '$update_p_id'") or die('query failed');
        move_uploaded_file($update_image_tmp_name, $update_folder);
        unlink('uploaded_img/'.$update_old_image);
        
      }
    }
 
    header('location:adminproducts.php?update_success=1');
 
 }
 
 ?>
 

?>
<!DOCTYPE html>
<?php include 'adminhead.php'?>
<style>
 /* General Styles */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: Arial, sans-serif;
  background-color: #f4f4f4;
  color: #333;
}

/* Section for Adding Product */
 .admin_add_products {
  width: 30%;
  margin: 20px auto;
  padding: 30px;
  background-color: #ffffff;
  border-radius: 10px;
  box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
}
.admin_add_products:hover {
  box-shadow: 0 0 25px 10px rgba(6, 53, 71, 0.8); /* Stronger blue neon glow on hover */
  transform: scale(1.02);
}
.admin_add_products h3 {
  text-align: center;
  margin-bottom: 20px;
  font-size: 24px;
  color: #333;
}

.admin_input {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ddd;
  border-radius: 5px;
  font-size: 16px;
  color: #333;
}

.admin_input[type="file"] {
  padding: 5px;
}

.admin_input[type="submit"] {
  background-color:  #063547;
  color: white;
  cursor: pointer;
  font-size: 16px;
  border: none;
  border-radius: 4px;
}

.admin_input[type="submit"]:hover {
  background-color:  #063547;
}

/* Section to Display All Products */
.show_products {
  margin: 20px;
}

.product_box_cont {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.product_box {
  background-color: #f0f0f0;
  padding: 20px;
  border-radius: 10px;
  box-shadow: 0 0 15px 5px rgba(6, 53, 71, 0.6);  /* Blue neon glow */
  transition: all 0.3s ease;
  text-align: center;
}
.product_box:hover {
  box-shadow: 0 0 25px 10px rgba(6, 53, 71, 0.8); /* Stronger blue neon glow on hover */
}

.product_box img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 8px;
  margin-bottom: 15px;
}

.product_name {
  font-size: 20px;
  font-weight: bold;
  margin-bottom: 10px;
}

.product_price {
  font-size: 18px;
  margin-bottom: 15px;
  color:  #063547;
}

.product_btn {
  padding: 10px 20px;
  margin: 5px;
  background-color:  #063547;
  color: white;
  text-decoration: none;
  border-radius: 4px;
  cursor: pointer;
}

.product_btn:hover {
  background-color:  #063547;
}

.product_del_btn {
  background-color: #063547;
}

.product_del_btn:hover {
  background-color: #063547;
} */

/* Empty Message */
.empty {
  text-align: center;
  font-size: 18px;
  color: #999;
}

/* Edit Product Form Section */
.edit_product_form {
  display: none;
}

.edit_product_form form {
  background-color: #ffffff;
  padding: 20px;
  border-radius: 8px;
  box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
  width: 50%;
  margin: auto;
}

.edit_product_form input {
  width: 100%;
  padding: 12px;
  margin-bottom: 15px;
  border: 1px solid #ccc;
  border-radius: 4px;
}

.edit_product_form input[type="submit"] {
  background-color:  #063547;
  color: white;
  cursor: pointer;
  font-size: 16px;
  border: none;
  border-radius: 4px;
}

.edit_product_form input[type="submit"]:hover {
  background-color:  #063547;
}

.edit_product_form input[type="reset"] {
  background-color:  #063547;
  color: white;
  cursor: pointer;
}

.edit_product_form input[type="reset"]:hover {
  background-color:  #063547;
}

</style>

<body>
    <!-- Header -->
    <?php include 'adminheader.php'?>
    <!-- Main Content -->

  <section class="admin_add_products">
    <form action="adminproducts.php" method="post" enctype="multipart/form-data">
      <h3>Add Product</h3>
      <input type="text" name="name" class="admin_input" placeholder="Enter Product Name" required>
      <input type="number" min="0" name="price" class="admin_input" placeholder="Enter Product Price" required>
      <input type="file" name="image" class="admin_input" accept="image/jpg, image/jpeg, image/png" required>
      <input type="submit" name="add_products_btn" class="admin_input" value="Add Product">
    </form>
  </section>

  <section class="show_products">
    <div class="product_box_cont">
      <?php
      $select_products = mysqli_query($conn, "SELECT * FROM `products`") or die('query failed');
      if (mysqli_num_rows($select_products) > 0) {
        while ($fetch_products = mysqli_fetch_assoc($select_products)) {
      ?>
          <div class="product_box">
            <img src="./uploaded_img/<?php echo $fetch_products['image']; ?>" alt="">
            <div class="product_name"><?php echo $fetch_products['name']; ?></div>
            <div class="product_price">$<?php echo $fetch_products['price']; ?></div>
            <a href="adminproducts.php?update=<?php echo $fetch_products['id']; ?>" class="product_btn">Update</a>
            <a href="adminproducts.php?delete=<?php echo $fetch_products['id']; ?>" class="product_btn product_del_btn" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">No Product added yet!</p>';
      }
      ?>
    </div>
  </section>

  <section class="edit-product-form">

<?php
   if(isset($_GET['update'])){
      $update_id = $_GET['id'];
      $update_query = mysqli_query($conn, "SELECT * FROM products WHERE id = '$update_id'") or die('query failed');
      if(mysqli_num_rows($update_query) > 0){
         while($fetch_update = mysqli_fetch_assoc($update_query)){
?>
<form action="" method="post" enctype="multipart/form-data">
   <input type="hidden" name="update_p_id" value="<?php echo $fetch_update['id']; ?>">
   <input type="hidden" name="update_old_image" value="<?php echo $fetch_update['image']; ?>">
   <img src="uploaded_img/<?php echo $fetch_update['image']; ?>" alt="">
   <input type="text" name="update_name" value="<?php echo $fetch_update['name']; ?>" class="box" required placeholder="enter product name">
   <input type="number" name="update_price" value="<?php echo $fetch_update['price']; ?>" min="0" class="box" required placeholder="enter product price">
   <input type="file" class="box" name="update_image" accept="image/jpg, image/jpeg, image/png">
   <input type="submit" value="update" name="update_product" class="btn">
   <input type="reset" value="cancel" id="close-update" class="option-btn">
</form>
<?php
      }
   }
   }else{
      echo '<script>document.querySelector(".edit-product-form").style.display = "none";</script>';
   }
   ?>

   </section>
   
  <script src="admin.js"></script>
  <?php include 'footer.php'; ?>
</body>
</html>  