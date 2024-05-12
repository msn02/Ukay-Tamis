<nav class="navbar navbar-expand-lg dark_gray_bg sticky-top">
    <div class="container px-5">
        <a class="navbar-brand page_title" href="landing_page.php"><span class="pink_highlight">UKAY</span> <span class="white_text">TAMIS</span></a>
        <!-- toggler -->
        <button class="navbar-toggler btn shadow-none border-0 justify-content-end m-0 p-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarLink" aria-controls="navbarLink" aria-expanded="false" aria-label="Toggler">
            <div class="burger_icon justify-content-end">
                <i class="bi bi-list"></i>
            </div>
        </button>
        <!-- navbar contents -->
        <div class="collapse navbar-collapse justify-content-end dark_gray_bg" id="navbarLink">
            <div class="m-0 p-0">
                <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="landing_page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalogue_page.php">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_page.php">About Us</a>
                    </li>
                    <!-- subscribe button -->
                    <li class="nav-item pink_btn2 px-4 d-none d-sm-block">
                        <a href="subscription_price.php" class="text-decoration-none"><button class="btn btn-dark border-0 px-3 py-1 mt-1 shadow rounded-1 nav-link" type="button" onclick="">SUBSCRIBE NOW</button></a>
                    </li>
                    <!-- shopping cart -->
                    <li class="nav-item cart_icon me-2">
                        <a class="nav-link position-relative" href="view_cart.php">
                            <i class="bi bi-cart-fill"></i>
                        </a>
                        <!-- TO DO: Add a badge -->
                    </li>
                    <!-- profile -->
                    <li class="nav-item user_btn align-content-center center_align cart_icon dropdown">
                        <button class="nav-link dropdown-toggle p-0 m-0" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-dark">
                            <li><a class="dropdown-item" href="account.php">My Account</a></li>
                            <li><a class="dropdown-item" href="account.php?logout">Log out</a></li>
                        </ul>
                        <!-- TO DO: Log in/out, Sign up dropdown options -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>