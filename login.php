<?php

include 'connection.php';
session_start();

if(isset($_POST['submit'])){

    $email=mysqli_real_escape_string($conn,$_POST['email']);
    $password = ($_POST['password']);

    $select_users=mysqli_query($conn,"SELECT * FROM `register` WHERE email='$email' AND password='$password'") or die(mysqli_error($conn));

    if(mysqli_num_rows($select_users) > 0){
        $row=mysqli_fetch_assoc($select_users);
            
        if($row['user_id'] =='user'){
            $_SESSION['user_name']=$row['name'];
            $_SESSION['user_email']=$row['email'];
            $_SESSION['user_id']=$row['id'];
            echo "<script type = 'text/javascript'>alert('You have been successfully logged in as User!');</script>";
            echo "<script type = 'text/javascript'> window.location.href='home.php'</script>";

            exit();
           
        }
    }else{
        $message[]='Incorrect email or password';
    }
}



?>


<!DOCTYPE html>
<html>

<?php include 'head.php' ?>
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins&display=swap');

 

*{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}


body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background-color: #000;
}

.wrapper{
    position: relative;
    width: 400px;
    height: 500px;
    background: transparent;
    border: 5px solid #333;
    border-radius: 10px;
}

.wrapper:hover{
    border: 5px solid #0ef;
    box-shadow: 0 0 20px #0ef, inset 0 0 20px #0ef  ;
}


h2{
    color: #fff;
    font-weight: 500;
    text-align: center;
    letter-spacing: 0.1rem;

}

.wrapper:hover h2{
    color: #0ef;

}

.input-box{
    position: relative;
    width: 100%;
    margin-top: 30px 0;

}

.input-box input{
    position: relative;
    width: 100%;
    height:50px;
    background: transparent;
    border: 2px solid #333;
    outline: none;
    margin: 30px 0;
    border-radius: 5px;
    font-size:1rem;
    color: #fff;
    padding: 0 10px 0 35px;
    transition: .5s;
}

.wrapper:hover .input-box input{
      border: 2px solid #0ef;
      box-shadow: 0 0 10px #0ef, inset 0 0 10px #0ef;


}

.input-box input::placeholder{
    color: rgba(255, 255, 255, .3);
}

.input-box .icon{
    position: absolute;
    left: 10px;
    top:50%;
    transform: translateY(-50%);
    color:#fff;
    font-size: 1.2rem;
    line-height: 50px;
    transition: 0.5s;
}

.wrapper:hover .input-box .icon{
     color:#0ef
}

.forgot-pass{
    text-align: center;
    margin: -15px 0 15px;
}

.forgot-pass a{
    color: #fff;
    font-size: 0.9rem;
    text-decoration: none;
}

.forgot-pass a:hover{
    text-decoration: underline;
}

button{
    position: relative;
    width:100%;
    height:45px;
    background: #333;
    border: none;
    outline:none;
    border-radius: 5px;
    cursor:pointer;
    font-size: 1rem;
    color: #fff;
    font-weight:500;
    transition: .5s;
}

.wrapper:hover button{
    background: #0ef;
    color:#000;
    box-shadow: 0 0 20px #0ef;
}

.register-link {
    font-size: .9em;
    text-align: center;
    margin: 25px 0;
}

.register-link p {
     color:#fff

}

.register-link p a {
      color:#333;
      text-decoration: none;
      font-weight:600;
      transition: .5s;
    }
 
.wrapper:hover .register-link p a{
    color:#0ef;
}

.register-link p a:hover {  
      text-decoration: underline;
}  

</style>

<body>

<?php
if (!empty($message)) {  
    foreach ($message as $msg) {
        echo '<div class="message"><span>'.$msg.'</span></div>';
    }
}

?>


     <div class="wrapper">
        <form action="login.php" method="post">
              <h2>Login</h2>
              <div class="input-box">
                <span class="icon"><ion-icon name="person"></ion-icon></span>
                <input type="email" name="email" placeholder="Email" required="required">
              </div>
              <div class="input-box">
                <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                <input type="password" name="password" placeholder="Password" required="required">
              </div>
              <div class="forgot-pass">
                <a href="forgotpassword.php">Forgot Password</a>
              </div>
              <button type="submit" name="submit">Login</button>
              <div class="register-link">
                <p>Don't have an account?</p><a href="register.php">Sign up</a>
              </div>
        </form>
     </div>




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
<!-- Ionic Framework-->
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>

</html>