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
// if (!isset($_SESSION['user_id'])) {
//     header("Location: login.html");
//     exit;
// }

$user_id = $_SESSION['user_id'];

$sql = "SELECT c.id AS cart_id, p.name, p.price 
        FROM cart_items c 
        JOIN products p ON c.product_id = p.id 
        WHERE c.user_id = ?";
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
    <title>View Cart</title>
</head>
<body>
    <div class="container">
        <nav>
            <a href="index.html">Home</a>
            <a href="products.php">Products</a>
            <a href="order_history.php">Order History</a>
            <a href="logout.php">Logout</a>
        </nav>
        <h2>Your Cart</h2>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($cart = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($cart['name']); ?></td>
                            <td>$<?php echo htmlspecialchars($cart['price']); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <form action="complete_order.php" method="post">
                <button type="submit">Complete Order</button>
            </form>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</body>
</html>
