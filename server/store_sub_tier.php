<?php
    include 'connection.php';

    session_start();

    if (isset($_POST['plan_tier'])) {
        $_SESSION['selected_tier'] = $_POST['plan_tier'];

        // create a query to get the details of the selected tier
        $stmt = $conn->prepare('SELECT * FROM subscription_plan WHERE plan_tier = ? LIMIT 1');
        $stmt->bind_param('s', $_SESSION['selected_tier']);
        $stmt->execute();

        // get the result
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        if ($row) {
            // store the result in the session
            $_SESSION['selected_tier'] = $row['plan_tier'];
            $_SESSION['plan_tier_description'] = $row['plan_tier_description'];

            echo 'Session variables set successfully';
        } else {
            echo 'Error: no matching row found';
        }

        echo "Session variable 'plan_tier' is set.";
    } else {
        echo "No tier selected.";
    }
?>