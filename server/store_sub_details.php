<?php
session_start(); // Ensure session is started

// Include the database connection file
include 'connection.php';

if (isset($_POST['monthly_price']) && isset($_POST['plan_duration']) && isset($_POST['total_price'])) {
  $response = [
    'monthly_price' => $_POST['monthly_price'],
    'plan_duration' => $_POST['plan_duration'],
    'total_price' => $_POST['total_price'],
  ];
  echo json_encode($response); // Encode and echo JSON response
} else {
  echo json_encode(['error' => 'Price and duration not set']); // Send JSON error message
}
?>
