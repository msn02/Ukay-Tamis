<?php
    session_start();

    // include connection file
    include('server/connection.php');
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
                    <form class="d-flex m-0 border-0 search_label" role="search" method = "GET" action = style.php>
                        <input class="form-control me-2 rounded-1 border-0 focus-ring focus-ring-light" type="search" placeholder="Browse items" aria-label="Search" name = "search_input">
                        <div class="pink_btn">
                            <button class="btn btn-dark border-0 px-3 shadow rounded-1" name = "search" type="submit"><i class="bi bi-search"></i></button>
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
                        <form method = "POST" action = "style.php">

                        <?php $category = isset($_POST['category']) ? $_POST['category'] : ''; ?>

                        <!-- Group by Style -->
                        <div class="border-bottom border-1 filter_title filter_content p-2">
                            <p class="my-1">Group by Style</p>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Cottagecore" id="style_cottagecore" <?php echo $category == 'Cottagecore' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_cottagecore">Cottagecore</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Coquette" id="style_coquette" <?php echo $category == 'Coquette' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_coquette">Coquette</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Gothic Lolita" id="style_gothic_lolita" <?php echo $category == 'Gothic Lolita' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_gothic_lolita">Gothic Lolita</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Streetwear" id="style_streetwear" <?php echo $category == 'Streetwear' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_streetwear">Streetwear</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Y2K" id="style_y2k" <?php echo $category == 'Y2K' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_y2k">Y2K</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Dark Academia" id="style_dark_academia" <?php echo $category == 'Dark Academia' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_dark_academia">Dark Academia</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Old Money" id="style_old_money" <?php echo $category == 'Old Money' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_old_money">Old Money</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Alt" id="style_alt" <?php echo $category == 'Alt' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_alt">Alt</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Indie" id="style_indie" <?php echo $category == 'Indie' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_indie">Indie</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="category" type="radio" value="Star Girl" id="style_star_girl" <?php echo $category == 'Star Girl' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="style_star_girl">Star Girl</label>
                            </div>
                        </div>

                        <!-- price -->
                        <div class="border-bottom border-1 filter_title filter_content p-2">
                            <p class="my-1">Pricing</p>
                            <div class="form-check ms-3">
                        <?php $price = isset($_POST['price']) ? $_POST['price'] : ''; ?>
                                <input class="form-check-input" name="price" type="radio" value="low_to_high" id="low_high" <?php echo $price == 'low_to_high' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="low_high">From Low to High</label>
                            </div>
                            <div class="form-check ms-3">
                                <input class="form-check-input" name="price" type="radio" value="high_to_low" id="high_low" <?php echo $price == 'high_to_low' ? 'checked' : ''; ?>>
                                <label class="form-check-label ms-1" for="high_low">From High to Low</label>
                            </div>
                        </div>

                        <div class="mt-3 mx-2 mb-0 px-2">
                            <span class="pink_btn2"><button class="btn w-100 border-0 p-2 rounded-1 text-decoration-none" name = "search_filter" href="#">FILTER</button></span>
                            <span class="gray_btn"><button class="btn btn-secondary my-2 w-100 border-0 p-2 rounded-1 text-decoration-none" href="#" id = "clear_selection">CLEAR SELECTION</button></span>
                        </div>
                        </form>
                    </div>
                </div>

                <!-- Featured -->
                <div class="col-sm-9 p-2">
                    <div class="gray_bg rounded-1 p-3">
                        
                        <!-- Featured Styles -->
                        <div class="rounded-2 pt-3 px-3 style_con">
                            <div class="row g-3 mb-3 d-flex justify-content-start">
                                <!-- title and link to view more styles -->
                                <div class="pink_btn2 row mt-2 p-2 view_more_link">
                                    <h5 class="col bold_header mb-0 p-0 mx-3">Choose your <span class="pink_highlight2">STYLE</span></h5>
                                </div>
                                
                                <!-- Include the seach_filter_style.php file -->
                                <?php include('server/get_mystery_box.php'); ?>

                                <!-- Style card -->
                                <div class="col-sm-3 d-flex align-items-stretch justify-content-start">
                                    <div class="card h-100 overflow-hidden item_card style_card_info mb-0">
                                        <img src="resources/<?php echo $row['style_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="<?php echo $row['style_img_url']; ?>">
                                        <div class="card-body p-2">
                                            <p class="item_name my-1 mx-1"><?php echo $row['style']; ?></p>
                                            <p class="style_info mx-1"><?php echo $row['style_description']; ?></p>
                                        </div>
                                        <div class="pink_btn2 m-2">
                                            <a href="mystery_box.php"><button class="check_style_btn btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS BOX <i class="bi bi-chevron-right"></i></button></a>
                                        </div>
                                    </div>
                                </div>

                                <!-- Include the seach_filter_style.php file -->
                                <?php include('server/search_filter_style.php'); ?>
                                    
                                <?php include('server/search_style.php') ?>

                                <!-- Loop through the featured styles -->
                                <?php while ($featured_styles && $row = $featured_styles->fetch_assoc()) { ?>
                                
                                <!-- Style card -->
                                <div class="col-sm-3 d-flex align-items-stretch">
                                    <div class="card h-100 overflow-hidden item_card style_card_info mb-0">
                                        <img src="resources/<?php echo $row['style_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="<?php echo $row['style_img_url']; ?>">
                                        <div class="card-body p-2">
                                            <p class="item_name my-1 mx-1"><?php echo $row['style']; ?></p>
                                            <p class="style_info mx-1"><?php echo $row['style_description']; ?></p>
                                        </div>
                                        <div class="pink_btn2 m-2">
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
                            <!-- insert pagination -->
                        </div> <!--item close tag-->
                    
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    document.getElementById('clear_selection').addEventListener('click', function() {
        var radios = document.querySelectorAll('input[type="radio"][name="category"]');
        var price = document.querySelectorAll('input[type="radio"][name="price"]');

        for (var i = 0; i < price.length; i++)
            price[i].checked = false;

        for(var i = 0; i < radios.length; i++)
            radios[i].checked = false;
    });
</script>
</html>