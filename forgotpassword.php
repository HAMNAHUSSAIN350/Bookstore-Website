<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Check if the email exists in the database (example code)
    $conn = new mysqli('localhost', 'root', '', 'Library');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Generate a unique reset password
        $token = bin2hex(random_bytes(50));
        $stmt = $conn->prepare("UPDATE users SET reset_password = ? WHERE email = ?");
        $stmt->bind_param("ss", $password, $email);
        $stmt->execute();

        // Send the reset link via email (simplified for demonstration)
        $resetLink = "http://yourwebsite.com/reset_password.php?token=$password";
        mail($email, "Password Reset", "Click the link to reset your password: $resetLink");

        echo "Password reset link has been sent to your email.";
    } else {
        echo "No account found with this email.";
    }
}
?>
<!DOCTYPE html>
<html>

<?php include 'head.php';?>
<style>
      /* Basic Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
  background: #000;
}

/* Container for the form */
form {
  background-color: #000;
  padding: 20px 30px;
  border-radius: 8px;
  box-shadow: 0 0 50px #0ef;
  width: 100%;
  max-width: 400px;
  text-align: center;
}

/* Title */
form h2 {
  color: #fff;
  margin-bottom: 20px;
  font-size: 24px;
}

/* Form Inputs */
form input[type="email"],
form input[type="submit"] {
  width: 100%;
  padding: 12px;
  margin: 10px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
}

form input[type="email"] {
  border-color: #6c757d;
}

/* Submit Button */
form input[type="submit"] {
  background-color: #000;
  border: none;
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

form input[type="submit"]:hover {
  background-color: #0ef;
}

/* Link for redirection */
form .back-link {
  display: block;
  margin-top: 15px;
}

form .back-link a {
  color: #fff;
  text-decoration: none;
}

form .back-link a:hover {
  text-decoration: underline;
}

/* Responsive Design */
@media screen and (max-width: 768px) {
  form {
    padding: 15px 20px;
  }

  form h2 {
    font-size: 20px;
  }

  form input[type="email"],
  form input[type="submit"] {
    font-size: 14px;
  }
}

</style>
</head>
<body>
    <form action="forgotpassword.php" method="post">
        <h2>Forgot Password</h2>
        <div>
            <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div>
            <input type="submit" value="Send Reset Link">
        </div>
    </form>
</body>
</html>
