<?php
    if(isset($_GET['addCart'])){
        echo Model\Model::addCart();
    }

    $items_select = array_unique(array_column(Model\Model::getWhere('cart',"WHERE `user_id` = '$_SESSION[user_id]'"), 'vendor_id'));
    Controller\Controller::optimizationCart();

    if(isset($_POST['apply-coupon'])){
        Controller\Controller::applyCoupon($_POST['coupon'], $_POST['shop_id']);
    }

?>
<div class="separator"></div>
<section class="head-shop">
    <div class="head-shop">
        <p>Home > Shop</p>
    </div>
</section>

<section class="cart">
    <div class="list-cart">
        <?php 
        foreach($items_select as $key => $shop_value){
            $shop = Model\Model::getOne('shop',"WHERE `id` = '$shop_value'");
            $items_shop = Model\Model::getWhere('cart',"WHERE `user_id` = '$_SESSION[user_id]' AND `vendor_id` = '$shop[vendor_id]'");
        ?>
        <table>
            <thead>
                <tr>
                    <td class=""><?php echo $shop['name']; ?></td>
                    <td>Price</td>
                    <td>Quantity</td>
                    <td>Subtotal</td>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($items_shop as $key => $cart_value){
                    $itemsProduct = Model\Model::getOne('products',"WHERE id = $cart_value[product_id]");
                ?>
                <tr>
                    <td class="columns">
                        <div><img src="assets/<?php echo $itemsProduct['images']; ?>" /></div>
                        <div><h4><?php echo $itemsProduct['name']; ?></h4></div>
                    </td>
                    <td>$<?php echo $itemsProduct['price'] ?></td>
                    <td><input type="number" value="<?php echo $cart_value['quantity'] ?>" /></td>
                    <td>$<?php echo $itemsProduct['price'] * $cart_value['quantity']; ?></td>
                </tr>

                <?php } ?>

                <tr>
                    <td><form method="post"><input type="text" name="coupon" placeholder="Coupon Code" /><input type="hidden" name="shop_id" value="<?php echo $shop_value ?>" /></td>
                    <td><input type="submit" name="apply-coupon" value="Apply Coupon" /></form></td>
                    <td></td>
                    <td><a class="button-link" href="<?php echo INCLUDE_PATH ?>checkout?id=<?php echo $shop_value; ?>">Buy</a></td>
                </tr>
            </tbody>
        </table>
        <?php } ?>
    </div>
</section>