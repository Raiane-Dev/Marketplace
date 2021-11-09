<?php
    $shop = Model\Model::getOne('shop',"WHERE vendor_id = '$_SESSION[user_id]'");
    $user = Model\Model::getOne('users',"WHERE id = '$_SESSION[user_id]'");

    if(isset($_POST['action'])){
        ControllerDashboard\ControllerDashboard::createProduct($_POST['shop_id'], $_POST['category_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_FILES['images']['name'], $_POST['stock'], $_POST['colors'], $_POST['weight'], $_POST['width'], $_POST['height'], $_POST['length']);

    }
?>
<section class="form">
    <div class="form">
        <div class="container">
            <div class="card-head">
                <h5>Create Users</h5>
            </div>
            <div class="container-body">
                <form method="post" enctype="multipart/form-data">

                    <div class="two-inputs">
                        <div><label> Name </label></div>
                        <div><input type="text" name="name" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Description </label></div>
                        <div><textarea name="description"></textarea></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Price </label></div>
                        <div><input type="number" name="price" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Categoria </label></div>
                        <div>
                            <select name="category_id">
                                <?php
                                    $get = Model\Model::get('categories');
                                    foreach($get as $key => $value){ ?>
                                        <option value="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Imagem </label></div>
                        <div><input type="file" name="images" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Stock </label></div>
                        <div><input type="number" name="stock" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Colors </label></div>
                        <div><input type="text" name="colors" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Weight </label></div>
                        <div><input type="text" name="weight" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Width </label></div>
                        <div><input type="text" name="width" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Height </label></div>
                        <div><input type="text" name="height" /></div>
                    </div>

                    <div class="two-inputs">
                        <div><label> Length </label></div>
                        <div><input type="text" name="length" /></div>
                    </div>

                    <input type="hidden" name="shop_id" value="<?php echo $shop['id']; ?>" />


                    <input type="submit" name="action" value="Invite" />


                </form>
            </div>
        </div>
    </div>
</section>