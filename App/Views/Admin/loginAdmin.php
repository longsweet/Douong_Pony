<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="/Douong_Pony/Assets/Admin/css/style1.css">
</head>

<body>


    <div class="error">
        <?php
        if (isset($_SESSION['error'])) {
            echo "<p>" . $_SESSION['error'] . "</p>";
            unset($_SESSION['error']);
        }

        ?>

    </div>
    <form action="<?= BASE_URL ?>?act=login-post" accept-charset="utf-8" method="post">
        <h3>Login Admin</h3>



        <label for="email">Tài Khoản</label>
        <input type="text" placeholder="Email or Phone" name="email" id="email">

        <label for="password">Password</label>
        <input type="password" placeholder="Password" name="password" id="password">

        <button>Log In</button>
        <p class="social-text">Login with a social media account</p>

        <div class="social-icons">

            <button class="social-icon fb"><i class="fa-brands fa-facebook"></i></button>
            <button class="social-icon tw"><i class="fa-brands fa-twitter"></i></button>
            <button class="social-icon in"><i class="fa-brands fa-instagram"></i></button>

        </div>
    </form>
</body>

</html>