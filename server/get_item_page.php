<?php
    // Include the connection.php file
    include('connection.php');
    
    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];

        // Prepare the SQL query
        $stmt = $conn -> prepare ("SELECT * FROM item INNER JOIN style ON item.style_id = style.style_id WHERE item.item_id = ?");

        // Bind the parameters
        $stmt -> bind_param("s", $item_id);

        // Execute the query
        $stmt -> execute();
       
        // Get the result
        $item = $stmt -> get_result();


    } else {
        header('location: catalogue_page.php');
    }
?>