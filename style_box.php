<?php include('server/get_style_page.php'); ?>

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
    <?php include 'nav_bar.php'?>

    <div class="container-fluid px-3 pt-1 gradient_pink center-align">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-2">
                <a class="border-0 p-2 rounded-1 justify-content-start text-decoration-none w-25" href="catalogue_page.php"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>

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
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0"><?php echo $row['style'] . " Box"; ?></h2>
                        </div>
                        <div class="d-sm-none d-block m-1"></div>
                        <div class="col-sm-2 col-md-2 m-0 p-0 bold_header center-align align-content-center">
                            <p class="rounded-1 tag_pink px-2 py-1 m-0 center_text">STYLE BOX</p>
                        </div>
                    </div>
                    <!-- box price -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="m-0">
                            <h4 class="pink_highlight2 rounded-2 p-3 bold_header box_price">PHP 123</h4>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="pt-3 px-3 mb-0">
                        <div class="border-top pt-3 pb-0 m-0">
                            <h6 class="bold_header">Style Description</h6>
                            <p class="box_desc m-0 p-0"><?php echo $row['style_box_description']; ?></p>
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
                        <div class="d-inline add_cart">
                            <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit"><i class="bi bi-cart-plus me-1"></i></button>
                        </div>
                        <div class="d-inline buy_now">
                            <button class="btn btn-dark border-0 px-3 py-2 mb-1 rounded-1" type="submit">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <!-- Related  Single Items -->
            <div class="row rounded-2 m-3 p-2 gray_bg">
                <div class="mt-3 mb-0 ms-2 single_items">
                    <h6 class="mb-0">FEATURED SINGLE ITEMS</h6>
                </div>
                <div class="row mt-0 mx-1 p-2 gx-3">
                    
                    <?php include('server/get_related_item.php'); ?>
                
                    <!-- Loop through the related items -->
                    <?php while ($row = $related_items->fetch_assoc()) { ?>

                    <!-- card -->
                    <div class="col-sm-3 p-2">
                        <a href="item_page.php" class="text-decoration-none">
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