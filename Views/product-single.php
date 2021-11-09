<?php
    $id = $_GET['id'];
    $product_single = Model\Model::getOne('products',"WHERE `id` = $id");
    $shop_single = Model\Model::getOne('shop',"WHERE `id` = '$product_single[shop_id]'");
    $vendor_single = Model\Model::getOne('users',"WHERE `id` = '$shop_single[vendor_id]'");

    $product_images = explode(', ',$product_single['images']);
    $product_options = explode(', ', $product_single['colors']);
    $categorie = Model\Model::getOne('categories',"WHERE id = $id");

    if(isset($_POST['buy'])){
        $calculaFrete = Controller\Controller::calculateFrete(41106, $vendor_single['cep'], $_SESSION['cep'], $product_single['weight'], $product_single['height'], $product_single['width'], $product_single['length'], 0);
        Controller\Controller::addCart($product_single['id'],$_SESSION['user_id'],$vendor_single['id'],$_POST['quantity'], str_replace(',','.',$calculaFrete), date('Y-m-d'));
    }

    if(isset($_POST['comment'])){
        Controller\Controller::feedback($product_single['id'], $_POST['stars'], $_POST['feedback']);
    }
?>
<div class="separator"></div>
<section class="head-shop">
    <div class="head-shop">
        <p>Home > Shop</p>
    </div>
</section>

<section class="product">
    <div class="product">
        <div class="product-image">
            <div>
                <?php
                    foreach($product_images as $key => $value){
                        echo '<img src="assets/'.$value.'" />';
                    }
                ?>
            </div>
            <div>
                <?php
                    echo '<img src="assets/'.$product_images[0].'" />';
                ?>
            </div>
        </div>
        <div class="product-info">
            <h2 class="title"><?php echo $product_single['name']; ?></h2>
            <h5 class="sub">$<?php echo $product_single['price']; ?></h5>
            <?php
                $rating = Model\Model::countRating();
                for($i = 0; $i < $rating; $i++){
                    echo '<span><i data-feather="star"></i></span>';
                }
            ?>
            <h6 class="description"><?php echo $product_single['description']; ?></h6>

            <form method="post">
            <div><label>Color</label>
            <?php
                foreach(explode(', ', $product_single['colors']) as $key => $value){
            ?>

            <input type="checkbox" name="color" id="<?php echo $value; ?>" value="<?php echo $value; ?>" />
            <label for="<?php echo $value; ?>" style="background-color: <?php echo $value; ?>;" class="select-color"></label>
            
            <?php } ?>
            </div>
            <input type="number" name="quantity" value="1" />
            <input type="submit" name="buy" value="Buy" />
            </form>

            <form method="post">
                <?php
                    if(!isset($_SESSION['cep']) ? $cep = '' : $cep = $_SESSION['cep']);
                ?>
                <input type="number" name="cep" placeholder="Zip Code" value="<?php echo $cep; ?>" />
                <input type="hidden" name="vendor_single_cep" value="<?php echo $vendor_single['cep'] ?>" />
                <input type="hidden" name="weight" value="<?php echo $product_single['weight'] ?>" />
                <input type="hidden" name="height" value="<?php echo $product_single['height'] ?>" />
                <input type="hidden" name="width" value="<?php echo $product_single['width'] ?>" />
                <input type="hidden" name="length" value="<?php echo $product_single['length'] ?>" />
                <input type="submit" onclick="return calculated()" value="Calculated" />
                <div id="result"></div>
            </form>
            <p class="aditional-info">Stock: <span><?php echo $product_single['stock'] ?></span> </p>
            <p class="aditional-info">Category <span><?php echo $categorie['name'] ?></span> </p>
            <p class="aditional-info">Length <span><?php echo $product_single['length']; ?></span> </p>
            <p class="aditional-info">Tags <span></span> </p>
        </div>
    </div>

    <div class="product-description">
        <div class="tab-head">
            <ul>
                <li class="active">Description</li>
                <li>Aditional Information</li>
                <li id="review">Reviews</li>
            </ul>
        </div>
        <div class="tab-body">
            <div class="description-text">
                <p class="description"><?php echo $product_single['description']; ?></p>
            </div>
            <div class="information-text">
                <p class="aditional-info">Weight: <span>046</span> </p>
                <p class="aditional-info">Width <span></span> </p>
                <p class="aditional-info">Height <span></span> </p>
                <p class="aditional-info">Length <span></span> </p>
            </div>
            <div class="reviews-text">
                <h6>1 REVIEW FOR ORIGAMI LAMPS</h6>
                <div class="reviews">
                    <div class="review-single">
                        <div><img src="https://tobel.qodeinteractive.com/wp-content/uploads/2021/04/Comment-img-2.jpg" /></div>
                        <div>
                            <p><i data-feather="star"></i></p>
                            <span>April 15, 2021</span>
                            <h5>Name</h5>
                            <p>Aenean commodo ligula eget dolor.</p>
                        </div>
                    </div>

                    <div class="add-review">
            

                        <form method="post">
                            <select name="stars">
                                <option value="5">Very good!</option>
                                <option value="4">I thought it was great.</option>
                                <option value="3">Good</option>
                                <option value="2">Did not like</option>
                                <option value="1">Horrible!</option>
                            </select>
                            <textarea name="feedback" placeholder="Your Review..."></textarea>
                            <input type="submit" name="comment" value="Comment" />
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="related">
        <h2>Related Products</h2>
        <div class="list-column-four">
            <?php
                $products = Model\Model::getWhere('products', 'LIMIT 4');
                foreach($products as $key => $value){
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
                    <div><h4><?php echo $value['name']; ?></h4></div>
                    <div><h5>$ <?php echo $value['price']; ?></h5></div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>