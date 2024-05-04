<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cottagecore</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/item.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid p-3 gradient_pink center-align">
        <div class="container px-5 py-3">
            <!-- back button -->
            <div class="back_link p-2">
                <a class="border-0 p-2 rounded-1 justify-content-start text-decoration-none w-25" href="catalogue_page.php"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>

            <div class="row shadow rounded-2 m-3 gray_bg">
                <!-- product image -->
                <div class="col-sm-5 m-0 p-4">
                    <div class="card overflow-hidden border-0">
                        <img src="resources/cottagecore.jpg" alt="cottagecore">
                    </div>
                </div>
                <!-- product details -->
                <div class="col-sm-7 m-0 py-4 px-3">
                    <!-- tag and title -->
                    <div class="row m-0 p-3 pb-0 justify-content-between g-3">
                        <div class="col-sm-10 m-0 p-0">
                            <h2 class="bold_header align-content-center ps-0 mb-0 pb-0">COTTAGECORE</h2>
                        </div>
                        <div class="d-sm-none d-block m-1"></div>
                        <div class="col-sm-2 col-md-2 m-0 p-0 bold_header center-align align-content-center">
                            <p class="rounded-1 tag_pink px-2 py-1 m-0 center_text">STYLE</p>
                        </div>
                    </div>
                    <!-- style description -->
                    <div class="p-3 mb-0">
                        <div class="border-top pt-3 pb-3">
                            <h6 class="bold_header">Style Description</h6>
                            <p class="m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                        </div>
                    </div>
                    <!-- add to card and buy now button -->
                    <div class="px-3 pt-0 m-0">
                        <div class="d-inline add_cart">
                            <button class="btn btn-dark border-0 px-3 mb-1 rounded-1" type="submit"><i class="bi bi-cart-plus me-1"></i></button>
                        </div>
                        <div class="d-inline buy_now">
                            <button class="btn btn-dark border-0 px-3 mb-1 rounded-1" type="submit">Buy Now</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row shadow rounded-2 m-3 p-2 gray_bg">
                <div class="mt-3 mb-0 ms-2 single_items">
                    <h6 class="mb-0">FEATURED SINGLE ITEMS</h6>
                </div>
                <div class="row mt-0 mx-1 p-2 gx-3">
                    <!-- card -->
                    <div class="col-sm-3 p-2">
                        <a href="#" class="text-decoration-none">
                            <div class="card overflow-hidden rounded-1 card_content item_card">
                                <img src="resources/cottagecore.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                <div class="card-body p-3">
                                    <p class="item_name">Lorem ipsum dolor sit amet, consectetur</p>
                                    <!-- price and category -->
                                    <div class="row p-0 d-flex justify-content-between">
                                        <div class="col-5 m-0 text-align-left">
                                            <p class="card-text item_price m-0">PHP 123</p>
                                        </div>
                                        <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                            <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- card -->
                    <div class="col-sm-3 p-2">
                        <a href="#" class="text-decoration-none">
                            <div class="card overflow-hidden rounded-1 card_content item_card">
                                <img src="resources/cottagecore.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                <div class="card-body p-3">
                                    <p class="item_name">Lorem ipsum dolor sit amet, consectetur</p>
                                    <!-- price and category -->
                                    <div class="row p-0 d-flex justify-content-between">
                                        <div class="col-5 m-0 text-align-left">
                                            <p class="card-text item_price m-0">PHP 123</p>
                                        </div>
                                        <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                            <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- card -->
                    <div class="col-sm-3 p-2">
                        <a href="#" class="text-decoration-none">
                            <div class="card overflow-hidden rounded-1 card_content item_card">
                                <img src="resources/cottagecore.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                <div class="card-body p-3">
                                    <p class="item_name">Lorem ipsum dolor sit amet, consectetur</p>
                                    <!-- price and category -->
                                    <div class="row p-0 d-flex justify-content-between">
                                        <div class="col-5 m-0 text-align-left">
                                            <p class="card-text item_price m-0">PHP 123</p>
                                        </div>
                                        <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                            <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- card -->
                    <div class="col-sm-3 p-2">
                        <a href="#" class="text-decoration-none">
                            <div class="card overflow-hidden rounded-1 card_content item_card">
                                <img src="resources/cottagecore.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                <div class="card-body p-3">
                                    <p class="item_name">Lorem ipsum dolor sit amet, consectetur</p>
                                    <!-- price and category -->
                                    <div class="row p-0 d-flex justify-content-between">
                                        <div class="col-5 m-0 text-align-left">
                                            <p class="card-text item_price m-0">PHP 123</p>
                                        </div>
                                        <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                            <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>