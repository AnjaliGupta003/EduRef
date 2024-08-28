<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $user_mail = $_POST['email'] ?? '';
    $user_pass = $_POST['password'] ?? '';

    // Validate form data
    if (!empty($user_mail) && !empty($user_pass) && !is_numeric($user_mail)) {
        // Prepare an SQL statement to prevent SQL injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        $stmt->bind_param("s", $user_mail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $user_data = $result->fetch_assoc();
            // Debugging: Check fetched data
            error_log(print_r($user_data, true));
            // Corrected password_verify function
            if (password_verify($user_pass, $user_data['password'])) {
                // Set session variables
                $_SESSION['user_mail'] = $user_data['email'];

                // Redirect to account.html
                header("Location: account.html");
                die;
            } else {
                error_log("Password verification failed");
                echo "<script type='text/javascript'>alert('Wrong email or password');</script>";
            }
        } else {
            error_log("No user found with the provided email");
            echo "<script type='text/javascript'>alert('Wrong email or password');</script>";
        }
        $stmt->close();
    } else {
        error_log("Invalid input");
        echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Educational Reference Site</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="logo">EduRef</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="subjects.html">Subjects</a></li>
                <li><a href="tools.html">Tools</a></li>
                <li><a href="guides.html">Study Guides</a></li>
                <li><a href="community.html">Community</a></li>
                <li><a href="resources.html">Resources</a></li>
            </ul>
        </nav>
        <div class="search">
            <input type="text" placeholder="Search...">
            <button class="search-btn">Search</button>
        </div>
        <div class="account">
            <a href="login.php" class="btn account-btn">Login</a>
            <a href="signup.php" class="btn account-btn">Sign Up</a>
        </div>
    </header>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <h2>Login to Your Account</h2>
            <form action="login.php" method="POST" class="login-form">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <br><br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <button type="submit" class="btn">Login</button>
                <div class="forgot-password">
                    <a href="forgot_password.html">Forgot Password?</a>
                </div>
            </form>
            <p>Don't have an account? <a href="signup.html">Sign up here</a></p>
        </div>
    </section>

    <footer class="footer-section">
        <div class="container">
            <div class="footer-grid">
                <div class="quick-links">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                        <li><a href="#privacy">Privacy Policy</a></li>
                        <li><a href="#terms">Terms of Service</a></li>
                    </ul>
                </div>
                <div class="social-media">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="#facebook">Facebook</a></li>
                        <li><a href="#twitter">Twitter</a></li>
                        <li><a href="#instagram">Instagram</a></li>
                        <li><a href="#linkedin">LinkedIn</a></li>
                    </ul>
                </div>
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    <p>Email: info@eduref.com</p>
                    <p>Phone: (123) 456-7890</p>
                    <p>Address: 123 Education St, Learning City, 12345</p>
                </div>
            </div>
        </div>
    </footer>
    <script src="login.js"></script>
</body>
</html>
