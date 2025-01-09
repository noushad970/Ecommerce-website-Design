<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Create an order
$sql = "INSERT INTO orders (user_id) VALUES ('$user_id')";
if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id;

    // Move cart items to order_items
    $sql = "INSERT INTO order_items (order_id, product_id) 
            SELECT '$order_id', product_id FROM cart_items WHERE user_id = '$user_id'";
    $conn->query($sql);

    // Clear cart
    $sql = "DELETE FROM cart_items WHERE user_id = '$user_id'";
    $conn->query($sql);

    echo "Order completed!";
} else {
    echo "Error: " . $conn->error;
}
?>
