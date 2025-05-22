<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>

    <link href="public/styles/register.css" rel="stylesheet">
    <script src="public/scripts/hide_password.js" defer></script>
    
    <title>Register</title>
</head>
<body id="login-page" class="flex-row-center-center">

    <div class="welcome-logo-container">
        <img src="public/images/htrack_logo.png" alt="hTrack Logo" class="logo">
    </div>

    <div class="flex-row-center-center">
        <h1>Create an account</h1>
        <form class="login-form flex-column-center-center" action="register" method="POST">
            <div class="messages">
                <?php if (isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                } ?>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input name="email" type="email" id="email" placeholder="Enter your email">
            </div>
            <div class="password_header1">
                <label for="password">Password</label>
            </div>
            <div class="password">
                <input name="password" type="password" id="password" placeholder="Enter your password">
                <i class="fa-solid fa-eye flex-column-center-center" onclick="togglePassword(this)"></i>  
            </div>
            <div class="password_header2">
                <label for="Confirm_password">Confirm Password</label>
            </div>
            <div class="password_confirm">
                <input name="confirm_password" type="password" id="confirm_password" placeholder="Enter your password">
                <i class="fa-solid fa-eye flex-column-center-center" onclick="togglePassword(this)"></i>  
            </div>
            <div class="checkbox-container">
                <input type="checkbox" id="agree" required>
                <h1 class="checkbox">I agree to all the <a href="terms-page.html" class="terms">Terms</a> and <a href="privacy-policies-page.html" class="terms">Privacy Policies</a></h1>   
            </div>
            <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Create account</button>
            <div class="Sign-in-container">
                <h1 class="sign-in-text">Already have an account?? <a href="/" class="sign-in">Sign In!</a></h1>   
            </div>
        </form>
    </div>
</body>
</html>