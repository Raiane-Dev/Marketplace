<?php
    $query = '';
    $user = Model\Model::getOne('users',"WHERE `id` = '$_SESSION[user_id]'");
    $shop = Model\Model::getOne('shop',"WHERE `vendor_id` = '$user[id]'");
    if(isset($_POST['search'])){
        $search = $_POST['search'];
        $query = "AND `name` LIKE '%$search%' OR `description` LIKE '%$search%'";
    }
    $products = Model\Model::getWhere('products',"WHERE `shop_id` = '$shop[id]' $query");
?>
<section class="products">
    <div class="card-head flex">
        <h6>Products</h6>
        <button><a href="<?php echo INCLUDE_PATH_DASHBOARD_URL ?>add-product">Add Product</a></button>
    </div>

    <div class="column-one">
        <div class="container">
            <div class="card-head">
                <form method="post"><div class="card-search"><input type="submit" name="for" id="for" style="display:none;" /><label for="for"><i data-feather="search"></i></label> <input type="search" name="search" placeholder="Search in front" /></div></form>
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
                        foreach($products as $key => $value){
                            $category = Model\Model::getOne('categories',"WHERE `id` = '$value[category_id]'");
                    ?>
                    <tr>
                        <td class="two">
                            <div><img class="square" src="<?php echo INCLUDE_PATH ?>assets/<?php echo $value['images']; ?>"/></div>
                            <div><h4><?php echo $value['name']; ?></h4></div>
                        </td>
                        <td><div class="status active"></div> <?php echo $value['price'] ?></td>
                        <td><?php echo $value['colors']; ?></td>
                        <td><?php echo $value['weight'] ?></td>
                        <td><?php echo @$category['name']; ?></td>
                        <td><?php echo $value['stock']; ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

</section>