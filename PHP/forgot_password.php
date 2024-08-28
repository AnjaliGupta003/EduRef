<?php
$email = $_POST['email'];
$verificationCode = mt_rand(100000, 999999);
$subject = 'Password Reset Verification Code';
$message = 'Your verification code is: ' . $verificationCode;
$headers = 'From: anjaligupta96989@example.com';
header('Location: verify_code.php?email=' . $email);
exit;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Educational Reference Site</title>
    <link rel="stylesheet" href="forgot.css">
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
        <div class="account-details" onclick="toggleAccountInfo()">
            <img src="user.png" alt="User" width="50px" height="auto" style="mix-blend-mode: multiply; object-fit: cover;"> <!-- Make sure you have this image file or replace it with an appropriate one -->
        </div>
        
    </header>
    <section class="forgot-password-section">
        <div class="container">
            <h2>Forgot Your Password?</h2>
            <p>Enter your email address below and we'll send you a link to reset your password.</p>
            <form action="verify.php" method="POST" class="forgot-password-form">
                <label for="email">Email Address</label>
                <input type="email" id="email" name="email" required>
                <button name="btn" id="btn">Submit</button>
            </form>
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

    <script src="index.js"></script>
</body>
</html>
