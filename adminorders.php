<?php
include 'connection.php';
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
    exit();  // Prevent further execution after redirect
}

if (isset($_POST['update_order'])) {
    $order_update_id = $_POST['order_id'];
    @$update_payment = $_POST['update_payment'];

    // Debugging: Check if form values are being submitted correctly
    if ($update_payment) {
        echo "Updating order ID $order_update_id with payment status $update_payment.<br>";

        // Perform the update
        $update_query = "UPDATE `orders` SET payment_status = '$update_payment' WHERE id = '$order_update_id'";
        if (mysqli_query($conn, $update_query)) {
            echo "Order updated successfully.<br>";
        } else {
            echo "Failed to update order: " . mysqli_error($conn) . "<br>";
        }

        // Message confirmation
        $message[] = 'Order Payment status has been updated';
    } else {
        echo "No payment status selected.<br>";
    }
}

if (isset($_GET['delete'])) {
    $delete_id = $_GET['delete'];

    // Debugging: Check if delete ID is received correctly
    echo "Deleting order ID: $delete_id<br>";

    $delete_query = "DELETE FROM `orders` WHERE id = '$delete_id'";
    if (mysqli_query($conn, $delete_query)) {
        echo "Order deleted successfully.<br>";
    } else {
        echo "Failed to delete order: " . mysqli_error($conn) . "<br>";
    }

    $message[] = '1 order has been deleted';
}
?>

<!DOCTYPE html>
<html>
<head>
    <style>
        /* General Styles for Admin Orders */
        body {
            background-color: #fff;
            color: #333;
            font-family: 'Arial', sans-serif;
        }
        .hero_area {
            background-color: #fff;
            color: #fff;
            padding: 20px;
            height: 80px; 
            box-sizing: border-box; 
        }
        .title {
            text-align: center;
            font-size: 32px;
            font-weight: 600;
            margin-bottom: 30px;
            line-height: 80px;
        }
        .adminorders {
            margin-top: 20px;
        }
        .admin_box_container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: space-between;
            margin-top: 20px;
        }
        .admin_box {
            background-color: #f5f5f5;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 300px;
            margin-bottom: 20px;
        }
        .admin_box p {
            font-size: 14px;
            margin: 5px 0;
            color: #555;
        }
        .admin_box span {
            font-weight: 600;
            color: #063547;
        }
        .admin_box form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        .admin_box select {
            padding: 8px;
            font-size: 14px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .admin_box input[type="submit"] {
            padding: 10px 15px;
            background-color: #063547;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .admin_box input[type="submit"]:hover {
            background-color: #063547;
        }
        .delete-btn {
            display: inline-block;
            margin-top: 10px;
            padding: 8px 15px;
            background-color: #063547;
            color: #fff;
            text-align: center;
            text-decoration: none;
            border-radius: 5px;
        }
        .empty {
            text-align: center;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>

<body>

<?php include 'adminhead.php'; ?>

<div class="hero_area">
    <?php include 'adminheader.php'; ?>

    <section class="adminorders">
        <h1 class="title">Placed Orders</h1>

        <div class="admin_box_container">
            <?php
            $select_orders = mysqli_query($conn, "SELECT * FROM `orders`") or die('query failed');

            if (mysqli_num_rows($select_orders) > 0) {
                while ($fetch_orders = mysqli_fetch_assoc($select_orders)) {
            ?>
            <div class="admin_box">
                <p>User Id : <span><?php echo $fetch_orders['user_id']; ?></span></p>
                <p>Placed On : <span><?php echo $fetch_orders['placed_on']; ?></span></p>
                <p>Name : <span><?php echo $fetch_orders['name']; ?></span></p>
                <p>Number : <span><?php echo $fetch_orders['number']; ?></span></p>
                <p>Email : <span><?php echo $fetch_orders['email']; ?></span></p>
                <p>Address : <span><?php echo $fetch_orders['address']; ?></span></p>
                <p>Total Products : <span><?php echo $fetch_orders['total_products']; ?></span></p>
                <p>Total Price : <span><?php echo $fetch_orders['total_price']; ?></span></p>
                <p>Payment Method : <span><?php echo $fetch_orders['method']; ?></span></p>

                <form action="" method="post">
                    <input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
                    <select name="update_payment">
                        <option value="" selected disabled><?php echo $fetch_orders['payment_status']; ?></option>
                        <option value="pending">pending</option>
                        <option value="completed">completed</option>
                    </select>
                    <input type="submit" value="update" name="update_order" class="option-btn">
                    <a href="adminorders.php?delete=<?php echo $fetch_orders['id']; ?>" onclick="return confirm('Are you sure you want to delete this order?');" class="delete-btn">delete</a>
                </form>
            </div>
            <?php
                }
            } else {
                echo '<p class="empty">No orders placed yet!</p>';
            }
            ?>
        </div>
    </section>
</div>

<?php include 'footer.php'; ?>

</body>
</html>