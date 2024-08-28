<?php
$email = $_POST['email'];
$verificationCode = $_POST['verification_code'];
if ($enteredCode == $storedCode) {
    header('Location: reset_password.html');
    exit;
} else {
    echo 'Verification code is incorrect.';
}
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
        <h2>Enter Verification Code</h2>
        <form action="verify_code.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
        <label for="verification_code">Enter the verification code sent to your email:</label>
        <input type="text" id="verification_code" name="verification_code" required>
        <button type="submit">Verify Code</button>
    </form>
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
