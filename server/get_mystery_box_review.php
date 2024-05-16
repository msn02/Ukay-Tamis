<?php
    // Include the connection.php file
    include('connection.php');
    
    // Prepare the SQL query
    $stmt = $conn -> prepare ("SELECT reviews.*, user.* 
                                FROM reviews 
                                INNER JOIN user ON reviews.user_id = user.user_id 
                                WHERE reviews.style_id = 'style-0068' 
                                ORDER BY reviews.review_id DESC LIMIT 3");

    // Execute the query
    $stmt -> execute();
    
    // Get the result
    $reviews = $stmt -> get_result();

?>