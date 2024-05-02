<nav class="navbar navbar-expand-lg dark_gray_bg sticky-top px-3">
    <div class="container">
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
                <ul class="navText navbar-nav mr-auto mt-2 mt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="landing_page.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="catalogue_page.php">Catalogue</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about_page.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact_page.php">Contact Us</a>
                    </li>
                    <!-- shopping cart -->
                    <li class="nav-item cart_icon">
                        <a class="nav-link position-relative" href="view_cart.php">
                            <i class="bi bi-cart-fill"></i>
                        </a>
                        <!-- TO DO: Add a badge -->
                    </li>
                    <!-- profile -->
                    <li class="nav-item cart_icon">
                        <a class="nav-link"><i class="bi bi-person-circle"></i></a>
                        <!-- TO DO: Log in/out, Sign up dropdown options -->
                    </li>
                </ul>
            </div>
        </div>
    </div>
</nav>