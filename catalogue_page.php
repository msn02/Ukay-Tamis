<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catalogue</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/catalogue.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid gradient_pink p-0">
        <!-- logo and search bar -->
        <div class="container px-5 pt-3">
           <div class="row px-3">
                <!-- logo -->
                <div class="col-sm-3 brand_logo d-none d-sm-block pt-1 white_text center_align">
                    <a class="navbar-brand page_title d-flex" href="landing_page.php">UKAY TAMIS</a>
                </div>
                <!-- search bar -->
                <div class="col-sm-9 p-2">
                    <form class="d-flex m-0 border-0 search_label" role="search">
                        <input class="form-control me-2 rounded-1 border-0 focus-ring focus-ring-light" type="search" placeholder="Browse items" aria-label="Search">
                        <div class="pink_btn">
                            <button class="btn btn-dark border-0 px-3 shadow rounded-1" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                        <!-- only visible to smaller screens -->
                        <div class="white_btn d-sm-none d-block">
                            <button class="btn btn-dark ms-2 border-0 px-3 shadow rounded-1" type="submit"><i class="bi bi-filter"></i></button>
                        </div>
                    </form>
                </div>
           </div>
        </div>
        <!-- filters and search results -->
        <div class="container px-5">
            <div class="row px-3">
                <!-- hidden on smaller screens -->
                <div class="col-sm-3 d-none d-sm-block p-2">
                    <div class="gray_bg rounded-1 p-3">
                        <h6 class="bold_header">Filters</h6>
                        <p></p>
                    </div>
                </div>
                <!-- items and search results -->
                <div class="col-sm-9 p-2">
                    <div class="gray_bg rounded-1 p-3">
                        <!-- choose your style -->
                        <div class="rounded-2 pt-3 px-3 style_con">
                            <div class="row g-3 mb-3 center_align">
                                <h5 class="bold_header mb-0 center_text">Choose your <span class="pink_highlight2">STYLE</span></h5>
                                <!-- style card -->
                                <div class="col-sm-3">
                                    <div class="card overflow-hidden item_card mb-0">
                                        <img src="resources/cottagecore.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2 maroon_btn">
                                            <p class="item_name my-1">Cottagecore</p>
                                            <p class="">some random words</p>
                                            <button class="btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card overflow-hidden item_card mb-0">
                                        <img src="resources/coquette.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2 pink_btn2">
                                            <p class="item_name my-1">Coquette</p>
                                            <p class="">some random words</p>
                                            <button class="btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="card overflow-hidden item_card mb-0">
                                        <img src="resources/gothic_lolita.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2 black_btn">
                                            <p class="item_name my-1">Gothic Lolita</p>
                                            <p class="">some random words</p>
                                            <button class="btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- recom/result header -->
                        <!-- display upon opening catalogue -->
                        <div class="recom_header mt-3 mb-0 ms-2">
                            <p>RECOMMENDED FOR YOU</p>
                        </div>
                        <!-- display only upon searching an item -->
                        <div class="search_result mt-3 md-0 ms-2 d-none">
                            <p>Search results for <span class="pink_highlight">item name</span></p>
                        </div>
                        <!-- items -->
                        <div class="row g-3 mb-3 px-2">
                            <!-- card -->
                            <div class="col-sm-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card overflow-hidden rounded-1 card_content item_card">
                                        <img src="resources/2.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2">
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
                            <div class="col-sm-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card overflow-hidden rounded-1 card_content item_card">
                                        <img src="resources/2.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2">
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
                            <div class="col-sm-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card overflow-hidden rounded-1 card_content item_card">
                                        <img src="resources/2.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2">
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
                            <div class="col-sm-3">
                                <a href="#" class="text-decoration-none">
                                    <div class="card overflow-hidden rounded-1 card_content item_card">
                                        <img src="resources/2.jpg" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2">
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

                            <!-- insert pagination -->
                        </div> <!--item close tag-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>