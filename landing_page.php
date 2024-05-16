<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ukay Tamis!</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/landing.css">
</head>
<body class="gray_bg2 m-0 p-0 vstack">
    <!-- navigation bar -->
    <?php 
        if (isset($_SESSION['logged_in'])) {
            include 'auth_nav_bar.php';
        } else {
            include 'nav_bar.php';
        }
    ?>

    <div class="container-fluid m-0 p-0 gradient_pink">
        <!-- title and intro -->
        <div class="container p-4">
            <div class="row p-3 white_text hstack">
                <div class="col-sm-8 px-4 py-3 subtitle">
                    <h1 class="bold_header m-3">Thrifted Fashion, Curated for You!</h1>
                    <p class="m-3">Experience the thrill of thrifted fashion, handpicked just for you by our style experts. At Ukay Tamis, we curate a collection of trendy and sustainable clothing items, giving you access to one-of-a-kind pieces that reflect your individuality.</p>
                    <ul class="ms-3">
                        <li>Explore a diverse range of styles, from vintage classics to modern trends.</li>
                        <li>Shop with confidence knowing that each item is carefully selected for quality and style.</li>
                        <li>Join our community of fashion enthusiasts and share your unique finds.</li>
                    </ul>
                </div>
                <div class="col-sm-8 px-4 pt-5 pb-3 mx-3">
                    <!-- subscribe -->
                    <div class="pink_btn white_border">
                        <a href="monthly_theme_page.php" class="text-decoration-none "><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1" type="button">SUBSCRIBE NOW</button></a>
                    </div>
                    <!-- view catalogue -->
                    <div class="white_btn2 mt-2">
                        <a href="catalogue_page.php" class="text-decoration-none"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1" type="button">View Catalogue<i class="bi bi-chevron-right ms-2"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid m-0 p-0 footer_bg">
        <div class="container p-4">
            <div class="row p-3 gap-2">
                <div class="col px-4 py-3 mx-1 subtitle hstack white_text d-flex align-items-start">
                    <h4 class="p-2 pink_highlight"><i class="bi bi-clipboard2-fill me-3"></i></h4>
                    <div class="lh-1 white_btn2">
                        <h4 class="bold_header">Take Style Quiz</h4>
                        <p class="opacity-75">Discover your unique fashion preferences with our interactive style quiz.</p>
                        <a href="#style_quiz"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1">Take the Quiz</button></a>
                    </div>
                </div>
                <div class="col px-4 py-3 mx-1 subtitle hstack white_text d-flex align-items-start">
                    <h4 class="p-2 pink_highlight"><i class="bi bi-box2-fill me-3"></i></h4>
                    <div class="lh-1">
                        <h4 class="bold_header">Choose your Style</h4>
                        <p class="opacity-75">Browse our curated collections and find the perfect pieces to elevate your wardrobe.</p>
                    </div>
                </div>
                <div class="col px-4 py-3 mx-1 subtitle hstack white_text d-flex align-items-start">
                    <h4 class="p-2 pink_highlight"><i class="bi bi-check-circle-fill me-3"></i></h4>
                    <div class="lh-1">
                        <h4 class="bold_header">Try it on!</h4>
                        <p class="opacity-75">Shop with confidence knowing that each item is carefully selected for quality and style.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- subscription -->
    <div class="container-fluid m-0 p-0">
        <div class="container p-4">
            <div class="row p-3 d-flex justify-content-center position-relative">
                <!-- wrapped panel-behind container -->
                <div class="col-sm-10 z-0 p-5 mt-5 mx-1 d-flex justify-content-center footer_bg position-absolute rounded-3">
                    <div class="mt-5 pt-5 white_text">
                        <div class="mt-5 p-5 z-1">
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 z-1 px-4 pt-2 subtitle">
                    <div class="white_bg rounded-2 ms-3 p-4 vstack shadow">
                        <h1 class="bold_header mx-3 mt-3 text-center">Discover Thrifted Treasures with Our Monthly Subscription</h1>
                        <p class="m-3 black_text text-center">Experience curated second-hand fashion delivered straight to your doorstep. Each month, our themed subscription boxes feature quality thrifted items aligned with the season’s trend. Whether you’re drawn to whimsical cottagecore, elegant coquette, or mysterious gothic styles, our platform caters to diverse tastes. Explore sustainable fashion without breaking the bank!</p>
                    </div>
                </div>
            </div>

            <div class="row p-0 mt-0 d-flex justify-content-center">
                <div class="col-sm-10 px-5 z-1 mx-5 footer_bg rounded-3">
                    <div class="white_text text-center">
                        <div class="row py-5 m-0 d-flex align-items-stretch">
                            <h2 class="bold-header mb-4">What's inside the box?</h2>
                            <div class="col-sm-3 d-flex align-items-stretch">
                                <div class="card h-100 overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/dress.jpg" alt="">
                                    <div class="card-body text-start">
                                    <h5 class="card-title fw-bold">Elegant Vintage Dress</h5>
                                    <p class="card-text lh-sm">Step out in style with this timeless vintage dress. Its delicate lace details and flattering silhouette make it a must-have for any fashion enthusiast.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex align-items-stretch">
                                <div class="card h-100 overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/pants.jpg" alt="">
                                    <div class="card-body text-start">
                                    <h5 class="card-title fw-bold">Classic High-Waisted Pants</h5>
                                    <p class="card-text lh-sm">Upgrade your wardrobe with these high-waisted pants. Versatile and comfortable, they pair perfectly with any top for a chic look.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex align-items-stretch">
                                <div class="card h-100 overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/more.jpg" alt="">
                                    <div class="card-body text-start">
                                    <h5 class="card-title fw-bold">Vintage Button-Up Shirt</h5>
                                    <p class="card-text lh-sm">Add a touch of retro charm with this button-up shirt. Whether you tuck it in or wear it loose, it's a versatile piece for any occasion.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 d-flex align-items-stretch">
                                <div class="card h-100 overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/more.jpg" alt="">
                                    <div class="card-body text-start">
                                    <h5 class="card-title fw-bold">Boho Accessories Set</h5>
                                    <p class="card-text lh-sm">Complete your outfit with this boho accessories set. From layered necklaces to statement earrings, embrace the free-spirited vibe.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row gradient_yellow p-2 mb-5 rounded-1 d-flex justify-content-between">
                        <div class="col-sm-3 p-2 logo_img">
                            <img src="resources/theme_logo.png" alt="">
                        </div>
                        <div class="p-3 col-sm-8 align-middle vstack lh-1">
                            <h3 class="fw-bolder">Summer Fest 2024</h3>
                            <h5 class="bold_header">Don't miss the chance to get LIMITED summer-themed oufits!</h5>
                            <div class="mt-2 orange_btn">
                                <a href="monthly_theme_page.php"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1">Check this Box<i class="bi bi-chevron-right ms-2"></i></button></a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>        
    </div>

    <!-- quiz -->
    <div class="container-fluid mx-0 mt-4 p-0 footer_bg" id="style_quiz">
        <div class="container p-4">
            <div class="p-4 gap-2">
                <div class="white_text text-center">
                    <h3 class="fw-bold" ><span class="pink_highlight"><i class="bi bi-clipboard2-fill me-3"></i></span>
                        Discover your <span class="pink_highlight">STYLE</span> with our interactive quiz!
                    </h3>
                </div>
                <!-- quiz -->
                <?php include 'quiz_style.php'?>
            </div>
        </div>
    </div>

    <!-- catalog -->
    <div class="container-fluid mx-0 m-0 py-4 gradient_pink2">
        <div class="container p-4 white_bg rounded-2 shadow">
            <div class="row d-flex justify-content-center m-4">
                <div class="col-sm-10 text-center subtitle mb-4">
                    <h1 class="fw-bold">Choose Your Style!</h1>
                    <p class="lh-base">Explore our diverse range of second-hand fashion items. Whether you're into elegant vintage dresses, classic high-waisted pants, or unique accessories, we've got something for every style. Start your thrifting journey today!</p>
                </div>
                <?php include('server/get_featured_style.php')?>
                <?php while ($featured_styles && $row = $featured_styles->fetch_assoc()) { ?>
                <div class="col-sm-3 d-flex align-items-stretch">
                    <div class="card h-100 overflow-hidden item_card style_card_info mb-0 shadow-sm">
                        <img src="resources/<?php echo $row['style_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="">
                        <div class="card-body p-2">
                            <p class="item_name my-1 mx-1"><?php echo $row['style']; ?></p>
                            <p class="style_info mx-1"><?php echo $row['style_description']; ?></p>
                        </div>
                        <div class="pink_btn2 m-2">
                            <a href="<?php echo "style_box.php?style_id=" . $row['style_id'] ?>" class="text-decoration-none"><button class="check_style_btn btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button></a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- mystery box -->
    <div class="container-fluid mt-0 p-0 footer_bg">
        <div class="container p-3">
            <div class="my-5 gap-2">
                <div class="row gradient_green p-2 rounded-1 d-flex justify-content-between mx-5">
                    <div class="col-sm-3 p-2 logo_img my-auto">
                        <img src="resources/mystery_box_logo.png" alt="">
                    </div>
                    <div class="col-sm-8 p-3 align-middle vstack lh-1">
                        <h3 class="fw-bolder">Haul rare items with our Mystery Box!</h3>
                        <h5 class="bold_header">Unbox surprises and explore new styles.</h5>
                        <div class="mt-2 green_btn">
                            <a href="mystery_box.php"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1">Get a Box<i class="bi bi-chevron-right ms-2"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQs -->
    <div class="container-fluid my-5 p-0">
        <div class="container m-auto">
            <h1 class="fw-bolder text-center mb-5">Frequently Asked Questions</h1>
            <div class="row m-0 p-0 d-flex justify-content-center">
                <div class="accordion col-sm-8" id="accordionFAQS">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            How does the monthly subscription work
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Our monthly subscription delivers themed boxes of thrifted treasures straight to your doorstep. Each month, subscribers can expect a carefully curated selection of quality second-hand fashion items aligned with the theme of the month.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Can I customize my subscription preferences?
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Absolutely! We offer a style quiz to help you discover your preferences. Whether you’re drawn to whimsical cottagecore, elegant coquette, or mysterious gothic styles, our platform caters to diverse tastes.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What if I prefer a more hands-on approach
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">No worries! Our platform features an extensive catalog of thrifted fashion pieces. You can explore and choose individual items that resonate with your style.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            Are the subscription prices reasonable?
                        </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Yes! We’re committed to making sustainable fashion accessible to everyone. Our prices are reasonable, ensuring that quality thrifted fashion items won’t break the bank.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            What’s the story behind the name “Ukay Tamis”?
                        </button>
                        </h2>
                        <div id="collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">“Ukay” resonates with the vibrant world of thrifted fashion, while “Tamis” adds a touch of sweetness—a flavor that lingers long after the initial discovery. It embodies our mission to infuse joy and sweetness into the thrifting experience.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- contact_us -->
    <?php include 'contact_us.php'?>
</body>
</html>
