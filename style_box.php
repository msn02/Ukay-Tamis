<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cottagecore</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/style_box.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid px-3 pt-1 gradient_pink center-align">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-2">
                <a class="border-0 p-2 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>

            <?php include('server/get_style_page.php'); ?>
            
            <!-- style box details -->
            <?php while ($row = $style->fetch_assoc()) { ?>
                <div class="row shadow rounded-2 m-3 gray_bg">
                    <!-- product image -->
                    <div class="col-sm-5 m-0 p-4">
                        <div class="card overflow-hidden border-0">
                            <img src="resources/<?php echo $row['style_img_url']; ?>" alt="<?php echo $row['style']; ?>">
                        </div>
                    </div>
                    <!-- product details -->
                    <div class="col-sm-7 m-0 py-4 px-3">
                        <!-- tag and title -->
                        <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                            <div class="col-sm-10 m-0 p-0">
                                <h2 class="bold_header align-content-center ps-0 mb-0 pb-0"><?php echo $row['style'] . ' ' . 'Box'; ?></h2>
                            </div>
                            <div class="d-sm-none d-block m-1"></div>
                            <div class="col-sm-2 col-md-2 m-0 p-0 bold_header center-align align-content-center">
                                <p class="rounded-1 tag_pink px-2 py-1 m-0 center_text">STYLE BOX</p>
                            </div>
                        </div>
                        <!-- box price -->
                        <div class="pt-3 px-3 mb-0">
                            <div class="m-0">
                                <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price"><?php echo $row['price']; ?></h4>
                            </div>
                        </div>
                        <!-- style description -->
                        <div class="pt-3 px-3 mb-0">
                            <div class="border-top pt-3 pb-0 m-0">
                                <h6 class="bold_header">Style Description</h6>
                                <p class="box_desc m-0 p-0"><?php echo $row['style_description']; ?></p>
                            </div>
                        </div>
                        <!-- box description -->
                        <div class="pt-3 px-3 pb-5 mb-0">
                            <div class="border-top pt-3 pb-0 m-0">
                                <h6 class="bold_header">What's in the box?</h6>
                                <p class="box_desc m-0 p-0"><?php echo $row['style_box_description']; ?></p>
                            </div>
                        </div>
                        <!-- add to card and buy now button -->
                            <div class="px-3 pt-0 m-0">
                                <form method = "POST" action = "view_cart.php">
                                    <input type = "hidden" name = "product_id" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                    <input type = "hidden" name = "product_img_url" value = "<?php echo $row['style_img_url']; ?>"> </input>
                                    <input type = "hidden" name = "product" value = "<?php echo $row['style']; ?>"> </input>
                                    <input type = "hidden" name = "product_price" value = "<?php echo $row['price']; ?>"> </input>
                                    <input type = "hidden" name = "product_quantity" value = "1"> </input>
                                    <input type = "hidden" name = "product_type" value = "style box"> </input>
                                    <input type = "hidden" name = "style_box" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                    <div class="d-inline add_cart">
                                        <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit" name ="add_to_cart"><i class="bi bi-cart-plus me-1"></i></button>
                                    </div>
                                </form>
                                
                                <form method = "POST" action = "<?php echo "quick_checkout.php?style_box_id=" . $row['style_box_id'] ?>" >
                                    <input type = "hidden" name = "product_id" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                    <input type = "hidden" name = "product_img_url" value = "<?php echo $row['style_img_url']; ?>"> </input>
                                    <input type = "hidden" name = "product" value = "<?php echo $row['style']; ?>"> </input>
                                    <input type = "hidden" name = "product_price" value = "<?php echo $row['price']; ?>"> </input>
                                    <input type = "hidden" name = "product_quantity" value = "1"> </input>
                                    <input type = "hidden" name = "product_type" value = "style box"> </input>
                                    <input type = "hidden" name = "style_box" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                    <div class="d-inline buy_now">
                                        <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit" name ="buy_now">Buy Now</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>

                <!-- style box reviews -->
                <div class="row shadow rounded-2 m-3 gray_bg">
                        <div class="card rounded-2 border-0 shadow-sm gray_bg overflow-hidden">
                            <!-- customer reviews (static) -->
                            <div class="m-1 p-2 center_align">
                                <div class="row p-4 border-2 green_border rounded-2">
                                    <h4 class="text-center bold_header green_highlight2 mb-4">See what others received from our <span class="green_highlight"><?php echo $row['style'] . ' ' . 'Box'; ?></span>!</h4>
                                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                                        <div class="card border-1 p-3">
                                            <div class="review_content">
                                                <div class="row">
                                                    <div class="col star_icon mb-2">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                </div>
                                                <h6 class="bold_header">Items gets better and BETTER!</h6>
                                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                                <div class="row mt-2 justify-content-start">
                                                    <div class="col-4"><div class="card border-0 gray_sq overflow-hidden">
                                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                                    </div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                                        <div class="card border-1 p-3">
                                            <div class="review_content">
                                                <div class="row">
                                                    <div class="col star_icon mb-2">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                </div>
                                                <h6 class="bold_header">New STYLES to try</h6>
                                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                                <div class="row mt-2 justify-content-start">
                                                    <div class="col-4"><div class="card border-0 gray_sq overflow-hidden">
                                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                                    </div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                                        <div class="card border-1 p-3">
                                            <div class="review_content">
                                                <div class="row">
                                                    <div class="col star_icon mb-2">
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                        <i class="bi bi-star-fill"></i>
                                                    </div>
                                                </div>
                                                <h6 class="bold_header">LOVE THE SKIRTS</h6>
                                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                                <div class="row mt-2 justify-content-start">
                                                    <div class="col-4"><div class="card border-0 gray_sq overflow-hidden">
                                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                                    </div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            <?php } ?>

            <!-- Related  Single Items -->
            <div class="row rounded-2 m-3 p-2 gray_bg">
                <div class="mt-3 mb-0 ms-2 single_items">
                    <h6 class="mb-0">RELATED SINGLE ITEMS</h6>
                </div>
                <div class="row mt-0 mx-1 p-2 gx-3">
                    
                    <?php include('server/get_related_item_style.php'); ?>
                
                    <!-- Loop through the related items -->
                    <?php while ($row = $related_items->fetch_assoc()) { ?>
                    
                        <!-- card -->
                        <div class="col-sm-3 p-2">
                            <a href="<?php echo "item.php?item_id=" . $row['item_id'] ?>" class="text-decoration-none">
                                <div class="card overflow-hidden rounded-1 card_content item_card">
                                    <img src="resources/<?php echo $row['item_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="<?php echo $row['item_name']; ?>">
                                    <div class="card-body p-3">
                                        <p class="item_name"><?php echo $row['item_name']; ?></p>
                                        <!-- price and category -->
                                        <div class="row p-0 d-flex justify-content-between">
                                            <div class="col-5 m-0 text-align-left">
                                                <p class="card-text item_price m-0"><?php echo $row['price']; ?></p>
                                            </div>
                                            <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                                <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php } ?>

                </div>
            </div>
        </div>
    </div>
</body>
</html>