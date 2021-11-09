<?php
    if(isset($_POST['register']) ? Controller\Controller::register($_POST['name'], $_POST['email'], $_POST['password'], $_FILES['image'], $_POST['function']) : '');
    if(isset($_POST['login']) ? Controller\Controller::login($_POST['email'], $_POST['password']) : '');
?>
<div class="separator"></div>
    <section class="access">
        <div class="banner">
            <img src="assets/banner-access.jpg" />
            <h1>Access Acount</h1>
        </div>
        <div class="access">
        <?php 
            if($_GET['url'] == 'access' && !isset($_GET['register'])){
        ?>
        <div class="login">
            <h2 class="title">Login</h2>
            <form method="post">
                <label class="label">Email</label>
                <input type="email" name="email" placeholder="example@example.com" />
                <label class="label">Password</label>
                <input type="password" name="password" placeholder="****" />
                <input type="submit" name="login" value="Login" />
            </form>

            <a href="?register">Don't have an account yet? Click here.</a>
        </div>
        <?php } ?>

        <?php 
            if(isset($_GET['register'])){
        ?>
        <div class="register">
        <h2 class="title">Register</h2>
            <form method="post" enctype="multipart/form-data">
                <label class="label">Name</label>
                <input type="text" name="name" />

                <label class="label">Email</label>
                <input type="email" name="email" />

                <label class="label">Image</label>
                <input type="file" name="image" />

                <select name="function">
                    <option value="user">User</option>
                    <option value="vendor">Vendor</option>
                </select>

                <label class="label">Password</label>
                <input type="password" name="password" placeholder="****" />
                <input type="submit" name="register" value="Register" />
            </form>

            <a href="<?php echo INCLUDE_PATH ?>access">Already have an account?</a>
        </div>
        <?php } ?>
    </div>
</section>