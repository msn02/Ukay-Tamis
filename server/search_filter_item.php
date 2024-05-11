<?php                 
    include('connection.php');      
                
    // Initialize $featured_styles as an empty array    
    $featured_styles = null;

    if (isset ($_POST['search_filter'])) {
        $query = "SELECT * FROM item";
        $params = [];
        $types = "";

        if (isset($_POST['category'])) {
            $query .= " WHERE style = ?";
            $params[] = $_POST['category'];
            $types .= "s";
        }

        if (isset($_POST['size']) && is_array($_POST['size'])) {
            $sizes = $_POST['size'];
            $placeholders = str_repeat('?,', count($sizes) - 1) . '?';
            $query .= (isset($_POST['category']) ? " AND" : " WHERE") . " size IN ($placeholders)";
            $params = array_merge($params, $sizes);
            $types .= str_repeat('s', count($sizes));
        }

        if (isset($_POST['price'])) {
            $sortDirection = $_POST['price'] == 'high_to_low' ? 'DESC' : 'ASC';
            $query .= " ORDER BY price $sortDirection";
        }

        $stmt = $conn->prepare($query);

        if (!empty($types)) {
            $stmt->bind_param($types, ...$params);
        }

        $stmt->execute();

        // Get the result
        echo "<div class=\"search_result mt-3 md-0 ms-2 d-none\">
                        <p>Search results for <span class=\"pink_highlight\">item name</span></p>
                    </div> ";
        $featured_styles = $stmt->get_result();
    } 
    else {
        include ('get_featured_item.php');
    }
?>