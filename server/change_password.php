<?php
    include 'connection.php';

    if(isset($_POST['new_password']) && isset($_POST['user_id'])){
        $new_password = hash('sha256', $_POST['new_password']);
        $user_id = $_POST['user_id'];

        $stmt = $conn->prepare("UPDATE user SET password = ? WHERE user_id = ?");
        $stmt->bind_param('ss', $new_password, $user_id);
        if ($stmt->execute()) {
            echo true;
        } else {
            echo false;  // Handle the error case
        }
        die();
    }

?>

