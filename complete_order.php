<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<div style='text-align: center; font-family: Arial, sans-serif;'>
    <h2 style='color: red;'>Login first to see details</h2>
    <a href='login.php'><button style='padding: 10px 20px; margin: 10px; background-color: #007BFF; color: white; border: none; border-radius: 5px; cursor: pointer;'>Login</button></a>
    <a href='signup.php'><button style='padding: 10px 20px; margin: 10px; background-color: #28A745; color: white; border: none; border-radius: 5px; cursor: pointer;'>Signup</button></a>
    <a href='index.php'><button style='padding: 10px 20px; margin: 10px; background-color: #17A2B8; color: white; border: none; border-radius: 5px; cursor: pointer;'>Homepage</button></a>
  </div>";
exit;
}

$user_id = $_SESSION['user_id'];

// Begin a transaction
$conn->begin_transaction();

try {
    // Create a new order
    $sql = "INSERT INTO orders (user_id) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    // Add items from the cart to the order_items table
    $sql = "SELECT product_id FROM cart_items WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $cart_items = $stmt->get_result();

    while ($item = $cart_items->fetch_assoc()) {
        $sql = "INSERT INTO order_items (order_id, product_id) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $order_id, $item['product_id']);
        $stmt->execute();
    }

    // Clear the cart
    $sql = "DELETE FROM cart_items WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    // Commit the transaction
    $conn->commit();
    echo "Order completed successfully!";
} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to complete the order: " . $e->getMessage();
}
?>
