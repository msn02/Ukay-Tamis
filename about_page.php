<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/about.css">
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

    <div class="container-fluid gradient_pink m-0 p-0">
        <div class="container p-4">
            <div class="row center_align p-3 center_text white_text">
                <div class="col-sm-8 px-4 py-3 subtitle">
                    <h1 class="bold_header m-3">Insert Title</h1>
                    <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                </div>
            </div>
        </div>
        <!-- mission and vision -->
        <div class="container-fluid gray_bg mt-3 p-5">
           <div class="container px-5">
                <div class="row d-flex justify-content-evenly">
                    <div class="col-sm-5 p-4 subtitle rounded-2 shadow">
                        <h3 class="bold_header pink_highlight2">Our Mission</h3>
                        <p class="">Ukay Tamis is committed to adding convenience to the thrifting experience by providing a curated, user-friendly, and affordable platform for quality second-hand fashion. Our mission is to bridge the thrill of treasure hunting with convenience, offering unique fashion pieces to all while promoting sustainability in the fashion industry.</p>
                    </div>
                    <div class="col-sm-5 p-4 subtitle rounded-2 shadow">
                        <h3 class="bold_header pink_highlight2">Our Vision</h3>
                        <p class="">At Ukay Tamis, our vision is to redefine the thrifting experience, making it synonymous with joy, sweetness, and affordability. Through innovation, inclusivity, and a deep commitment to our values, we aim to inspire a global community of fashion enthusiasts to embrace thrifted fashion as a delightful journey of self-expression and sustainability, all delivered straight to your doorstep.</p>
                    </div>
                </div>
           </div>
        </div>
        <div class="container-fluid gradient_green m-0 p-0">
            <div class="container px-5">
                <div class="row center_align p-4 center_text white_text">
                    <div class="col-sm-8 px-4 py-3 subtitle">
                        <h1 class="bold_header m-3">Meet the team</h1>
                        <p class="m-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Bibendum est ultricies integer quis auctor elit sed. Nec dui nunc mattis enim ut tellus elementum sagittis vitae. Et molestie ac feugiat sed lectus vestibulum mattis ullamcorper velit.</p>
                    </div>
                </div>

                <div class="row center_align p-3 d-flex justify-content-between">
                    <div class="col-sm-4 p-4 rounded-3 shadow-sm green_border">
                        <h4 class="bold_header mb-1">Guirald Malone Escober</h4>
                        <h6 class="mb-2 p-0">Project Manager</h6>
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-sm-4 p-4 rounded-3 shadow-sm green_border">
                        <h4 class="bold_header mb-1">Daniela Cantillo</h4>
                        <h6 class="mb-2 p-0">Lead Programmer</h6>
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>

                <div class="row center_align p-3 d-flex justify-content-evenly">
                    <div class="col-sm-4 p-4 rounded-3 shadow-sm green_border">
                        <h4 class="bold_header mb-1">Misty Shaine Niones</h4>
                        <h6 class="mb-2 p-0">Lead UI/UX Designer</h6>
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                    <div class="col-sm-4 p-4 rounded-3 shadow-sm green_border">
                        <h4 class="bold_header mb-1">Joseph Riosa</h4>
                        <h6 class="mb-2 p-0">Database Manager</h6>
                        <p class="m-0 p-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            </div>
            <!-- footer -->
            <?php include 'contact_us.php'?>
        </div>
    </div>
</body>
</html>