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
    <?php include 'nav_bar.php'?>

    <div class="container-fluid m-0 p-0 gradient_pink">
        <!-- title and intro -->
        <div class="container p-4">
            <div class="row p-3 white_text hstack">
                <div class="col-sm-8 px-4 py-3 subtitle">
                    <h1 class="bold_header m-3">Thrifted Fashion, Curated for You!</h1>
                    <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                    <ul class="ms-3">
                        <li>Id velit ut tortor pretium viverra suspendisse potenti.</li>
                        <li>Id velit ut tortor pretium viverra suspendisse potenti.</li>
                        <li>Id velit ut tortor pretium viverra suspendisse potenti.</li>
                    </ul>
                
                </div>
                <div class="col-sm-8 px-4 pt-5 pb-3 mx-3">
                    <!-- subscribe -->
                    <div class="pink_btn white_border">
                        <a href="subscription_price.php" class="text-decoration-none "><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1" type="button">SUBSCRIBE NOW</button></a>
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
                        <p class="opacity-75">Id velit ut tortor pretium viverra suspendisse potenti.</p>
                        <a href="#style_quiz"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1">Take the Quiz</button></a>
                    </div>
                </div>
                <div class="col px-4 py-3 mx-1 subtitle hstack white_text d-flex align-items-start">
                    <h4 class="p-2 pink_highlight"><i class="bi bi-box2-fill me-3"></i></h4>
                    <div class="lh-1">
                        <h4 class="bold_header">Choose your Style</h4>
                        <p class="opacity-75">Id velit ut tortor pretium viverra suspendisse potenti.</p>
                    </div>
                </div>
                <div class="col px-4 py-3 mx-1 subtitle hstack white_text d-flex align-items-start">
                    <h4 class="p-2 pink_highlight"><i class="bi bi-check-circle-fill me-3"></i></h4>
                    <div class="lh-1">
                        <h4 class="bold_header">Try it on!</h4>
                        <p class="opacity-75">Id velit ut tortor pretium viverra suspendisse potenti.</p>
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
                        <h1 class="bold_header mx-3 mt-3 text-center">Subscription Tagline</h1>
                        <p class="m-3 black_text text-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                    </div>
                </div>
            </div>

            <div class="row p-0 mt-0 d-flex justify-content-center">
                <div class="col-sm-10 px-5 z-1 mx-5 footer_bg rounded-3">
                    <div class="white_text text-center">
                        <div class="row py-5 m-0">
                            <h2 class="bold-header mb-4">What's inside the box?</h2>
                            <div class="col-sm-3">
                                <div class="card overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/dress.jpg" alt="">
                                    <div class="card-body text-start">
                                        <h5 class="card-title fw-bold"> Title </h5>
                                        <p class="card-text lh-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/pants.jpg" alt="">
                                    <div class="card-body text-start">
                                        <h5 class="card-title fw-bold"> Title </h5>
                                        <p class="card-text lh-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/more.jpg" alt="">
                                    <div class="card-body text-start">
                                        <h5 class="card-title fw-bold"> Title </h5>
                                        <p class="card-text lh-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="card overflow-hidden border-0 rounded-1 card_img">
                                    <img src="resources/more.jpg" alt="">
                                    <div class="card-body text-start">
                                        <h5 class="card-title fw-bold"> Title </h5>
                                        <p class="card-text lh-sm">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
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
    <div class="container-fluid mx-0 mt-4 p-0 footer_bg">
        <div class="container p-4">
            <div class="p-4 gap-2">
                <div class="white_text text-center">
                    <h3 class="fw-bold" id="style_quiz"><span class="pink_highlight"><i class="bi bi-clipboard2-fill me-3"></i></span>
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
                    <h1 class="fw-bold">Choose your STYLE!</h1>
                    <p class="lh-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptas maxime suscipit sunt provident voluptatem fuga nisi inventore itaque explicabo tempora accusantium mollitia quisquam sequi ab, labore id voluptatum perspiciatis!</p>
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
                            <a href="" class="text-decoration-none"><button class="check_style_btn btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button></a>
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
                        <h5 class="bold_header">Subtitle</h5>
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
                                Question
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia fuga autem illo quia sunt, explicabo quasi maiores a est, similique natus! Quas quisquam distinctio natus excepturi vitae, suscipit consequatur itaque.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            Question #2
                        </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quidem officiis debitis nihil velit assumenda, delectus odio ex quam placeat sed perspiciatis rem numquam vel hic distinctio? Officia consequatur non incidunt.</p>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Question #3
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFAQS">
                            <div class="accordion-body subtitle">
                                <p class="lh-base">Lorem ipsum dolor sit amet consectetur adipisicing elit. Explicabo quos eveniet facilis est tempora eum consequatur odio! Accusamus voluptas ipsa nisi voluptatum inventore deleniti qui, nostrum ex unde maiores eveniet.</p>
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
