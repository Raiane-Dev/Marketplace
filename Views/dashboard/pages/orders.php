<?php
    $shop = Model\Model::getOne('shop',"WHERE vendor_id = '$_SESSION[user_id]'");
    $user = Model\Model::getOne('users',"WHERE id = '$_SESSION[user_id]'");
    $shop_policies = Model\Model::getOne('shop_policies',"WHERE shop_id = $shop[id]");
    $card = Model\Model::getOne('info_payment',"WHERE `vendor_id` = '$_SESSION[user_id]'");
    $shop_schedules = Model\Model::getOne('shop_schedules',"WHERE shop_id = $shop[id]");
    $shop_coupons = Model\Model::getWhere('coupons',"WHERE shop_id = $shop[id]");
?>

<section class="payments">
    <div class="card-head">
        <h6>Dashboard</h6>
    </div>

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
</section>