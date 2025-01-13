<?php
session_start();
include 'db.php';

// Check if the user is logged in
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

$sql = "SELECT o.id AS order_id, o.order_date, p.name AS product_name, p.price 
        FROM orders o 
        JOIN order_items oi ON o.id = oi.order_id 
        JOIN products p ON oi.product_id = p.id 
        WHERE o.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Order History</title>
</head>
<body>
    <div class="container">
        <nav>
            <a href="index.html">Home</a>
            <a href="products.php">Products</a>
            <a href="logout.php">Logout</a>
        </nav>
        <h2>Your Order History</h2>
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($order = $result->fetch_assoc()): ?>
                    <li>
                        <strong>Order ID:</strong> <?php echo $order['order_id']; ?><br>
                        <strong>Product:</strong> <?php echo htmlspecialchars($order['product_name']); ?><br>
                        <strong>Price:</strong> $<?php echo htmlspecialchars($order['price']); ?><br>
                        <strong>Date:</strong> <?php echo htmlspecialchars($order['order_date']); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>You have no completed orders.</p>
        <?php endif; ?>
    </div>
</body>
</html>
