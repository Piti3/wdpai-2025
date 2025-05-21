<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/8fd9367667.js" crossorigin="anonymous"></script>

    <link href="public/styles/main.css" rel="stylesheet">
    <script src="public/scripts/script.js" defer></script>
    
    <title>Login</title>
</head>
<body id="login-page" class="flex-row-center-center">

    <div class="welcome-logo-container">
        <img src="public/images/htrack_logo.png" alt="hTrack Logo" class="logo">
        <h1 class="welcome">Welcome to hTrack!</h1>
    </div>

    <div class="flex-row-center-center">
        <h1>Login to your account</h1>
        <form class="login-form flex-column-center-center" action="login" method="POST">
            <div class="messages">
                <?php if(isset($messages)) {
                    foreach ($messages as $message) {
                        echo $message;
                    }
                }?>
            </div>
            <div class="email">
                <label for="email">Email</label>
                <input name="email"type="email" id="email" placeholder="Enter your email">
            </div>
            
            <div class="password_2">
                <label for="password">Password</label>
                <a href="forgot-password" class="forgot">Forgot?</a>
            </div>
            
            <div class="password">
                <input name="password"type="password" id="password" placeholder="Enter your password">
                <i class="fa-solid fa-eye flex-column-center-center" onclick="togglePassword()"></i>  
            </div>
            
            <button type="submit"><i class="fa-solid fa-right-to-bracket"></i> Login now</button>

            <div class="Sign-up-container">
                <h1 class="sign-up-text">Don't have an account yet? <a href="register" class="sign-up">Sign UP!</a></h1>
                
            </div>
        </form>
    </div>
</body>
</html>