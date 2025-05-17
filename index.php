<?php
// Start the session and check if the user is logged in
session_start();

// Logout Logic - placed at the top of the script
if (isset($_POST['logout'])) {
    session_unset(); // Remove all session variables
    session_destroy(); // Destroy the session
    header("Location: pages/login.php"); // Redirect to login page
    exit(); // Make sure no further code is executed after redirection
}

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: pages/login.php");
    exit();
}

// Fetch products from the database
include 'includes/db.php';
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jhanila Store</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Roboto:wght@400;500;700&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        h1, h2 {
            font-family: 'Dancing Script', cursive;
            color: #ff6600;
            text-align: center;
        }
        h1 {
            font-size: 3rem;
            letter-spacing: 2px;
        }
        h2 {
            font-size: 2rem;
            margin: 20px 0;
        }
        header {
            background: #232f3e;
            color: white;
            padding: 15px 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }
        nav {
            display: flex;
            gap: 20px;
        }
        nav a, .logout-button {
            text-decoration: none;
            color: white;
            background: #ff9900;
            padding: 8px 16px;
            border-radius: 25px;
            transition: background 0.3s ease;
        }
        nav a:hover, .logout-button:hover {
            background: #ff6600;
        }
        .cart-link {
            display: flex;
            align-items: center;
        }
        .cart-icon {
            width: 25px;
            margin-right: 8px;
        }
        /* Main Content Styles */
        .main-container {
            max-width: 1200px;
            margin: 30px auto;
            padding: 20px;
            background: white;
            border-radius: 15px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        }
        .product-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 15px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            overflow: hidden;
        }
        .product-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.2);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 15px;
        }
        .product-title {
            font-size: 18px;
            font-weight: 500;
            margin: 10px 0;
        }
        .product-price {
            font-size: 16px;
            color: #ff6600;
            font-weight: 600;
        }
        .product-description {
            font-size: 14px;
            color: #777;
            margin-bottom: 15px;
        }
        .buy-button {
            background: #ff9900;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            font-weight: 600;
        }
        .buy-button:hover {
            background: #ff6600;
        }
        footer {
            background: #232f3e;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: 40px;
        }
        /* Creative Styling for "Welcome to Sujha Store" */
        .welcome-text {
            font-family: 'Pacifico', cursive;
            font-size: 4rem;
            background: linear-gradient(45deg, #6e45e2, #88d3ce, #ff7e5f, #feb47b);
            background-size: 300% 300%;
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: gradientAnimation 8s ease infinite;
        }
        @keyframes gradientAnimation {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }
        /* Media Queries for Responsiveness */
        @media (max-width: 768px) {
            .header-container {
                flex-direction: column;
                text-align: center;
            }
            .product-card {
                padding: 10px;
            }
            .product-title {
                font-size: 16px;
            }
            .product-price {
                font-size: 14px;
            }
            .welcome-text {
                font-size: 3rem;
            }
        }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <h1 class="welcome-text">Welcome to Sujha Store</h1>
            <nav>
                <a href="pages/login.php">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="pages/cart.php" class="cart-link">
                    <img src="images/cart.png" alt="Cart" class="cart-icon"> Cart
                </a>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="logout" class="logout-button">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    <div class="main-container">
        <main>
            <h2>All Products</h2>
            <div class="product-list">
                <?php if (empty($products)) : ?>
                    <p>No products available.</p>
                <?php else : ?>
                    <?php foreach ($products as $product) : ?>
                        <div class="product-card">
                            <h3 class="product-title"><?= htmlspecialchars($product['name']); ?></h3>
                            <?php if (!empty($product['image'])) : ?>
                                <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image">
                            <?php else : ?>
                                <img src="images/default.jpg" alt="Default Image" class="product-image">
                            <?php endif; ?>
                            <p class="product-price">$<?= number_format($product['price'], 2); ?></p>
                            <p class="product-description"><?= htmlspecialchars($product['description']); ?></p>
                            <form method="POST" action="pages/cart.php">
                                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                                <button type="submit" name="add_to_cart" class="buy-button">Add to Cart</button>
                            </form>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Jhanila Store. All rights reserved.</p>
    </footer>
</body>
</html>