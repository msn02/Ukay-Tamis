<?php include('server/get_style_page.php'); ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cottagecore</title>
    <?php include 'head_resource.php';?>
    <link rel="stylesheet" href="css/item.css">
</head>
<body class="gray_bg">
    <!-- navigation bar -->
    <?php include 'nav_bar.php'?>

    <div class="container-fluid p-0">
        <div class="container px-5 pt-3">
            <div class="back_link">
                <a class="border-0 p-2 rounded-1 justify-content-start text-decoration-none d-none d-sm-block" href="catalogue_page.php"><i class="bi bi-chevron-left"></i>Back</a>
            </div>
            <div class="row p-3 shadow rounded-2 m-3">

                <?php while ($row = $style->fetch_assoc()) { ?>
                <div class="col-sm-5">
                    <div class="card overflow-hidden">
                        <img src="resources/<?php echo $row['style_img_url']; ?>" alt="<?php echo $row['style']; ?>">
                    </div>
                </div>
                
                
                <div class="col-sm-7 p-2">
                    <div class="m-0 bold_header justify-content-start">
                        <p class="rounded-1 tag_pink m-0 px-2 py-1">STYLE BOX</p>
                    </div>
                    <h6 class="bold_header item_title"><?php echo $row['style'] . "Box"; ?></h6>

                    <p class="style_info"><?php echo $row['style_description']; ?></p>
                    <p class="style_info"><?php echo $row['style_box_description']; ?></p>

                    <div class="col-5 m-0 text-align-left">
                        <p class="card-text item_price m-0"><?php echo $row['price']; ?></p>
                    </div>
                    <a href="style_1.php"><button class="check_style_btn btn btn-dark border-0 px-3 shadow rounded-1 w-100" type="submit">CHECK THIS STYLE <i class="bi bi-chevron-right"></i></button></a>
                </div>
                <?php } ?>


            </div>

            <!-- Related Items -->
            <div class="row g-3 mb-3 px-2">

            <div class="recom_header mt-3 mb-0 ms-2">
                <h5>SINGLE LISTINGS</h5>
            </div>
            <div class="search_result mt-3 md-0 ms-2 d-none">
                <p>Search results for <span class="pink_highlight">item name</span></p>
            </div>

            <!-- Include the get_featured_style.php file -->
            <?php include('server/get_related_item.php'); ?>

            <!-- Loop through the featured items -->
            <?php while ($row = $related_items->fetch_assoc()) { ?>

            <!-- Item card -->
            <div class="col-sm-3">
                <a href="#" class="text-decoration-none">
                    <div class="card overflow-hidden rounded-1 card_content item_card">
                        <img src="resources/<?php echo $row['item_img_url']; ?>" class="img-fluid card-img-top rounded-top-1" alt="item">
                        <div class="card-body p-2">
                            <p class="item_name"><?php echo $row['item_name']; ?></p>
                            <!-- price and category -->
                            <div class="row p-0 d-flex justify-content-between">
                                <div class="col-5 m-0 text-align-left">
                                    <p class="card-text item_price m-0"><?php echo $row['price']; ?></p>
                                </div>
                                <div class="col-6 m-0 bold_header center_text center_align justify-content-end">
                                    <p class="rounded-1 tag_green m-0 px-2 py-1">FEATURED</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <?php } ?>


            <!-- insert pagination -->
            </div> <!--item close tag-->


        </div>
    </div>
</body>
</html>