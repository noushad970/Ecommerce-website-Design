<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background: #f0f0f0;
        }
        .header {
            background: #007bff;
            color: #fff;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 {
            margin: 0;
        }
        .header .username {
            font-size: 16px;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Welcome</h1>
        <div class="username">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?>!</div>
    </div>
    <div class="content">
        <p>Welcome to your homepage.</p>
        <a href="logout.php">Logout</a>
    </div>
    <button id="products-page" onclick="window.location.href='products.html'">Products</button>

</body>
</html>
