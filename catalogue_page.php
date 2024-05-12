<?php
    session_start();
?>



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
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid gradient_pink p-0">
        <!-- logo and search bar -->
        <div class="container px-5 pt-3">
           <div class="row px-3">
                <!-- logo -->
                <div class="col-sm-3 brand_logo d-none d-sm-block pt-1 white_text m-auto">
                    <a class="navbar-brand page_title text-center d-flex justify-content-center" href="landing_page.php"><span class="pink_highlight me-1">UKAY</span>TAMIS</a>
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
                            <button class="btn btn-dark ms-2 border-0 px-3 shadow rounded-1" type="submit"><i class="bi bi-funnel-fill"></i></i></button>
                        </div>
                    </form>
                </div>
           </div>
        </div>
        <!-- filters and search results -->
        <div class="container px-5">
            <div class="row px-3">
                
                
                <!-- Filters: hidden on smaller screens -->
                <div class="col-sm-3 d-none d-sm-block p-2">
                    <div class="gray_bg rounded-1 pt-3 px-4 pb-4">
                        <h6 class="bold_header m-0">SEARCH FILTERS</h6>
                        
                        <!-- Sizes -->
                        <div class="border-bottom border-1 filter_title filter_content p-2">
                            <p class="mb-1">Sizes</p>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value="" id="small">
                                <label class="form-check-label ms-1" for="small">Small</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value="" id="medium">
                                <label class="form-check-label ms-1" for="small">Medium</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value="" id="large">
                                <label class="form-check-label ms-1" for="small">Large</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" type="checkbox" value="" id="freesize">
                                <label class="form-check-label ms-1" for="small">Freesize</label>
                            </div>
                        </div>

                        <!-- Group by Style -->
                        <div class="border-bottom border-1 filter_title filter_content p-2">
                            <p class="my-1">Group by Style</p>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_cottagecore">
                                <label class="form-check-label ms-1" for="style_cottagecore">Cottagecore</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_coquette">
                                <label class="form-check-label ms-1" for="style_coquette">Coquette</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_gothic_lolita">
                                <label class="form-check-label ms-1" for="style_gothic_lolita">Gothic Lolita</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_streetwear">
                                <label class="form-check-label ms-1" for="style_streetwear">Streetwear</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_y2k">
                                <label class="form-check-label ms-1" for="style_y2k">Y2K</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_dark_academia">
                                <label class="form-check-label ms-1" for="style_dark_academia">Dark Academia</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_old_money">
                                <label class="form-check-label ms-1" for="style_old_money">Old Money</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_alt">
                                <label class="form-check-label ms-1" for="style_alt">Alt</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_indie">
                                <label class="form-check-label ms-1" for="style_indie">Indie</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="sort" type="radio" value="" id="style_star_girl">
                                <label class="form-check-label ms-1" for="style_star_girl">Star Girl</label>
                            </div>
                        </div>

                        <!-- price -->
                        <div class="border-bottom border-1 filter_title filter_content p-2">
                            <p class="my-1">Pricing</p>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="price" type="radio" value="" id="low_high">
                                <label class="form-check-label ms-1" for="low_high">From Low to High</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="price" type="radio" value="" id="high_low">
                                <label class="form-check-label ms-1" for="high_low">From High to Low</label>
                            </div>
                        </div>

                        <div class="mt-3 mx-2 mb-0 px-2 pink_btn2">
                            <button class="btn w-100 border-0 p-2 rounded-1 text-decoration-none" href="#">CLEAR SELECTION</i></button>
                        </div>
                    </div>
                </div>

                <!-- Featured -->
                <div class="col-sm-9 p-2">
                    <div class="gray_bg rounded-1 p-3">
                        
                        <!-- Featured Styles -->
                        <div class="rounded-2 pt-3 px-3 style_con">
                            <div class="row g-3 mb-3 center_align">
                                <!-- title and link to view more styles -->
                                <div class="pink_btn2 row mt-2 p-2 view_more_link">
                                    <h5 class="col bold_header mb-0 p-0 mx-0">Choose your <span class="pink_highlight2">STYLE</span></h5>
                                    <a class="col-sm-3 border-0 p-0 rounded-1 justify-content-end text-decoration-none text-end d-none d-sm-block" href="#">View more styles <i class="bi bi-chevron-right"></i></a>
                                </div>
                                
                                <!-- Include the get_featured_style.php file -->
                                <?php include('server/get_featured_style.php'); ?>

                                <!-- Loop through the featured styles -->
                                <?php while ($row = $featured_styles->fetch_assoc()) { ?>
                                
                                <!-- Style card -->
                                <div class="col-sm-3">
                                    <div class="card overflow-hidden item_card style_card_info mb-0">
                                        <img src="resources/<?php echo $row['style_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2 pink_btn2">
                                            <p class="item_name my-1 mx-1"><?php echo $row['style']; ?></p>
                                            <p class="style_info mx-1"><?php echo $row['style_description']; ?></p>
                                            <a href="<?php echo "style_box.php?style_id=" . $row['style_id'] ?>"><button class="check_style_btn btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button></a>
                                        </div>
                                    </div>
                                </div>

                                <?php } ?>

                                <!-- view more: visible only to small screens -->
                                <div class="mt-3 mx-2 mb-0 px-2 pink_btn2 d-sm-none d-block">
                                    <button class="btn w-100 border-0 p-2 rounded-1 text-decoration-none" href="#">View more styles <i class="bi bi-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>


                        <!-- Featured Items -->
                        <div class="row g-3 mb-3 px-2">

                            <div class="recom_header mt-3 pt-4 mb-0">
                                <h5 class="bold_header p-0 m-0">SINGLE LISTINGS</h5>
                            </div>
                            <!-- <div class="search_result mt-3 md-0 ms-2 d-none">
                                <p>Search results for <span class="pink_highlight">item name</span></p>
                            </div> -->
                            
                            <!-- Include the get_featured_style.php file -->
                            <?php include('server/get_featured_item.php'); ?>

                            <!-- Loop through the featured items -->
                            <?php while ($row = $featured_styles->fetch_assoc()) { ?>

                            <!-- Item card -->
                            <div class="col-sm-3">
                                <a href="<?php echo "item.php?item_id=" . $row['item_id'] ?>" class="text-decoration-none">
                                    <div class="card overflow-hidden rounded-1 card_content item_card">
                                        <img src="resources/<?php echo $row['item_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="item">
                                        <div class="card-body p-2">
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
                            <!-- insert pagination -->
                        </div> <!--item close tag-->
                    
                    </div>
                </div>
            </div>
        </div>    
            
    <!-- footer -->
    <?php include 'footer.php'?>
    
    </div>
</body>
</html>