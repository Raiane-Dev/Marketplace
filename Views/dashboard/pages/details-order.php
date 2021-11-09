<?php
    $info_payment = Model\Model::getOne('info_payment',"WHERE `vendor_id` = '$_SESSION[user_id]'");
    if(isset($_GET['ref_id'])){
        $return_order = ControllerPayment\returnPayments::getOrders($_GET['ref_id'], $info_payment['token']);
        $count_products = explode(',',$return_order->description);
        $database_order = Model\Model::getOne('orders',"WHERE ref_id = '$_GET[ref_id]'");
    }
?>
<section class="home">
    <div class="card-head">
        <h6>Order Details: </h6>
    </div>

    <div class="separator"></div>

    <div class="columns-two-bedroom">
        <div class="container">
            <div class="card-head">
                <h5>Customer </h5>
            </div>
            <div class="container-body">

                    <div class="two-bedroom">
                        <div><img class="square" src="<?php echo INCLUDE_PATH ?>assets/amanda-doe.jpg"></div>
                        <div><h6><?php echo $return_order->receipt_email; ?></h6>
                    </div>
                </div>
                <div class="divider"></div>
                <span class="circle"><i data-feather="shopping-bag"></i></span><span class="sub"><?php echo count($count_products); ?>  Orders</span>

                <div class="divider"></div>
                <div class="separator"></div>

                <div class="order-details">
                    <h5>Contact Info</h5>
                    <ul>
                        <li><i data-feather="at-sign"></i> <?php echo $return_order->receipt_email; ?> </li>
                        <li><i data-feather="bar-chart"></i> <?php echo $return_order->status; ?> </li>
                    </ul>
                </div>

                <div class="divider"></div>
                <div class="separator"></div>

                <div class="order-details">
                    <h5>Details</h5>
                    <ul>
                        <li><i data-feather="map-pin"></i> <?php echo $database_order['city']; ?> </li>
                        <li><i data-feather="info"></i> <?php echo $database_order['address']; ?> </li>
                    </ul>
                </div>

                <div class="divider"></div>
                <div class="separator"></div>

                <div class="order-details">
                    <h5>Contact Info</h5>
                    <ul>
                        <li><i data-feather="percent"></i> <?php echo $return_order->application_fee_amount; ?> </li>
                        <li><i data-feather="credit-card"></i> <?php echo $return_order->payment_method_types[0]; ?></li>
                    </ul>
                </div>

            </div>
        </div>


        <div class="container">
        <div class="card-head">
            <h5>Import data into Front Dashboard</h5>
        </div>
            <table class="columns-five-bredroom">
                <thead>
                    <tr>
                        <td>Full Name</td>
                        <td>Status</td>
                        <td>Type</td>
                        <td>Email</td>
                        <td>Signed</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach($count_products as $key => $value){
                        $product = \MySql::connect()->prepare("SELECT * FROM `products` WHERE `id` = $value");
                        $product->execute();
                        $product = $product->fetch();
                    ?>
                    <tr>
                        <td><img class="square" src="<?php echo INCLUDE_PATH ?>assets/<?php echo $product['images']; ?>"/></td>
                        <td><div class="status active"></div> <?php echo $product['stock']; ?></td>
                        <td><?php echo $product['price']; ?></td>
                        <td><?php echo $product['name']; ?></td>
                        <td>1 year ago</td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="card-head flex">
                <div><h4>Total Amount:</h4></div> <div><h4>$<?php echo $return_order->amount; ?></h4></div>
            </div>
        </div>
    </div>
</section>