<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
    <title>Products</title>
</head>
<body>
    <h2>Products</h2>
    <a href="cart.php">View Cart</a>
    <ul>
        <?php while ($product = $result->fetch_assoc()) { ?>
            <li>
                <?php echo $product['name']; ?> - $<?php echo $product['price']; ?>
                <form action="add_to_cart.php" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                    <button type="submit">Add to Cart</button>
                </form>
            </li>
        <?php } ?>
    </ul>
</body>
</html>
