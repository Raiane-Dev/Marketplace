<?php
    $user = Model\Model::getOne('users',"WHERE `id` = '$_SESSION[user_id]'");
    $info_payment = Model\Model::getOne('info_payment',"WHERE `vendor_id` = '$_SESSION[user_id]'");
?>
<section class="profile">
    <div class="head-user">
        <div class="cover"></div>
        <div class="columns-two-bedroom">
            <div>
                <figure><img src="<?php echo INCLUDE_PATH ?>assets/<?php echo $user['image']; ?>" class="user"/></figure>
            </div>
        <div>
            <ul>
                <li><i data-feather="at-sign"></i> <?php echo $user['email']; ?></li>
                <li><i data-feather="map-pin"></i> <?php echo $user['cep']; ?></li>
                <li><i data-feather="send"></i>  <?php echo $user['id']; ?></li>
            </ul>
        </div>
    </div>
    </div>

    <div class="tab">
        <div>
            <ul>
                <li>Profile</li>
                <li>Teams</li>
                <li>Projects</li>
                <li>Connections</li>
            </ul>
        </div>
        <div>
            <button><i data-feather="user-plus"></i> Connect</button>
            <button><i data-feather="list"></i></button>
            <button><i data-feather="award"></i></button>
        </div>
    </div>

    <div class="columns-two-bedroom">
        <div>
            <div class="container">
                <div class="card-head">
                    <h5>Completed Profile</h5>
                </div>
                <div class="container-body">
                    <div class="bar"><div style="width: 50%;" class="progress"></div></div><span class="info">82%</span>
                </div>
            </div>

            <div class="separator"></div>

            <div class="container">
                <div class="card-head">
                    <h5>Completed Profile</h5>
                </div>
                <div class="container-body">
                    <ul class="list-horizontal">
                    <span class="sub">About</span>
                        <li><i data-feather="user"></i> Ela lauda</li>
                        <li><i data-feather="video"></i> No departament</li>
                        <li><i data-feather="user"></i> Ela lauda</li>
                    </ul>
                    
                    <div class="separator"></div>

                    <ul class="list-horizontal">
                    <span class="sub">Contact us</span>
                        <li><i data-feather="at-sign"></i> Ela lauda</li>
                        <li><i data-feather="phone"></i> Ela lauda</li>
                    </ul>

                    <div class="separator"></div>

                    <ul class="list-horizontal">
                    <span class="sub">Teams</span>
                        <li><i data-feather="users"></i> Ela lauda</li>
                        <li><i data-feather="bookmark"></i> Ela lauda</li>
                    </ul>
                </div>
            </div>

        </div>

        <div>
            <div class="container">
                <div class="card-head">
                    <h5>Completed Profile</h5>
                </div>
                <?php
                    $feed = Model\Model::getWhere('ratings',"WHERE `user_id` = '$user[id]'");
                    foreach($feed as $key => $value){
                        $product = Model\Model::getOne('products',"WHERE `id` = '$value[product_id]'");
                ?>
                <div class="container-body">
                    <ul>
                        <li>
                            <div>
                                <h4><?php echo $value['feedback']; ?></h4>
                                <p><?php echo $product['name'] ?>
                                <?php
                                    for($i = 0; $i < $value['stars']; $i++){
                                        echo '<i data-feather="star"></i>';
                                    }
                                ?>
                                </p>
                                <span class="sub">Today</span>
                            </div>
                        </li>
                    </ul>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</section>