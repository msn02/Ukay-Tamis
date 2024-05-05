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
            <div class="row gray_bg m-2 rounded-2 p-3">
                <h3 class="bold_header mb-3 pb-3 border-bottom mt-3">My Shopping Cart</h3>
                <!-- cart items -->
                <div class="row p-3 mb-3">
                    <div class="col-sm-2 item_img center_align form_style d-flex justify-content-between">
                        <input class="form-check-input" type="checkbox" value="" id="item_check">
                        <img src="resources/coquette.jpg" class="card" alt="item">
                    </div>
                    <!-- item details -->
                    <div class="col-sm-5 d-flex align-items-center">
                        <h6 class="item_header">Item name</h6>
                    </div>
                    <!-- counter -->
                    <div class="col-sm-2 form_style center_align counter_sec m-0 p-0">
                        <div class="input-group gray_btn">
                            <button class="btn btn-dark rounded-start" type="button" id="minus_btn">-</button>
                            <input type="number" class="form-control text-center" value="1" readonly id="counter_input">
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
        </div>
        <!-- sticky footer -->
        <div class="container-fluid mb-0 fixed-bottom px-5">
            <div class="row shadow rounded-top gray_bg mx-5 p-3">
                <div class="col-sm-4 p-3">
                    <div class="form_style">
                        <input class="form-check-input" type="checkbox" value="" id="select_all">
                        <label for="select_all">Select all items</label>
                    </div>
                </div>
                <div class="col-sm-8 p-3 d-flex justify-content-end">
                    <p>rururu</p>
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
