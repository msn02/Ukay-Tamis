<?php
    // Include the connection.php file
    include('connection.php');
    
    if (isset($_GET['style_id'])) {
        $style_id = $_GET['style_id'];

        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT reviews.*, user.* 
                                            FROM reviews 
                                            INNER JOIN user ON reviews.user_id = user.user_id 
                                            WHERE reviews.style_id = ? 
                                            ORDER BY reviews.review_id DESC 
                                            LIMIT 3");

        // Bind the parameters
        $stmt -> bind_param("s", $style_id);

        // Execute the query
        $stmt -> execute();
       
        // Get the result
        $reviews = $stmt -> get_result();

    } else {
        header('location: catalogue_page.php');
    }
?>