<?php
    if(isset($_POST['register'])){
        ControllerDashboard\ControllerDashboard::register($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image'], $_POST['function'], $_POST['cep'], $_POST['lat_coord'], $_POST['long_coord']);
    }
    if(isset($_POST['login'])){
        ControllerDashboard\ControllerDashboard::login($_POST['email'], $_POST['password']);
    }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Access</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_DASHBOARD ?>style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Dancing+Script:wght@400;600&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
<section class="access">
    <img class="background" src="https://htmlstream.com/front-dashboard/assets/svg/components/abstract-bg-4.svg" />
    <div class="access">
    <h2 class="logo">R<span>aiane Dev</span></h2>
    <div class="box">
        <?php
            if(!isset($_GET['register'])){
        ?>
        <h2>Sign In Account</h2>
        <p class="info">Don't have an account yet? <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>access?register">Sign up here</a></p>

        <form method="post">
            <input type="email" name="email" placeholder="email@address.com" />
            <input type="password" name="password" placeholder="*****" />
            <input type="submit" name="login" value="Sign in" />
        </form>
        <?php } ?>

        <?php
            if(isset($_GET['register'])){
        ?>
        <h2>Sign In Account</h2>
        <p class="info">Don't have an account yet? <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>access">Sign up here</a></p>

        <form method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="First e Last name" />
            <input type="email" name="email" placeholder="email@address.com" />
            <input type="file" name="image" />
            <input type="number" name="cep" />
            <input type="hidden" name="lat_coord" id="lat_coord" />
            <input type="hidden" name="long_coord" id="long_coord" />
            <select name="function">
                <option value="user">User</option>
                <option value="vendor">Vendor</option>
            </select>
            <input type="password" name="password" placeholder="*****" />
            <input type="submit" name="register" value="Sign in" />
        </form>
        <?php } ?>

        </div>
    </div>
</section>


<script>
    feather.replace()
</script>
<script src="<?php echo INCLUDE_PATH_DASHBOARD ?>js/script.js"></script>
</body>
</html>