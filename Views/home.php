<section class="banner">
    <div class="banner">
        <div class="images">
            <img src="assets/banner-one.jpg" />
        </div>
        <div class="content">
            <h1>Nevada Collection</h1>
            <a class="button">Discover</a>
            <div class="content-direction">
                <div><i data-feather="arrow-left"></i></div>
                <div><i data-feather="arrow-right"></i></div>
            </div>
        </div>
    </div>
</section>

<section class="about">
    <div class="about">
        <h3>Colors</h3>
        <h2>Shades of elegante</h2>
        <p>Lorem ipsum dolor sit amet, consectetur ad is cing elit, semdo eiusmod tempor est.</p>
        <a href="" class="after">Read More</a>
    </div>
    <div class="images-two">
        <div><img src="assets/furniture-one.jpg" /></div>
        <div><img src="assets/furniture-two.jpg" /></div>
    </div>
</section>

<section class="offer">
    <div class="column-two">
        <div class="offer-single">
            <h3>Sale</h3>
            <a class="filled">Shop now</a>
        </div>
        <div class="offer-single">
            <h3>New</h3>
            <a class="filled">Discover</a>
        </div>
    </div>
</section>

<section class="about">
    <div class="about">
        <h3>Colors</h3>
        <h2>Shades of elegante</h2>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elitse do eiusmod tempor incididunt ut labore et dolore magnta liquia. Utenimadm inim veniam, quis nostrud exercitation ullamco la borisnisi ut aliquipex ea com modo conseqat. Duis aute irure dolorinre prehe nderit voluptate velit esse.</p>
        <a href="" class="brown">Read More</a>
    </div>
    <div class="image">
        <img src="assets/client.jpg" />
    </div>
</section>

<section class="video-play">
    <div class="content">
        <div class="circle">
            <span>Play</span>
        </div>
    </div>
</section>

<section class="products home">
    <h3>New</h3>
    <h2>OUR PRODUCTS ARE CUSTOM MADE</h2>
    <div class="list-column-three">
        <?php
            $products = Model\Model::getWhere('products', 'LIMIT 6');
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
</section>

<section class="marketing">
    <div class="marketing">
        <div>
            <h3>New</h3>
            <h2>MADE WITH LOVE <br /> AND DEDICATION</h2>
            <a href="" class="button">Discover</a>
        </div>
    </div>
</section>

<section class="process">
    <h3>Process</h3>
    <h2>DRIVEN BY OUR OWN <br />ORIGINAL SET OF VALUES</h2>
    <div class="column-two">
        <div class="list">
            <div>
                <span>Brand</span>
                <span class="float">78%</span>
                <div class="progress" style="width:60%;"></div>
            </div>
            <div>
                <span>Brand</span>
                <span class="float">78%</span>
                <div class="progress" style="width:60%;"></div>
            </div>
            <div>
                <span>Brand</span>
                <span class="float">78%</span>
                <div class="progress" style="width:60%;"></div>
            </div>
        </div>
        <div class="list">
            <span>Brand</span>
            <span class="float">78%</span>
            <div class="progress" style="width:60%;"></div>

            <span>Brand</span>
            <span class="float">78%</span>
            <div class="progress" style="width:78%;"></div>

            <span>Brand</span>
            <span class="float">78%</span>
            <div class="progress" style="width:60%;"></div>
        </div>
    </div>
</section>
<script>
    window.addEventListener('load', (e)=>{
        document.querySelector("header").setAttribute('class','header-pattern');
    });
    window.addEventListener('scroll', (e)=>{
        if(window.scrollY > 300){
            document.querySelector("header").setAttribute('class','header-light');
        }else{
            document.querySelector("header").setAttribute('class','header-pattern');
        }
    });

    
</script>