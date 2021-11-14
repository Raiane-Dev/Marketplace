<?php
    $shop = Model\Model::getOne('shop',"WHERE vendor_id = '$_SESSION[user_id]'");
    $user = Model\Model::getOne('users',"WHERE id = '$_SESSION[user_id]'");
    $shop_policies = Model\Model::getOne('shop_policies',"WHERE shop_id = $shop[id]");
    $card = Model\Model::getOne('info_payment',"WHERE `vendor_id` = '$_SESSION[user_id]'");
    $shop_schedules = Model\Model::getOne('shop_schedules',"WHERE shop_id = $shop[id]");
    $shop_coupons = Model\Model::getWhere('coupons',"WHERE shop_id = $shop[id]");
?>
<section class="settings">
    <div class="card-head">
        <h6>Dashboard</h6>
    </div>

    <div class="separator"></div>

    <div class="columns-two-bedroom">
        <div class="container">
            <nav>
                <ul>
                    <li><i data-feather="user"></i> <a href="?settings-account"> Basic Information </a></li>
                    <li><i data-feather="home"></i> <a href="?shop-settings"> Shop Settings </a></li>
                    <li><i data-feather="credit-card"></i> <a href="?payment-config"> Payment Config </a></li>
                    <li><i data-feather="map-pin"></i> <a href="?location"> Location </a></li>
                    <li><i data-feather="file-text"></i> <a href="?store-policies"> Store Policies </a></li>
                    <li><i data-feather="users"></i> <a href="?team-members"> Team Members </a></li>
                    <li><i data-feather="dollar-sign"></i> <a href="?payments"> Payments </a></li>
                    <li><i data-feather="activity"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>"> Analytics </a></li>
                    <li><i data-feather="clock"></i> <a href="?schedules"> Schedules </a></li>
                    <li><i data-feather="camera"></i> <a href="?images-uploads"> Images & Uploads </a></li>
                    <li><i data-feather="bookmark"></i> <a href="?coupons"> Coupons </a></li>
                    <li><i data-feather="key"></i> <a href="?security"> Security </a></li>
                    <li><i data-feather="power"></i> <a href="?close-shop"> Close Shop </a></li>
                    <li><i data-feather="log-out"></i> <a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>loggout"> Loggout </a></li>
                </ul>
            </nav>
        </div>

        <div class="feed">
            <div class="container">
                <div class="head-user">
                    <div class="cover"></div>
                        <div class="columns-two-bedroom">
                            <div>
                                <figure><img src="<?php echo INCLUDE_PATH ?>assets/amanda-doe.jpg" class="user"/></figure>
                            </div>
                        <div>
                            <ul>
                                <li><i data-feather="at-sign"></i> Htmlstream</li>
                                <li><i data-feather="map-pin"></i> San Francisco, US</li>
                                <li><i data-feather="send"></i>  Joined March 2017</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            

            <!--SETTINGS ACCOUNT-->
            <?php if(isset($_GET['settings-account'])){ 
                if(isset($_POST['action'])){
                    ControllerDashboard\ControllerDashboard::updateUser($_POST['name'], $_POST['email'], $_FILES['image']);
                }    
            ?>
            <div class="separator"></div>

            <div>
                <div class="container">
                    <div class="card-head"><h5>Settings Account</h5></div>
                    <div class="container-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="two-inputs">
                                <div>
                                    <label>Full Name</label>
                                </div>
                                <input class="nill" type="text" name="name" value="<?php echo $_SESSION['name']; ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label> Email </label></div>
                                <div><input type="email" name="email" value="<?php echo $_SESSION['email'] ?>" /></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> Avatar </label></div>
                                <div><input type="file" name="image" /></div>
                            </div>

                            <input type="submit" name="action" value="Update" />
                        </form>
                    </div>
                </div>
                <?php } ?>


                <!--SETTINGS SHOP-->
                <?php if(isset($_GET['shop-settings'])){
                        if(isset($_POST['action'])){
                            ControllerDashboard\ControllerDashboard::settings($_POST['name'], $_POST['description'], $_FILES['image']);    
                }  ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post" enctype="multipart/form-data">
                            <div class="two-inputs">
                                <div>
                                    <label>Name Shop</label>
                                </div>
                                <input class="nill" type="text" name="name" value="<?php echo @$shop['name'] ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label> Description </label></div>
                                <div><textarea name="description"><?php echo @$shop['description'] ?></textarea></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> Logo </label></div>
                                <div><input type="file" name="image" /></div>
                            </div>

                            <input type="submit" name="action" value="Send" />
                        </form>
                    </div>
                </div>
                <?php } ?>


                <!--SETTINGS PAYMENT CONFIG-->
                <?php if(isset($_GET['payment-config'])){ 
                    if(isset($_POST['action'])){
                        $create = new ControllerPayment\paySplit;
                        $create->createClient($_SESSION['user_id'],$_POST['email']);
                    }
                    if(@$card['vendor_id'] == $_SESSION['user_id']){
                        $attr = 'disabled';
                    }else{
                        $attr = '';
                    }
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Payment Config</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label>Email</label></div>
                                <input <?php echo $attr; ?> class="nill" type="email" name="email" value="<?php echo @$card['email']; ?>" />
                            </div>
                            <input <?php echo $attr; ?> type="submit" name="action" value="Config" />
                        </form>
                    </div>
                </div>
                
                <div class="separator"></div>
                <?php
                    if(@$card['email'] !== ''){    
                    if(isset($_POST['send_token'])){
                        ControllerDashboard\ControllerDashboard::token($_POST['token']);
                    } ?>
                <div class="container">
                    <div class="card-head"><h5>Token Live</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                            <div><label>Token</label></div>
                                <input <?php echo $attr; ?> class="nill" type="text" name="token" value="<?php echo @$card['token']; ?>" />
                            </div>

                            <input <?php echo $attr; ?> type="submit" name="send_token" value="Send" />
                        </form>
                    </div>
                </div>
                <?php }} ?>


                <!--LOCATION-->
                <?php if(isset($_GET['location'])){
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::updateLocation($_POST['lat_coord'], $_POST['long_coord'], $_POST['cep']);
                    }    
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div>
                                    <label>Latitude</label>
                                </div>
                                <input class="nill" type="text" name="lat_coord" value="<?php echo @$user['lat_coord'] ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label> Longitude </label></div>
                                <div><input class="nill" type="text" name="long_coord" value="<?php echo @$user['long_coord'] ?>" /></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> CEP </label></div>
                                <div><input class="nill" type="text" name="cep" value="<?php echo @$user['cep'] ?>" /></div>
                            </div>

                            <input type="submit" name="action" value="Update" />

                        </form>
                    </div>
                </div>

                <div class="separator"></div>
                <div id="google-map"></div>
                <?php } ?>


                <?php if(isset($_GET['store-policies'])){ 
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::storePolicies($_POST['privacy_policy'], $_POST['shipping_policy'], $_POST['refund_policy'], $shop['id']);    
                    }
                ?>
                <!--SETTINGS STORE POLICIES-->
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label> Privacy Policy </label></div>
                                <div><textarea name="privacy_policy"><?php echo @$shop_policies['privacy_policy']; ?></textarea></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> Shipping Policy </label></div>
                                <div><textarea name="shipping_policy"><?php echo @$shop_policies['shipping_policy'] ?></textarea></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> Refund Policy </label></div>
                                <div><textarea name="refund_policy"><?php echo @$shop_policies['refund_policy'] ?></textarea></div>
                            </div>

                            <input type="submit" name="action" value="Update" />

                        </form>
                    </div>
                </div>
                <?php } ?>

                <!--SETTINGS TEAM MEMBERS-->
                <?php if(isset($_GET['team-members'])){ ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div>
                                    <label>Name Shop</label>
                                </div>
                                <input class="nill" type="text" name="name" value="<?php echo @$shop['name'] ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label> Description </label></div>
                                <div><textarea><?php echo $shop['description'] ?></textarea></div>
                            </div>

                            <div class="two-inputs">
                                <div><label> Logo </label></div>
                                <div><input type="file" value="<?php echo $shop['logo']; ?>" /></div>
                            </div>

                            <input type="submit" name="update" value="Update" />

                        </form>
                    </div>
                </div>
                <?php } ?>


                <!--SHOWROOM-->
                <?php if(isset($_GET['showroom'])){
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::showroom($shop['id'], $_POST['name'], $_POST['image']);
                    }
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Showroom Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label>Name</label></div>
                                <input class="nill" type="text" name="name" />
                            </div>

                            <div class="two-inputs">
                                <div><label>Image</label></div>
                                <input class="nill" type="file" name="image" />
                            </div>

                            <input type="submit" name="action" value="Create" />
                        </form>

                        <table class="columns-five-bredroom">
                            <thead>
                                <tr>
                                    <td>Full Name</td>
                                    <td>Type</td>
                                    <td>Email</td>
                                    <td>Signed</td>
                                    <td>User ID</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $showroom = Model\Model::getWhere('showroom',"WHERE `shop_id` = $shop[id]");
                                    foreach($showroom as $key => $value){
                                ?>
                                <tr>
                                    <td><img class="square" src="<?php echo INCLUDE_PATH ?>assets/<?php echo $value['image']; ?>"/></td>
                                    <td><?php echo $value['name']; ?></td>
                                    <td><?php echo fileowner(BASE_DIR.$value['image']); ?></td>
                                    <td><?php echo date('Y-m-d', fileatime(BASE_DIR.$value['image'])); ?></td>
                                    <td><?php echo disk_free_space(BASE_DIR); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>


                <!--SCHEDULES-->
                <?php if(isset($_GET['schedules'])){
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::schedulesConfig($_POST['open_since'],$_POST['close_until'], $_POST['days_week'], $shop['id']);
                    }
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label>Name Shop</label></div>
                                <input class="nill" type="time" name="open_since" value="<?php echo @$shop_schedules['open_since'] ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label>Name Shop</label></div>
                                <input class="nill" type="time" name="close_until" value="<?php echo @$shop_schedules['close_until'] ?>" />
                            </div>

                            <div class="two-inputs">
                                <div><label>Name Shop</label></div>
                                <input class="nill" type="text" name="days_week" value="<?php echo @$shop_schedules['days_week'] ?>" />
                            </div>

                            <input type="submit" name="action" value="Update" />

                        </form>
                    </div>
                </div>
                <?php } ?>


                <!--IMAGES & UPLOADS-->
                <?php if(isset($_GET['images-uploads'])){ 
                    if(isset($_POST['send'])){
                        Model\Model::uploadFile($_FILES['upload']);
                    }
                ?>
                <div class="separator"></div>
                <div class="column-one">
                    <div class="container">
                        <form method="post" enctype="multipart/form-data">
                        <div class="card-head flex">
                            <div><input type="submit" name="send" value="Send" /></div>
                            <div><input type="file" name="upload" style="display:none;" id="upload"/>
                            <label onclick="upload();" for="upload"><i data-feather="plus"></i></label></div>
                        </div>
                        </form>
                        <table class="columns-five-bredroom">
                            <thead>
                                <tr>
                                    <td>Full Name</td>
                                    <td>Type</td>
                                    <td>Email</td>
                                    <td>Signed</td>
                                    <td>User ID</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $images = Model\Model::getWhere('products',"WHERE `shop_id` = $shop[id]");
                                    foreach($images as $key => $value){
                                ?>
                                <tr>
                                    <td><img class="square" src="<?php echo INCLUDE_PATH ?>assets/<?php echo $value['images']; ?>"/></td>
                                    <td><?php echo filesize(BASE_DIR.$value['images']); ?> bytes</td>
                                    <td><?php echo fileowner(BASE_DIR.$value['images']); ?></td>
                                    <td><?php echo date('Y-m-d', fileatime(BASE_DIR.$value['images'])); ?></td>
                                    <td><?php echo disk_free_space(BASE_DIR); ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php } ?>


                <!--COUPONS-->
                <?php if(isset($_GET['coupons'])){
                    ControllerDashboard\ControllerDashboard::couponsDuration();
                    
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::createCoupons($shop['id'], $_POST['code'], $_POST['discount'], $_POST['duration']);
                    }    
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Settings Shop</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label>Code</label></div>
                                <input class="nill" type="text" name="code" />
                            </div>

                            <div class="two-inputs">
                                <div><label>Discount (%)</label></div>
                                <input class="nill" type="number" name="discount" placeholder="10%" />
                            </div>

                            <div class="two-inputs">
                                <div><label>Duration</label></div>
                                <input class="nill" type="date" name="duration" />
                            </div>

                            <input type="submit" name="action" value="Create" />
                        </form>
                        <div class="separator"></div>
                        <table class="columns-four">
                            <thead>
                                <tr>
                                    <td>Code</td>
                                    <td>Discount</td>
                                    <td>Duration</td>
                                    <td>Created</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($shop_coupons as $key => $value){
                                ?>
                                <tr>
                                    <td><?php echo $value['code']; ?></td>
                                    <td><?php echo $value['discount']; ?></td>
                                    <td><?php echo $value['duration']; ?></td>
                                    <td><?php echo $value['created']; ?></td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
                <?php } ?>


                <!--SECURITY-->
                <?php if(isset($_GET['security'])){
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::updatePass($_POST['password'], $_POST['password_verify']);
                    }    
                ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Security Pass</h5></div>
                    <div class="container-body">
                        <form method="post">
                            <div class="two-inputs">
                                <div><label>Old Password</label></div>
                                <input class="nill" type="password" name="password_verify" placeholder="*******" />
                            </div>

                            <div class="two-inputs">
                                <div><label>New Password</label></div>
                                <input class="nill" type="password" name="password" placeholder="*******" />
                            </div>

                            <input type="submit" name="action" value="Update" />

                        </form>
                    </div>
                </div>
                <?php } ?>

                <div class="separator"></div>
                <?php if(isset($_GET['close-shop'])){
                    if(isset($_POST['action'])){
                        ControllerDashboard\ControllerDashboard::deleteShop($shop['id']);
                        Model\Model::alert('Your store '.$shop["name"].' has been deleted.');
                    } 
                ?>
                    <div class="container">
                        <div class="card-head"><h5>Payments</h5></div>
                            <div class="container-body">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. <br />
                                It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
                                <form method="post" class="center">
                                    <input class="delete" type="submit" name="action" value="DELETE" />
                                </form>
                        </div>
                    </div>
                <?php } ?>

                
                <!--PAYMENTS-->
                <?php if(isset($_GET['payments'])){ ?>
                <div class="separator"></div>

                <div class="container">
                    <div class="card-head"><h5>Payments</h5></div>
                    <div class="container-body">
                    <table class="columns-six">
                        <thead>
                            <tr>
                                <td>Email</td>
                                <td>Amount</td>
                                <td>Status</td>
                                <td>Card</td>
                                <td>Products</td>
                                <td>Extract</td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $listPayment = new ControllerPayment\returnPayments;
                                $listPayment->listPayments($card['token']);
                            ?>
                        </tbody>
                    </table>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
