<?php
session_start();
include 'db.php';

// Assuming a logged-in user
if (!isset($_SESSION['user_id'])) {
    echo json_encode(["error" => "You must be logged in to view the cart."]);
    exit;
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT products.name, products.price 
        FROM cart_items 
        INNER JOIN products ON cart_items.product_id = products.id 
        WHERE cart_items.user_id = '$user_id'";

$result = $conn->query($sql);
$cart = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $cart[] = $row;
    }
}

echo json_encode($cart);
?>
