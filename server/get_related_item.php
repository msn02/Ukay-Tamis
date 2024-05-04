<?php
    // Include the connection.php file
    include('connection.php');
    
    if (isset($_GET['style_id'])) {
        $style_id = $_GET['style_id'];

        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT * FROM item WHERE style_id = ?");

        // Bind the parameters
        $stmt -> bind_param("i", $style_id);

        // Execute the query
        $stmt -> execute();
       
        // Get the result
        $related_items = $stmt -> get_result();


    } else {
        header('location: catalogue_page.php');
    }
?>