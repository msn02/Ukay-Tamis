<?php
    // Include the connection.php file
    include('connection.php');
    
    if (isset($_GET['item_id'])) {
        $item_id = $_GET['item_id'];

        // Prepare the SQL query to get the style_id of the current item
        $stmt = $conn -> prepare ("SELECT style_id FROM item WHERE item_id = ? AND transaction_id IS NULL");

        // Bind the parameters
        $stmt -> bind_param("s", $item_id);

        // Execute the query
        $stmt -> execute();

        // Get the result
        $result = $stmt -> get_result();
        $row = $result -> fetch_assoc();
        $style_id = $row['style_id'];

        // Prepare the SQL query to get the related items
        $stmt = $conn -> prepare ("SELECT * FROM item INNER JOIN style ON item.style_id = style.style_id WHERE (item.style_id = ? AND item.item_id <> ?) AND item.transaction_id IS NULL");

        // Bind the parameters
        $stmt -> bind_param("ss", $style_id, $item_id);

        // Execute the query
        $stmt -> execute();

        // Get the result
        $related_items = $stmt -> get_result();
    } else {
        header('location: catalogue_page.php');
    }
?>