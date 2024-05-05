<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Subscription</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/subscription.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid gradient_pink px-3 pt-1">
        <div class="container px-5 py-3 mt-0">
            <!-- back button -->
            <div class="back_link ps-5 py-2 m-0">
                <a class="border-0 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            <div class="row m-2 p-0 d-flex justify-content-center">
                <div class="col-sm-8 gray_bg rounded-3 p-0 m-2 text-center overflow-hidden">
                    <div class="header_style px-4 pt-3 pb-2 m-0 ">
                        <h5 class="bold_header">CHOOSE A TIER</h5>
                    </div>
                    <div class="row py-3 px-4 d-flex justify-content-evenly">
                        <!-- tiers -->
                        <!-- basic -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                <div class="card-body tier_card mb-0">
                                    <div class="star_icon">
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <h6 class="card-title bold_header mt-2">Basic</h6>
                                    <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="tier" id="basic" autocomplete="off" checked>
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="basic">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- premium -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                <div class="card-body tier_card mb-0">
                                    <div class="star_icon">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <h6 class="card-title bold_header mt-2">Premium</h6>
                                    <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="tier" id="premium" autocomplete="off">
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="premium">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <!-- exclusive -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                <div class="card-body tier_card mb-0">
                                    <div class="star_icon">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                    </div>
                                    <h6 class="card-title bold_header mt-2">Exclusive</h6>
                                    <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="tier" id="exclusive" autocomplete="off">
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="exclusive">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- subscription plan -->
                    <div class="header_style2 px-4 pt-3 pb-2 m-0 ">
                        <h5 class="bold_header">CHOOSE YOUR <span class="green_highlight">SUBSCRIPTION PLAN</span></h5>

                    </div>
                    <div class="row py-3 px-4 d-flex justify-content-evenly">
                        <!-- prices -->
                        <!-- 3 months -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                <div class="card-body price_card mb-0">
                                    <h2 class="pink_highlight2 bold_header">PHP 399/<sup>mo</sup></h2>
                                    <h6 class="card-title month_title mt-2">3 MONTHS</h6>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="price" id="3_mon" autocomplete="off" checked>
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="3_mon">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        
                        <!-- 6 months -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card rounded-1 border-1 m-0 p-0 overflow-hidden">
                                <div class="card-body price_card mb-0">
                                    <h2 class="pink_highlight2 bold_header">PHP 699/<sup>mo</sup></h2>
                                    <h6 class="card-title month_title mt-2">6 MONTHS</h6>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="price" id="6_mon" autocomplete="off">
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="6_mon">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- 12 months -->
                        <div class="col-sm-4 img_style p-2">
                            <div class="card shadow-sm price_badge rounded-1 border-0 m-0 p-0 overflow-hidden">
                                <div class="card-body price_card mb-0">
                                    <h2 class="pink_highlight2 bold_header">PHP 999/<sup>mo</sup></h2>
                                    <h6 class="card-title month_title mt-2">12 MONTHS</h6>
                                </div>
                                <div class="card-body pink_btn2 mt-0 p-2">
                                    <input type="radio" class="btn-check" name="price" id="12_mon" autocomplete="off">
                                    <label class="btn btn-secondary w-100 m-0 p-2 rounded-1" for="12_mon">
                                        <span class="radio-btn-text">SELECT</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <div class="row mt-3 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header mb-3">Package Details</h6>
                        <!-- package details -->
                        <div class="row mb-3 center_align m-0 p-0">
                            <div class="card price_badge p-3 m-0 package_info">
                                <h6 class="bold_header mb-1">PREMIUM Tier</h6>
                                <p class="bold_header mb-2">6 Months</p>
                                <p class="card-text mb-0">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            </div>
                        </div>
                    </div>
                    <!-- total -->
                    <div class="row p-0 mb-0 mt-3 cart_info">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header">PHP 156</p>
                        </div>
                    </div>
                    <div class="pink_btn2 pb-2">
                        <a href="checkout_page.php"><button class="btn btn-dark border-0 rounded-1 w-100">ADD TO CART</button></a>
                    </div>
                    <div class="gray_btn pb-3">
                        <a href="checkout_page.php"><button class="btn btn-secondary border-0 rounded-1 w-100">CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>