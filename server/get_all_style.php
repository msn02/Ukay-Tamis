<?php 
    // Include the connection.php file
    include('connection.php');

    // Prepare the SQL query
    $stmt = $conn -> prepare ("SELECT * FROM style_box_details WHERE style_id <> 'style-0068'");

    // Execute the query
    $stmt -> execute();
    
    // Get the result
    $featured_styles = $stmt -> get_result();
?>