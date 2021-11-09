<?php
    $shop = Model\Model::getOne('shop',"WHERE `slug` = '$_GET[name]'");
    $products = Model\Model::getWhere('products',"WHERE `shop_id` = '$shop[id]'");
    $products_banner = Model\Model::getWhere('products',"WHERE `shop_id` = '$shop[id]' LIMIT 3");
    $products_list = Model\Model::getWhere('products', "WHERE `shop_id` = '$shop[id]' LIMIT 5");
?>
<div class="separator"></div>
<section class="shop-single">
    <div class="shop-single">
        <div class="banner">
            <div class="banner-area">
                <div>
                    <h2 class="title">Welcome to <?php echo $shop['name']; ?></h2>
                    <p><?php echo $shop['description']; ?></p>
                    <a href="#products" class="after">Read More</a>
                    <div class="list-flex">
                        <?php
                            foreach($products_banner as $key => $value){
                        ?>
                        <img src="<?php echo INCLUDE_PATH ?>assets/<?php echo $value['images'] ?>" />
                        <?php } ?>
                    </div>
                </div>
                <div>
                    <img src="<?php echo INCLUDE_PATH ?>assets/<?php echo $shop['image']; ?>" />
                </div>
            </div>
        </div>

        <div class="description-shop-single">
            <div>
                <h4>Ready for Quapa New Collection?</h4>
                <p>Starting from $125 only</p>
                <span>Designed by Quapa</span>

                <h3><?php echo $shop['name']; ?></h3>
            </div>
            <div>
                <h6>New design 2019</h6>
                <p><?php echo $shop['description']; ?></p>
            </div>
            <div>
                <img src="https://demo2wpopal.b-cdn.net/quapa/wp-content/uploads/2019/11/banner1-h2.jpg" />
            </div>
        </div>

        <div class="products-shop-single">
            <span>Our Products</span>
            <h4>Sustainable, Accessible<br /> and Compatible</h4>
            <div class="list-column-five">
                <?php
                    foreach($products_list as $key => $value){
                ?>
                <div class="product-single">
                    <div class="image-hover">
                        <img src="assets/<?php echo $value['images'] ?>" />
                        <div class="display">
                            <a href="addCart?id=<?php echo $value['id']; ?>" class="after">Add To Cart</a>
                            <div>
                                <a href="product-single?id=<?php echo $value['id']; ?>"><i data-feather="eye"></i></a>
                                <a href=""><i data-feather="heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="info-product">
                        <div><h5><?php echo $value['name']; ?></h5></div>
                        <div><h5>$ <?php echo $value['price']; ?></h5></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="images-shop-single">
            <?php 
                $showroom = Model\Model::getWhere('showroom',"WHERE `shop_id` = '$shop[id]'");
                foreach($showroom as $key => $value){
            ?>
            <img src="<?php echo INCLUDE_PATH ?>assets/<?php echo $value['image']; ?>" />
            <?php } ?>
        </div>

        <div class="products-shop-single">
            <span>Our Products</span>
            <h4>Nordika Collection</h4>
            <div class="list-column-five">
                <?php
                    foreach($products_list as $key => $value){
                ?>
                <div class="product-single">
                    <div class="image-hover">
                        <img src="assets/<?php echo $value['images'] ?>" />
                        <div class="display">
                            <a href="addCart?id=<?php echo $value['id']; ?>" class="after">Add To Cart</a>
                            <div>
                                <a href="product-single?id=<?php echo $value['id']; ?>"><i data-feather="eye"></i></a>
                                <a href=""><i data-feather="heart"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="info-product">
                        <div><h5><?php echo $value['name']; ?></h5></div>
                        <div><h5>$ <?php echo $value['price']; ?></h5></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>

        <div class="contact-shop-single">
            <div>
                <img src="https://demo2wpopal.b-cdn.net/quapa/wp-content/uploads/2019/11/banner6-h2.jpg" />
            </div>
            <div>
                <h2>Dining Room Furniture Collection</h2>
                <p>We’ve gone to great lengths to bring you some fabulous furniture ranges to create your perfect bedroom.</p>
                <a class="after">Shop now</a>
            </div>
        </div>

        <div class="form-inscription">
            <h2 class="title">Subscribe to our Newsletter</h2>
            <p>Subscribe to the free newsletter and receive notification of new products and promotions!</p>

            <form method="post">
                <input type="text" placeholder="Enter two Email..." />
            </form>
        </div>
    </div>
</section>