<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get email and password from the POST data
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    // Dummy credentials for demonstration, replace with your database check
    $valid_email = "user@example.com";
    $valid_password = password_hash("password123", PASSWORD_DEFAULT);  // Example hashed password

    // Check if the entered email and password match the valid credentials
    if ($email == $valid_email && password_verify($password, $valid_password)) {
        // Store session data (e.g., user is logged in)
        $_SESSION['user'] = $email;
        header("Location: ../Dashboard/Dashboard-page.php");  // Redirect to the dashboard after successful login
        exit();
    } else {
        $error_message = "Invalid email or password. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="Login-page.css">
    <link rel="stylesheet" href="../Navbar/navbar.css">
    <link href="https://fonts.googleapis.com/css2?family=Rock+Salt&display=swap" rel="stylesheet">
</head>
<body>

<?php include '../Navbar/non-reg-navbar.php'; ?>

<div class="container">
    <div class="box-left">
        <h2>Log in to Remed</h2>
        <p>Welcome back! Log in to access your pharmacy’s dashboard, where you can manage inventory, process customer orders, and update your pharmacy's details. Stay connected with your customers, track deliveries, and ensure your pharmacy runs smoothly. Enter your credentials to continue.</p>
    </div>
    <div class="box-right">
        <?php
        // Display error message if credentials are incorrect
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <form id="login-form" action="login.php" method="POST">
            <label for="email">User name or Email Address:</label>
            <input type="email" id="email" name="email" required><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br>

            <div class="form-footer">
                <label>
                    <input type="checkbox" name="remember"> Remember me
                </label>
            </div>

            <button type="submit" class="register-btn">Login</button>
            <a href="#" class="forgot-password">Forgot Password?</a>
        </form>
    </div>
</div>

</body>
</html>
