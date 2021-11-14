<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <script src="https://unpkg.com/feather-icons"></script>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_DASHBOARD ?>style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Belleza&family=Dancing+Script:wght@400;600&family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <div class="head-area">
        <h2 class="logo"><span>R</span>aiane Dev</h2>
    </div>
    <div class="area-head">
        <div class="card-search"><i data-feather="search"></i> <input type="search" placeholder="Search in front" /></div>
    </div>
    <div class="area-head">
        <span class="circle-hover"><i data-feather="bell"></i></span>
        <span class="circle-hover"><i data-feather="grid"></i></span>
        <span class="circle-hover"><i data-feather="activity"></i></span>
        <img src="" class="user" />
    </div>
</header>
<section class="global">
<aside>
    <div class="aside">
        <div class="main">
            <nav>
                <ul>
                    <li><i data-feather="home"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>">Home</a></li>
                    <li><i data-feather="package"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>products">Products</a></li>
                    <li><i data-feather="shopping-bag"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>orders">Orders</a></li>
                    <li><i data-feather="user-plus"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>add-user">Add User</a></li>
                    <li><i data-feather="message-square"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>avaliations">Avaliations</a></li>
                    <li><i data-feather="users"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>clients">Clients</a></li>
                    <li><i data-feather="clipboard"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>add-product">Add Product</a></li>
                    <li><i data-feather="box"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>orders">Orders</a></li>
                    <li><i data-feather="user"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>profile">Profile</a></li>
                    <li><i data-feather="camera"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>settings?images-uploads">Images & Uploads</a></li>
                    <li><i data-feather="settings"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>settings">Settings</a></li>
                </ul>
            </nav>
        </div>

        <div class="main-footer">
            <span class="circle-hover"><i data-feather="alert-triangle"></i></span>
            <span class="circle-hover"><i data-feather="info"></i></span>
            <span class="circle-hover"><i data-feather="external-link"></i></span>
        </div>
    </div>
</aside>
<main>
