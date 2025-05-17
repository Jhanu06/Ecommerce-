
<?php
session_start(); // Start the session
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Jhanila Store</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Dancing+Script:wght@700&display=swap">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        /* Body Styling */
        body {
            background: linear-gradient(135deg, #74ebd5, #acb6e5); /* Updated background gradient */
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Roboto', sans-serif;
            color: #333;
        }

        /* Container for the Dashboard */
        .container {
            width: 100%;
            max-width: 900px;
            background: #fff;
            padding: 30px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            border-radius: 15px;
            text-align: center;
            transition: transform 0.3s ease-in-out;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: #232f3e;
            margin-bottom: 30px;
            font-weight: 700;
        }

        /* Navigation Styling */
        nav {
            display: flex;
            justify-content: space-evenly;
            gap: 20px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        nav a {
            text-decoration: none;
            padding: 12px 25px;
            background-color: #232f3e;
            color: white;
            font-size: 18px;
            font-weight: 500;
            border-radius: 8px;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        nav a:hover {
            background-color: #ff9900;
            transform: translateY(-2px);
        }

        .logout {
            background-color: #f44336;
        }

        .logout:hover {
            background-color: #e53935;
            transform: translateY(-2px);
        }

        /* Footer Styling */
        footer {
            text-align: center;
            margin-top: 40px;
            font-size: 14px;
            color: #777;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }

            nav a {
                font-size: 16px;
                padding: 10px 20px;
                margin: 10px 0;
            }
        }

        @media (max-width: 480px) {
            h2 {
                font-size: 2rem;
                margin-bottom: 20px;
            }

            nav a {
                font-size: 14px;
                padding: 8px 15px;
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Dashboard</h2>
        <nav>
            <a href="add_product.php">Add Product</a>
            <a href="manage_products.php">Manage Products</a>
            <a href="logout.php" class="logout">Logout</a>
        </nav>
    </div>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> Jhanila Store. All rights reserved.</p>
    </footer>
</body>
</html>
