<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mystery Box</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/mystery_box.css">
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

    <div class="container-fluid gradient_green p-0 pt-1">
        <div class="container px-5 py-3 mt-0">
            <!-- back button -->
            <div class="back_link ps-3 py-2 m-0">
                <a class="border-0 rounded-1 justify-content-start text-decoration-none w-25" id="go_back" href="javascript:void(0)"><i class="bi bi-chevron-left me-2"></i>Back</a>
            </div>
            <div class="row m-2 p-0 d-flex justify-content-center">
            

                <!-- img logos -->
                <div class="col-10 center_align">
                    <span class="img_logo"><img src="resources/mystery_box_logo.png" class="d-none d-sm-block" alt="img"></span>
                    <span class="img_logo2"><img src="resources/mystery_box_logo.png" class="d-sm-none d-block" alt="img"></span>
                </div>

                <div class="col-10 mt-3 p-0">
                    <div class="card rounded-2 border-0 shadow gray_bg overflow-hidden">
                        <div class="header_style text-center p-3">
                            <h1 class="p-0 m-0 bold_header2">Haul <span class="green_highlight">RARE</span> items today!</h1>
                        </div>
                        
                        <div class="m-4 p-3 center_align">
                            <!-- how the feature works -->
                            <div class="row p-4 border-0 center_align rounded-2 yellow_bg d-flex align-items-stretch">
                                <h5 class="bold_header2 mb-4 text-center pink_highlight2">How MYSTERY boxes work</h5>
                                <!-- 1 -->
                                <div class="col-sm-4">
                                    <div class="card h-100 border-0 overflow-hidden rounded-2 mb-2">
                                        <div class="card-body">
                                            <div class="card-title row p-1">
                                                <div class="col-sm-1 center_align px-3 py-0">
                                                    <h4 class="bold_header">1</h4>
                                                </div>
                                                <div class="col-sm-10 card_content pl-3 d-flex align-items-center">
                                                    <div class="m-0 p-0">
                                                        <h6 class="mb-1 p-0 bold_header">Add to Cart</h6>
                                                        <p class="m-0 p-0">Select your desired Mystery Box and add it to your cart. Choose from different themes and sizes.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 2 -->
                                <div class="col-sm-4">
                                    <div class="card h-100 border-0 overflow-hidden rounded-2 mb-2">
                                        <div class="card-body">
                                            <div class="card-title row p-1">
                                                <div class="col-sm-1 center_align px-3 py-0">
                                                    <h4 class="bold_header">2</h4>
                                                </div>
                                                <div class="col-sm-10 card_content pl-3 d-flex align-items-center">
                                                    <div class="m-0 p-0">
                                                        <h6 class="mb-1 p-0 bold_header">Receive</h6>
                                                        <p class="m-0 p-0">Receive your Mystery Box filled with handpicked thrifted items. Each box contains unique surprises!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- 3 -->
                                <div class="col-sm-4">
                                    <div class="card h-100 border-0 overflow-hidden rounded-2 mb-2">
                                        <div class="card-body">
                                            <div class="card-title row p-1">
                                                <div class="col-sm-1 center_align px-3 py-0">
                                                    <h4 class="bold_header">3</h4>
                                                </div>
                                                <div class="col-sm-10 card_content pl-3 d-flex align-items-center">
                                                    <div class="m-0 p-0">
                                                        <h6 class="mb-1 p-0 bold_header">Experiment Styles</h6>
                                                        <p class="m-0 p-0">Explore your thrifted treasures and experiment with fresh styles. It's like a fashion adventure!</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3 p-0">
                                    <!-- add to cart + checkout btn -->

                                    <?php include('server/get_mystery_box.php'); ?>
                                    <form method = "POST" action = "view_cart.php">
                                        <div class="center_align pink_btn2 pb-2">
                                        <input type = "hidden" name = "product_id" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                        <input type = "hidden" name = "product_img_url" value = "<?php echo $row['style_img_url']; ?>"> </input>
                                        <input type = "hidden" name = "product" value = "<?php echo $row['style']; ?>"> </input>
                                        <input type = "hidden" name = "product_price" value = "<?php echo $row['price']; ?>"> </input>
                                        <input type = "hidden" name = "product_quantity" value = "1"> </input>
                                        <input type = "hidden" name = "product_type" value = "style box"> </input>
                                        <input type = "hidden" name = "style_box" value = "<?php echo $row['style_box_id']; ?>"> </input>
                                        <a href="checkou"><button class="btn btn-dark border-0 rounded-1 px-3 shadow" type = "submit" name ="add_to_cart"><i class="bi bi-cart-plus me-2"></i>ADD TO CART</button></a>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-10 mt-3 p-0">
                    <div class="card rounded-2 border-0 shadow-sm gray_bg overflow-hidden">
                        <!-- customer reviews (static) -->
                        <div class="m-4 p-3 center_align">
                            <div class="row p-4 border-2 green_border rounded-2 d-flex align-items-stretch">
                                <h4 class="text-center bold_header green_highlight2 mb-4">See what others received from our <span class="green_highlight">MYSTERY BOXES</span> !</h4>
                                
                                <?php 
                                    include('server/get_mystery_box_review.php'); 

                                    // Check if there are any reviews
                                    if ($reviews->num_rows > 0) {
                                        // Output each review
                                        while ($row = $reviews->fetch_assoc()) { 
                                    ?>
                                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                                        <div class="card h-100 border-0 shadow-sm p-3">
                                            <div class="review_content ">
                                                <div class="row">
                                                    <div class="col star_icon mb-2">
                                                        <?php
                                                        // Assume $row['rating'] contains the rating value
                                                        $rating = $row['rating'];

                                                        for ($i = 0; $i < $rating; $i++) {
                                                            echo '<i class="bi bi-star-fill"></i>';
                                                        }
                                                        ?>
                                                    </div>
                                                </div>
                                                <h6 class="bold_header"><?php echo $row['title']; ?></h6>
                                                <p class="mb-1"><?php echo $row['review']; ?></p>
                                                <span class="bold_header review_name"><?php echo strtoupper($row['first_name'] . ' ' . $row['last_name']); ?></span>
                                                <div class="row mt-2 justify-content-start">
                                                    <div class="col-4"><div class="card border-0 gray_sq overflow-hidden">
                                                        <img src="resources/<?php echo $row['img_review']; ?>" class="img-fluid" alt="Subscribe">
                                                    </div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } 
                                    } else {
                                        echo '<h6 class="text-center">Be the first one to try out the style box. Buy now!</h6>';
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer -->
        <?php include 'contact_us.php'?>
    </div>
</body>
</html>