<?php
session_start();
$error = $_SESSION['error'] ?? null;
$success = $_SESSION['success'] ?? null;
unset($_SESSION['error'], $_SESSION['success']);

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng nhập & Đăng ký</title>
    <link rel="stylesheet" href="css/login-signup.css">
</head>
<body>

<?php if ($error || $success): ?>
<div id="<?= $error ? 'error-popup' : 'success-popup' ?>">
    <div class="popup-content">
        <span><?= $error ?? $success ?></span>
    </div>
</div>
<?php endif; ?>


<style>
    #error-popup, #success-popup {
        position: fixed;
        top: -100px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 9999;
        animation: slideDown 0.5s ease forwards, fadeOut 0.5s ease 4.5s forwards;
    }

    #error-popup .popup-content {
        background-color: #f44336;
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        font-family: sans-serif;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    #error-popup .popup-content button {
        background-color: rgba(255,255,255,0.2);
        border: none;
        color: white;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    #success-popup .popup-content {
        background-color:rgb(0, 228, 68);
        color: white;
        padding: 16px 24px;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        font-family: sans-serif;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    #success-popup .popup-content button {
        background-color: rgba(255,255,255,0.2);
        border: none;
        color: white;
        padding: 6px 12px;
        cursor: pointer;
        border-radius: 4px;
    }

    @keyframes slideDown {
        from {
            top: -100px;
            opacity: 0;
        }
        to {
            top: 20px;
            opacity: 1;
        }
    }

    @keyframes fadeOut {
        to {
            opacity: 0;
        }
    }
</style>


<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
        <h2 id="signInTab" class="active"> Sign In </h2>
        <h2 id="signUpTab" class="inactive underlineHover">Sign Up </h2>

        <!-- Icon -->
        <div class="fadeIn first">
            <img src="https://cdn-icons-png.flaticon.com/512/5087/5087579.png" id="icon" alt="User Icon" />
        </div>

    <!-- Login Form -->
        <form id="loginForm" class="formSection" action="process_login.php" method="POST">
            <input type="text" id="login" class="fadeIn second" name="login" placeholder="Tên đăng nhập...">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Mật khẩu...">
            <input type="submit" class="fadeIn fourth" value="Log In">
        </form>

    <!-- Register Form -->
        <form id="signupForm" action="process_register.php" method="POST" class="formSection" style="display: none;">
            <input type="text" id="newUser" class="fadeIn second" name="username" placeholder="Tên đăng nhập...">
            <input type="text" id="fullName" class="fadeIn second" name="fullname" placeholder="Họ và tên...">
            <input type="email" id="email" class="fadeIn third" name="email" placeholder="Email...">
            <input type="password" id="newPassword" class="fadeIn third" name="password" placeholder="Mật khẩu...">
            <input type="password" id="newPassword" class="fadeIn third" name="confirm_password" placeholder="Xác nhận mật khẩu...">
            <input type="submit" class="fadeIn fourth" value="Sign Up">
        </form>

    <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>

    </div>
</div>

<script>
    const signInTab = document.getElementById("signInTab");
    const signUpTab = document.getElementById("signUpTab");
    const loginForm = document.getElementById("loginForm");
    const signupForm = document.getElementById("signupForm");

        signInTab.addEventListener("click", () => {
        signInTab.classList.add("active");
        signInTab.classList.remove("inactive");
        signUpTab.classList.add("inactive");
        signUpTab.classList.remove("active");

    loginForm.style.display = "block";
    signupForm.style.display = "none";
    });

    signUpTab.addEventListener("click", () => {
        signUpTab.classList.add("active");
        signUpTab.classList.remove("inactive");
        signInTab.classList.add("inactive");
        signInTab.classList.remove("active");

        loginForm.style.display = "none";
        signupForm.style.display = "block";
    });

        setTimeout(() => {
        const popup = document.getElementById('popup');
        if (popup) popup.style.display = 'none';
    }, 5000);

</script>

</body>
</html>
