<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Ukay Tamis!</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/landing.css">
</head>
<body class="gray_bg2 m-0 p-0">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid m-0 p-0 gradient_pink2">
        <!-- title and intro -->
        <div class="container center_align">
            <div class="row center_align p-3 center_text white_text">
                <div class="col-sm-8 px-4 pt-3 subtitle">
                    <h1 class="bold_header m-3">Thrifted Fashion, Curated for You!</h1>
                    <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                    <p class="m-3">Id velit ut tortor pretium viverra suspendisse potenti.</p>
                </div>
                <!-- subscribe -->
                <div class="px-0 pink_btn white_border pb-1">
                    <a href="subscription_price.php" class="text-decoration-none "><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1" type="button">SUBSCRIBE NOW</button></a>
                </div>
                <!-- view catalogue -->
                <div class="white_btn2 pb-3 mt-2 ms-2">
                    <a href="catalogue_page.php" class="text-decoration-none"><button class="btn btn-dark border-0 px-4 shadow-sm rounded-1" type="button">View Catalogue<i class="bi bi-chevron-right ms-2"></i></button></a>
                </div>
            </div>
        </div>
        
        <!-- how UKAY TAMIS works -->
        <div class="container-fluid m-0 p-3 how_app_work gray_bg">
            <h4 class="bold_header pink_highlight2 pt-3">How <strong>Ukay Tamis</strong> Works</h4>
            <div class="row center_align pt-3 px-5 m-0 gx-5 how_app_work">
                <div class="col-sm-3">
                    <div class="card ratio ratio-1x1 mb-3 overflow-hidden">
                        <img src="resources/1.jpg" class="img-fluid" alt="Subscribe">
                    </div>
                    <h5><span class="pink_highlight title1 m-0">Subscribe</span></h5>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-sm-3">
                    <div class="card ratio ratio-1x1 mb-3 overflow-hidden">
                        <img src="resources/2.jpg" class="img-fluid" alt="Curate">
                    </div>
                    <h5><span class="pink_highlight title1 m-0">We Curate</span></h5>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
                <div class="col-sm-3">
                    <div class="card ratio ratio-1x1 mb-3">
                        <img src="resources/3.jpg" class="img-fluid" alt="Try-on">
                    </div>
                    <h5><span class="pink_highlight title1 m-0">Try it on!</span></h5>
                    <p class="mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- mystery box -->
    <div class="container-fluid m-0 p-0 gradient_green">
        <div class="container">
            <div class="row center_align pt-3 center_text white_text">
                <div class="col-sm-8 px-4 pt-4 subtitle">
                    <h2 class="bold_header mb-3">Haul RARE items with our <span class="green_highlight">MYSTERY BOX</span>!</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                    <p>Id velit ut tortor pretium viverra suspendisse potenti.</p>
                </div>
                <div class="row center_align pt-3 px-5 gx-3">
                    <!-- image -->
                    <div class="col-sm-3 mb-4">
                        <div class="card border-0 overflow-hidden card_content">
                            <img src="resources/shirts.jpg" class="card-img-top img-fluid" alt="Subscribe">
                            <div class="card-body">
                                <p class="card-text">Shirts</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-4">
                        <div class="card border-0 overflow-hidden card_content">
                            <img src="resources/dress.jpg" class="card-img-top img-fluid" alt="Subscribe">
                            <div class="card-body">
                                <p class="card-text">Dresses</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-4">
                        <div class="card border-0 overflow-hidden card_content">
                            <img src="resources/pants.jpg" class="card-img-top img-fluid" alt="Subscribe">
                            <div class="card-body">
                                <p class="card-text">Pants</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 mb-4">
                        <div class="card border-0 overflow-hidden card_content">
                            <img src="resources/more.jpg" class="card-img-top img-fluid" alt="Subscribe">
                            <div class="card-body">
                                <p class="card-text">and Many More!</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 p-0 green_btn mt-2 mb-3 btn_text">
                    <a href="mystery_box.php" class="text-decoration-none"><button class="btn btn-dark border-0 px-4 shadow rounded-1" type="button">GET A MYSTERY BOX</button></a>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid m-0 p-0">
        <!-- customer reviews -->
        <div class="container-fluid pb-4">
            <div class="container p-5">
                <div class="row p-4 rounded-2 green_border">
                    <h4 class="text-center bold_header mb-4">What our <span class="">Subscribers</span> Say</h4>
                    <!-- card -->
                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                        <div class="card border-0 p-3">
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
                                <h6 class="bold_header">Worth the price!</h6>
                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                <div class="row mt-2 justify-content-start">
                                    <div class="col-2"><div class="card border-0 gray_sq overflow-hidden">
                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                    </div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                        <div class="card border-0 p-3">
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
                                <h6 class="bold_header">My go-to shop for clothes!</h6>
                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                <div class="row mt-2 justify-content-start">
                                    <div class="col-2"><div class="card border-0 gray_sq overflow-hidden">
                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                    </div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 mb-3 mt-0 mx-0">
                        <div class="card border-0 p-3">
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
                                <h6 class="bold_header">LOVE THE TOPS!</h6>
                                <p class="mb-1">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                                <span class="bold_header review_name">JUAN DELA CRUZ</span>
                                <div class="row mt-2 justify-content-start">
                                    <div class="col-2"><div class="card border-0 gray_sq overflow-hidden">
                                        <img src="resources/2.jpg" class="img-fluid" alt="Subscribe">
                                    </div></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- choose a plan -->
                    <div class="d-flex justify-content-center p-0 pink_btn pt-2 btn_text">
                        <a href="subscription_price.php" class="text-decoration-none"><button class="btn btn-dark border-0 px-4 shadow rounded-1" type="button">CHOOSE A PLAN</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TO DO: footer -->
</body>
</html>
