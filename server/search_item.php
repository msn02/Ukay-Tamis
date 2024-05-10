<?php   
    if (isset($_GET['search_input'])) {
        $search = $_GET['search_input'];
        $search = "%".$search."%"; // Add wildcard characters to the search term

        $stmt = $conn -> prepare ("SELECT * FROM item WHERE item_name LIKE ?");
        $stmt -> bind_param("s", $search);
        $stmt -> execute();
    
        $featured_styles = $stmt -> get_result();
    }
?>