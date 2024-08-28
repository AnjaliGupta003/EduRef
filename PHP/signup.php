<?php
session_start();
include("db.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_mail = trim($_POST['email']) ?? '';
    $user_name = trim($_POST['username']) ?? '';
    $user_pass = trim($_POST['password']) ?? '';

    // Input validation
    if (filter_var($user_mail, FILTER_VALIDATE_EMAIL) && !empty($user_pass) && !empty($user_name)) {
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ? OR username = ? LIMIT 1");
        $stmt->bind_param("ss", $user_mail, $user_name);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            echo "<script type='text/javascript'>alert('Email or Username already registered');</script>";
        } else {
            $hashed_password = password_hash($user_pass, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (email, username, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user_mail, $user_name, $hashed_password);
            $stmt->execute();

            echo "<script type='text/javascript'>alert('Successfully registered');</script>";
        }
        $stmt->close();
    } else {
        echo "<script type='text/javascript'>alert('Please enter valid information');</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup - Educational Reference Site</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <header>
        <div class="logo">EduRef</div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="subjects.html">Subjects</a></li>
                <li><a href="tools.html">Tools</a></li>
                <li><a href="guides.html">Study Guides</a></li>
                <li><a href="community.html">Community</a></li>
            </ul>
        </nav>
        <div class="account">
            <a href="login.html" class="btn account-btn">Login</a>
            <a href="signup.html" class="btn account-btn">Sign Up</a>
        </div>
    </header>
    <section class="signup-section">
        <div class="container">
            <h2>Create Your Account</h2>
            <form action="signup.php" method="POST" class="signup-form">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <br><br>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
                <br><br>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <br><br>
                <button type="submit" class="btn">Sign Up</button>
            </form>
            <p>By clicking the Sign Up button, you agree to our<br>
            <a href="">Terms and Conditions</a> and <a href="">Privacy Policy</a></p>
            <p>Already have an account? <a href="login.html">Log in here</a></p>
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
    <script src="signup.js"></script>
</body>
</html>
