<?php

echo json_encode(array(
    'monthly_price' => isset($_SESSION['monthly_price']) ? $_SESSION['monthly_price'] : '0',
    'plan_duration' => isset($_SESSION['plan_duration']) ? $_SESSION['plan_duration'] : '0',
    'total_price' => isset($_SESSION['total_price']) ? $_SESSION['total_price'] : '0',
));
?>