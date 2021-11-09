<?php
    $cart = Model\Model::getWhere('cart',"WHERE `user_id` = '$_SESSION[user_id]' AND `vendor_id` = '$_GET[id]'");

    $amount_total = 0;
    $shipping = 0;
    foreach($cart as $key => $value){
        $products = Model\Model::getOne('products', "WHERE id = $value[product_id]");
        $shop = Model\Model::getOne('shop',"WHERE `id` = '$products[shop_id]'");
        $vendor_single = Model\Model::getOne('users',"WHERE `id` = '$shop[vendor_id]'");
        $amount_total += $products['price'] * $value['quantity'];
        $shipping += $value['amount_frete'];
    }

        $cart_list = (array_column($cart, 'product_id'));
        if(isset($_SESSION['coupon']) && $_SESSION['coupon_shop'] == $shop['id']){
            $discount = ($amount_total / 100) * $_SESSION['coupon_value'];
            $subtotal = ($amount_total + $shipping) - $discount;
        }else{
            $subtotal = $amount_total + $shipping;
        }
        if(isset($_POST['pay'])){
            $exists = \MySql::connect()->prepare("SELECT * FROM `method_payment` WHERE `user_id` = '$_SESSION[user_id]'");
            $exists->execute();
            $info_exists = $exists->fetch();
            if($exists->rowCount() == 1){
                $pay = new ControllerPayment\Pay;
                $pay->payCharges($_POST['amount'],$_POST['vendor_id'],$_POST['email'],$_POST['products_id'],$info_exists['ref_id']);
            }else{
                $pay = new ControllerPayment\Pay;
                $pay->paymentMethods($_POST['card_number'], $_POST['card_exp_month'], $_POST['card_exp_year'], $_POST['card_cvc']);
            }

    }
?>
<div class="separator"></div>
<section class="head-shop">
    <div class="head-shop">
        <p>Home > Shop</p>
    </div>
</section>
    <section class="checkout">
        <div class="checkout">
        <div class="buy">
            <h2 class="title">BILLING DETAILS</h2>
            <form method="post">
                <label class="label">Name</label>
                <input type="text" name="name" />

                <label class="label">Email</label>
                <input type="text" name="email" />

                <label class="label">Phone</label>
                <input type="text" name="phone" />

                <label class="label">City</label>
                <input type="text" name="city" />

                <label class="label">Address</label>
                <input type="text" name="address_one" />

                <label class="label">Number Home</label>
                <input type="text" name="number_home" />

                <label class="label">Postal Code</label>
                <input type="text" name="postal_code" />

                <label class="label">State</label>
                <input type="text" name="state" />

                <label class="label">Card Number</label>
                <input type="text" name="card_number" />


                <div class="list-column-three">
                    <div>
                    <label class="label">Exp Month</label>
                    <input min="1" max="12" type="number" name="card_exp_month" />
                    </div>
                    
                    <div>
                    <label class="label">Exp Year</label>
                    <input type="number" name="card_exp_year" />
                    </div>

                    <div>
                    <label class="label">CVC</label>
                    <input type="number" name="card_cvc" />
                    </div>
                </div>


                <input type="hidden" name="amount" value="<?php echo str_replace('.','',$subtotal); ?>" />
                <input type="hidden" name="vendor_id" value="<?php echo $vendor_single['id']; ?>" />
                <input type="hidden" name="products_id" value="<?php echo implode(', ',$cart_list); ?>" />


                <input type="submit" name="pay" value="Place Order" />
            </form>

        </div>

        <div class="buy">
            <h2 class="title">Your Order</h2>
            <table class="columns-two">
                <thead>
                    <tr>
                        <td>Product</td>
                        <td>Price</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $amount = 0;
                            foreach($cart as $key => $value){
                            $itemsProduct = Model\Model::getOne('products',"WHERE id = $value[product_id]");
                                $amount += $itemsProduct['price'];
                        ?>
                            <td><?php echo $itemsProduct['name']; ?></td>
                            <td>$<?php echo $itemsProduct['price']; ?></td>
                        <?php } ?>
                    </tr>
                    <tr>
                        <td><h4>SubTotal</h4></td>
                        <td><?php echo $subtotal; ?></td>
                   </tr>
                   <tr>
                        <td><h4>Shipping</h4></td>
                        <td><?php echo $shipping; ?></td>
                   </tr>
                </tbody>
            </table>

        </div>

    </div>
</section>