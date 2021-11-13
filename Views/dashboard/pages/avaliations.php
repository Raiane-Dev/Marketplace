<?php
    $ratings = ControllerDashboard\ControllerDashboard::countTotal();
    $shop = Model\Model::getOne('shop',"WHERE `vendor_id` = '$_SESSION[user_id]'");
?>

<section class="avaliations">
    <div class="card-head flex">
        <h6>Avaliations</h6>
    </div>

    <div class="total-rating">
        <div class="columns-two">
            <div class="columns-two-bedroom">
                <div><img src="<?php echo INCLUDE_PATH ?>assets/icon-four.svg" /></div>
                <div><h2><?php echo $ratings; ?></h2> <p class="info">— of 7 reviews</p></div>
            </div>

            <div>
                <div class="layout">
                    <span class="info"><?php echo count(ControllerDashboard\ControllerDashboard::countRatings(5)); ?> Stars</span> <div class="bar"><div style="width: <?php echo count(ControllerDashboard\ControllerDashboard::countRatings(5)); ?>%;" class="progress"></div></div>
                </div>
 
                <div class="layout">
                    <span class="info"><?php echo count(ControllerDashboard\ControllerDashboard::countRatings(4)); ?> Stars</span> <div class="bar"><div style="width: <?php echo count(ControllerDashboard\ControllerDashboard::countRatings(4)); ?>%;" class="progress"></div></div>
                </div>

                <div class="layout">
                    <span class="info"><?php echo count(ControllerDashboard\ControllerDashboard::countRatings(3)); ?> Stars</span> <div class="bar"><div style="width: <?php echo count(ControllerDashboard\ControllerDashboard::countRatings(3)); ?>%;" class="progress"></div></div>
                </div>

                <div class="layout">
                    <span class="info"><?php echo count(ControllerDashboard\ControllerDashboard::countRatings(2)); ?> Stars</span> <div class="bar"><div style="width: <?php echo count(ControllerDashboard\ControllerDashboard::countRatings(2)); ?>%;" class="progress"></div></div>
                </div>

                <div class="layout">
                    <span class="info"><?php echo count(ControllerDashboard\ControllerDashboard::countRatings(1)); ?> Star</span> <div class="bar"><div style="width: <?php echo count(ControllerDashboard\ControllerDashboard::countRatings(1)); ?>%;" class="progress"></div></div>
                </div>

            </div>
        </div>
    </div>

    <div class="column-one">
        <div class="container">
            <div class="card-head">
                <div class="card-search"><i data-feather="search"></i> <input type="search" placeholder="Search in front" /></div>
            </div>
            <table class="columns-six">
                <thead>
                    <tr>
                        <td>Full Name</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Email</td>
                        <td>Signed</td>
                        <td>User ID</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $avaliations = Model\Model::getWhere('ratings',"WHERE `shop_id` = '$shop[id]'");
                        foreach($avaliations as $key => $value){
                            $user = Model\Model::getOne('users',"WHERE `id` = '$value[user_id]'");
                    ?>
                    <tr>
                        <td class="two">
                            <div><img class="square" src="<?php echo INCLUDE_PATH ?>assets/<?php echo $user['image']; ?>"/></div>
                            <div><h4><?php echo $user['name'] ?></h4></div>
                        </td>
                        <td><div class="status active"></div> Success</td>
                        <td>Unassigned</td>
                        <td><?php echo $user['email'] ?></td>
                        <td><?php echo $value['stars']; ?></td>
                        <td><?php echo $value['product_id'] ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</section>