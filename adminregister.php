<?php

include 'connection.php';

if(isset($_POST['submit'])){

    $name=mysqli_real_escape_string($conn,$_POST['name']);
    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password=mysqli_real_escape_string($conn,$_POST['password']);
    $confirm_password=mysqli_real_escape_string($conn,$_POST['confirm_password']);
    $user_id=$_POST['user_id'];
$_SESSION['name']=$email;
    $select_users=mysqli_query($conn,"SELECT * FROM `adminregister` WHERE email='$email' AND password='$password'") or die('query failed');

    if($password != $confirm_password) {
        $message[] = 'Confirm password does not match!';
    } else {
        $select_users = mysqli_query($conn, "SELECT * FROM `adminregister` WHERE email='". $_SESSION['name']. "'") or die('query failed');
        if(mysqli_num_rows($select_users) > 0) {
            $message[] = 'User already exists!';
        } else {
            mysqli_query($conn, "INSERT INTO `adminregister`(name, email, password, user_id) VALUES('$name', '$email','$password', '$user_id')") or die('query failed');
            $message[] = 'Registered Successfully!';
            header('location:adminlogin.php');
            exit();
        }
    }
    
}

?>
<!DOCTYPE html>
<html>
<?php include 'head.php' ?>
  <style>
@import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #000;
}

.wrapper {
    position: relative;
    width: 400px;
    padding: 20px;
    background: transparent;
    border: 5px solid #333;
    border-radius: 10px;
    overflow: hidden;
}

.wrapper:hover {
    border: 5px solid #0ef;
    box-shadow: 0 0 20px #0ef, inset 0 0 20px #0ef;
}

h2 {
    color: #fff;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.1rem;
    margin-bottom: 20px;
}

.wrapper:hover h2 {
    color: #0ef;
}

.input-box {
    position: relative;
    width: 100%; /* Ensure fields fit container */
    margin: 20px 0; /* Space between input fields */
}

.input-box input,
.input-box select {
    width: 100%;
    height: 50px;
    background: transparent;
    border: 2px solid #333;
    outline: none;
    border-radius: 5px;
    font-size: 1rem;
    color: #fff;
    padding: 0 10px 0 40px; /* Leave space for icon */
    transition: 0.5s;
}

.wrapper:hover .input-box input,
.wrapper:hover .input-box select {
    border: 2px solid #0ef;
    box-shadow: 0 0 10px #0ef, inset 0 0 10px #0ef;
}

.input-box input::placeholder {
    color: rgba(255, 255, 255, 0.3);
}

.input-box .icon {
    position: absolute;
    left: 10px;
    top: 50%;
    transform: translateY(-50%);
    color: #fff;
    font-size: 1.2rem;
    transition: 0.5s;
}

.wrapper:hover .input-box .icon {
    color: #0ef;
}

.forgot-pass {
    text-align: center;
    margin: 10px 0;
}

.forgot-pass a {
    color: #fff;
    font-size: 0.9rem;
    text-decoration: none;
}

.forgot-pass a:hover {
    text-decoration: underline;
}

button {
    width: 100%;
    height: 45px;
    background: #333;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
    color: #fff;
    font-weight: 500;
    margin-top: 20px;
    transition: 0.5s;
}

.wrapper:hover button {
    background: #0ef;
    color: #000;
    box-shadow: 0 0 20px #0ef;
}

.register-link {
    text-align: center;
    margin: 20px 0;
}

.register-link p {
    color: #fff;
}

.register-link p a {
    color: #0ef;
    text-decoration: none;
    font-weight: 600;
    transition: 0.5s;
}

.register-link p a:hover {
    text-decoration: underline;
}

</style>
</head>
<body>

<?php
if(isset($message)){
    foreach($message as $msg){
        echo '<div class="message">'.$msg.'</div>';
    }
}
?>

<div class="wrapper">
    <h2>Register</h2>
    <form action="register.php" method="post">
    <!-- Name Field -->
    <div class="input-box">
        <span class="icon"><ion-icon name="person"></ion-icon></span> 
        <input type="text"  name="name" placeholder="Name" />
    </div>
    <!-- Email Field -->
    <div class="input-box">
        <span class="icon"><ion-icon name="person"></ion-icon></span>
        <input type="email" name="email" placeholder="Email" />
    </div>
    <!-- Password Field -->
    <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password"  name="password" placeholder="Password" />
    </div>
    <!-- Confirm Password Field -->
    <div class="input-box">
        <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
        <input type="password"  name="confirm_password" placeholder="Confirm Password" />
    </div>
    <!-- User Type Dropdown -->

    <!-- Submit Button -->
    <button type="submit" name="submit">Register</button>
    <!-- Link to Login -->
    <div class="register-link">
        <p>Login Here<a href="adminlogin.php">Login</a></p>
    </div>
</form>
</div>


<!-- Ionic Framework-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
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