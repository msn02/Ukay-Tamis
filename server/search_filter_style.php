<?php
    include('connection.php');

    // Initialize $featured_styles as an empty array
    $featured_styles = null;

    if (isset ($_POST['search_filter'])) {

        if (isset($_POST['category'])) {
            $category = $_POST['category'];

            $stmt = $conn -> prepare ("SELECT * FROM style WHERE style = ?");
            $stmt -> bind_param("s", $category);
            $stmt -> execute();

            // Get the result
            $featured_styles = $stmt -> get_result();
        } 
        else {
            
            include ('get_all_style.php');
        }
    }
    else {
        include ('get_all_style.php');
    }
?>