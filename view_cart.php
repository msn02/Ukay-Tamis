<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Shopping Cart</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/view_cart.css">
</head>
<body class="gray_bg2">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid gradient_pink px-3 pt-1">
        <div class="container px-5 py-3 mt-3">
            <div class="row m-2 p-0 d-flex justify-content-center">
                <!-- shopping cart -->
                <div class="col-sm-8 gray_bg rounded-2 px-4 py-3 m-2">
                    <h3 class="bold_header mb-3 pb-3 border-bottom mt-3">My Shopping Cart</h3>
                    <!-- cart items -->
                    <div class="row p-3 mx-2 mb-4 border rounded-2">
                        <div class="col-sm-3 item_img center_align form_style d-flex justify-content-between">
                            <input class="form-check-input" type="checkbox" value="" id="item_check">
                            <img src="resources/coquette.jpg" class="card" alt="item">
                        </div>
                        <!-- item details -->
                        <div class="col-sm-4 d-flex align-items-center">
                            <h6 class="item_header">Item name</h6>
                        </div>
                        <!-- counter -->
                        <div class="col-sm-2 form_style d-flex justify-content-center align-items-center m-0 p-0">
                            <div class="input-group gray_btn counter_sec  m-0 p-0">
                                <button class="btn btn-dark rounded-start" type="button" id="minus_btn">-</button>
                                <input type="number" class="form-control m-0 ps-4" value="1" readonly id="counter_input">
                                <button class="btn btn-dark rounded-end" type="button" id="add_btn">+</button>
                            </div>
                        </div>
                        <!-- price -->
                        <div class="col-sm-2 center_align m-0 p-0">
                            <h6 class="pink_highlight2 bold_header m-0 p-0 ">PHP 123</h6>
                        </div>
                        <!-- delete item -->
                        <div class="col-sm-1 center_align m-0 p-0 delete_btn">
                            <button class="btn btn-dark border-0 rounded-1"><i class="bi bi-trash-fill"></i></button>
                        </div>
                    </div>
                </div>

                <!-- proceed checkout -->
                <div class="col-sm-3 gray_bg rounded-2 px-4 py-3 m-2">
                    <!-- cart actions -->
                    <div class="row mt-3 border-bottom">
                        <h6 class="border-bottom pb-2 bold_header mb-3">Actions</h6>
                        <div class="form_style pb-3">
                            <input class="form-check-input me-2" type="checkbox" value="" id="all_items">
                            <label class="form-check-label" for="checkbox_agree">
                                Select all
                            </label>
                        </div>
                        <div class="delete_btn2 pb-3">
                            <button class="btn btn-dark border-0 rounded-1 w-100">Delete</button>
                        </div>
                    </div>
                    <!-- cart info -->
                    <div class="row mt-3 p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p>Total items</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="bold_header">4</p>
                        </div>
                    </div>
                    <div class="row p-0 mb-0 cart_info">
                        <div class="col-6">
                            <p class="bold_header">TOTAL</p>
                        </div>
                        <div class="col-6 text-end">
                            <p class="pink_highlight bold_header">PHP 156</p>
                        </div>
                    </div>
                    <div class="pink_btn2 pb-3">
                        <a href="checkout_page.php"><button class="btn btn-dark border-0 rounded-1 w-100">CHECKOUT</button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<!-- counter script -->
<script>
    const counterInput = document.getElementById('counter_input');
    const addButton = document.getElementById('add_btn');
    const minusButton = document.getElementById('minus_btn');

    addButton.addEventListener('click', function() {
        counterInput.value = parseInt(counterInput.value) + 1;
    });

    minusButton.addEventListener('click', function() {
        const currentValue = parseInt(counterInput.value);
        if (currentValue > 1) {
            counterInput.value = currentValue - 1;
        }
    });
</script>
