<?php
    // Include the connection.php file
    include('connection.php');
    
    if (isset($_GET['style_id'])) {
        $style_id = $_GET['style_id'];

        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT * FROM item INNER JOIN style ON item.style_id = style.style_id WHERE item.style_id = ? AND item.transaction_id IS NULL");

        // Bind the parameters
        $stmt -> bind_param("s", $style_id);

        // Execute the query
        $stmt -> execute();
       
        // Get the result
        $related_items = $stmt -> get_result();


    } else {
        header('location: catalogue_page.php');
    }
?>