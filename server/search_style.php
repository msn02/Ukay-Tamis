<?php   
    if (isset($_GET['search_input'])) {
        $search = $_GET['search_input'];

        $stmt = $conn -> prepare ("SELECT * FROM style WHERE style_id <> 'style-0068' AND style LIKE ?");
    
        $stmt -> bind_param("s", $search);
    
        $stmt -> execute();
    
        $featured_styles = $stmt -> get_result();
    }
?>