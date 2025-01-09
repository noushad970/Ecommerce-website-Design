<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "You must be logged in to add to cart.";
    exit;
}

$user_id = $_SESSION['user_id'];
$product_id = $_POST['product_id'];

$sql = "INSERT INTO cart_items (user_id, product_id) VALUES ('$user_id', '$product_id')";
if ($conn->query($sql) === TRUE) {
    echo "Product added to cart. <a href='cart.php'>View Cart</a>";
} else {
    echo "Error: " . $conn->error;
}
?>
