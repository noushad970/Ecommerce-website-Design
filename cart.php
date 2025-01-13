<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$sql = "SELECT products.name, products.price FROM cart_items 
        JOIN products ON cart_items.product_id = products.id 
        WHERE cart_items.user_id = '$user_id'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Cart</title>
</head>
<body>
    <h2>Your Cart</h2>
    <ul>
        <?php while ($item = $result->fetch_assoc()) { ?>
            <li><?php echo $item['name']; ?> - $<?php echo $item['price']; ?></li>
        <?php } ?>
    </ul>
    <form action="complete_order.php" method="POST">
        <button type="submit">Complete Order</button>
    </form>
    <nav>
    <a href="index.html">Home</a>
    <a href="view_cart.php">View Cart</a>
    <a href="order_history.php">Order History</a>
    
</nav>

</body>
</html>
