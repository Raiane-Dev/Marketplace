<div class="separator"></div>
<section class="head-shop">
    <div class="head-shop">
        <p>Home > Shop</p>
    </div>
</section>

<section class="shop">
    <div class="list-column-four">
        <?php
            $products = Model\Model::get('products');
            foreach($products as $key => $value){
        ?>
        <div class="product-single">
            <div class="image-hover">
                <img src="assets/<?php echo $value['images'] ?>" />
                <div class="display">
                    <a href="?addCart?id=<?php echo $value['id']; ?>" class="after">Add To Cart</a>
                    <div>
                        <a href="product-single?id=<?php echo $value['id']; ?>"><i data-feather="eye"></i></a>
                        <a href=""><i data-feather="heart"></i></a>
                    </div>
                </div>
            </div>
            <div class="info-product">
                <div><h4><?php echo $value['name']; ?></h4></div>
                <div><h5>$ <?php echo $value['price']; ?></h5></div>
            </div>
        </div>
        <?php } ?>

    </div>
</section>