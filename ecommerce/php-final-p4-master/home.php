<?php include_once "header.php" ?>

<!-- Banner End -->
<!-- New Products Start -->
<div class="shop-page-area ptb-100">
    <div class="container">
        <div class="row flex-row-reverse">
            <div class="col-lg-9">
                <h3 class="text-center  "><b> new products </b></h3>
                <br>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php
                            include_once "php/product.php";
                            $productObj = new product;
                            $productData = $productObj->getnewdata();
                            if ($productData) {
                                $products = $productData->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $key => $value) {
                            ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.php?pro=<?php echo $value['id'] ?>">
                                                    <img alt="" src="assets/img/product/<?php echo $value['photo'] ?>">
                                                </a>
                                                <span>-30%</span>
                                                <div class="product-action">
                                                    <a class="action-wishlist" href="#" title="Wishlist">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                    <a class="action-cart" href="#" title="Add To Cart">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                    <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content text-left">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="product-details.php?pro=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                        </h4>
                                                    </div>
                                                    <div class="cart-hover">
                                                        <h4><a href="product-details.php?pro=<?php echo $value['id'] ?>">+ Add to cart</a></h4>
                                                    </div>
                                                </div>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                            </div>
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.php?pro=<?php echo  $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                </h4>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                                <p><?php echo $value[''] ?></p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                    <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            } else {
                                echo "<div class='alert alert-warning'>There is no product yet</div>div";
                            }
                            ?>

                        </div>
                    </div>



                    <!-- New Products End -->
                    <!-- Testimonial Area Start -->






                    <!-- most rated products End -->

                    <!-- <div class="testimonials-area bg-img pt-100 pb-100">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="testimonial-active owl-carousel">
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="assets/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt
                                ut labore1111111</p>
                            <h4>Gregory Perkins</h4>
                            <h5>Customer</h5>
                        </div>
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="assets/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt
                                ut labore</p>
                            <h4>Khabuli Teop</h4>
                            <h5>Marketing</h5>
                        </div>
                        <div class="single-testimonial text-center">
                            <div class="testimonial-img">
                                <img alt="" src="assets/img/icon-img/testi.png">
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisici elit, sed do eiusmod tempor incididunt
                                ut labore </p>
                            <h4>Lotan Jopon</h4>
                            <h5>Admin</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->



    <h3 class="text-center  "><b> Most Rated Data </b></h3>
                <br>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php
                            include_once "php/product.php";
                            $productObj = new product;
                            $productData = $productObj->getMostRatedData();
                            if ($productData) {
                                $products = $productData->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $key => $value) {
                            ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.php?pro=<?php echo $value['id'] ?>">
                                                    <img alt="" src="assets/img/product/<?php echo $value['photo'] ?>">
                                                </a>
                                                <span>-30%</span>
                                                <div class="product-action">
                                                    <a class="action-wishlist" href="#" title="Wishlist">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                    <a class="action-cart" href="#" title="Add To Cart">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                    <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content text-left">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="product-details.php?pro=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                        </h4>
                                                    </div>
                                                    <div class="cart-hover">
                                                        <h4><a href="product-details.php?pro=<?php echo $value['id'] ?>">+ Add to cart</a></h4>
                                                    </div>
                                                </div>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                            </div>
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.php?pro=<?php echo  $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                </h4>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                                <p><?php echo $value[''] ?></p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                    <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            } else {
                                echo "<div class='alert alert-warning'>There is no product yet</div>div";
                            }
                            ?>

                        </div>
                    </div>



                    <h3 class="text-center  "><b> Most orders products </b></h3>
                <br>
                <div class="grid-list-product-wrapper">
                    <div class="product-grid product-view pb-20">
                        <div class="row">
                            <?php
                            include_once "php/product.php";
                            $productObj = new product;
                            $productData = $productObj->getMostorderddData();
                            if ($productData) {
                                $products = $productData->fetch_all(MYSQLI_ASSOC);
                                foreach ($products as $key => $value) {
                                   
                            ?>
                                    <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                        <div class="product-wrapper">
                                            <div class="product-img">
                                                <a href="product-details.php?pro=<?php echo $value['id'] ?>">
                                                    <img alt="" src="assets/img/product/<?php echo $value['photo'] ?>">
                                                </a>
                                                <span>-30%</span>
                                                <div class="product-action">
                                                    <a class="action-wishlist" href="#" title="Wishlist">
                                                        <i class="ion-android-favorite-outline"></i>
                                                    </a>
                                                    <a class="action-cart" href="#" title="Add To Cart">
                                                        <i class="ion-ios-shuffle-strong"></i>
                                                    </a>
                                                    <a class="action-compare" href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-content text-left">
                                                <div class="product-hover-style">
                                                    <div class="product-title">
                                                        <h4>
                                                            <a href="product-details.php?pro=<?php echo $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                        </h4>
                                                    </div>
                                                    <div class="cart-hover">
                                                        <h4><a href="product-details.php?pro=<?php echo $value['id'] ?>">+ Add to cart</a></h4>
                                                    </div>
                                                </div>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                            </div>
                                            <div class="product-list-details">
                                                <h4>
                                                    <a href="product-details.php?pro=<?php echo  $value['id'] ?>"><?php echo $value['name'] ?></a>
                                                </h4>
                                                <div>

                                                    <span class="product-price-old"><?php echo $value['price'] ?> </span>
                                                </div>
                                                <p><?php echo $value[''] ?></p>
                                                <div class="shop-list-cart-wishlist">
                                                    <a href="#" title="Wishlist"><i class="ion-android-favorite-outline"></i></a>
                                                    <a href="#" title="Add To Cart"><i class="ion-ios-shuffle-strong"></i></a>
                                                    <a href="#" data-target="#exampleModal" data-toggle="modal" title="Quick View">
                                                        <i class="ion-ios-search-strong"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                            <?php
                                }
                            } else {
                                echo "<div class='alert alert-warning'>There is no product yet</div>div";
                            }
                            ?>

                        </div>
                    </div>




                    <!-- Testimonial Area End -->
                    <!-- News Area Start -->

                    <!-- News Area End -->
                    <!-- Newsletter Araea Start -->
                    <div class="newsletter-area bg-image-2 pt-90 pb-100">
                        <div class="container">
                            <div class="product-top-bar section-border mb-45">
                                <div class="section-title-wrap text-center">
                                    <h3 class="section-title">Join to our Newsletter</h3>
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row justify-content-md-center">
                                <div class="col-lg-6 col-md-10 col-md-auto">
                                    <div class="footer-newsletter">
                                        <div id="mc_embed_signup" class="subscribe-form">
                                            <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                                                <div id="mc_embed_signup_scroll" class="mc-form">
                                                    <input type="email" value="" name="EMAIL" class="email" placeholder="Your Email Address*" required>
                                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                    <div class="mc-news" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                                    <div class="submit-button">
                                                        <input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button">
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Newsletter Araea End -->
                    <?php include_once "footer.php" ?>