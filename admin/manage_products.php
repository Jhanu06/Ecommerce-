<?php
// Start the session and check if the admin is logged in
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

// Include the database connection
include '../includes/db.php';

// Fetch all products from the database
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Jhanila Store</title>
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
    font-family: 'Roboto', sans-serif;
    background: #f0f8ff; /* Light Blue background */
    padding: 20px;
    color: #333;
}

        /* Container Styling */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-family: 'Dancing Script', cursive;
            font-size: 2.5rem;
            color: #232f3e;
            text-align: center;
            margin-bottom: 30px;
        }

        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #232f3e;
            color: white;
            font-weight: 600;
        }

        td img {
            width: 50px;
            height: auto;
            border-radius: 6px;
        }

        /* Actions Styling */
        .actions a {
            margin: 0 10px;
            padding: 8px 12px;
            color: #232f3e;
            text-decoration: none;
            border: 1px solid #232f3e;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .actions a:hover {
            background-color: #ff9900;
            color: white;
            border-color: #ff9900;
        }

        /* Back Button Styling */
        .btn-back {
            display: block;
            width: 200px;
            margin: 30px auto;
            padding: 12px;
            background-color: #232f3e;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-size: 1.1em;
            transition: all 0.3s ease;
        }

        .btn-back:hover {
            background-color: #ff9900;
            transform: translateY(-2px);
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }

            h2 {
                font-size: 2rem;
            }

            table {
                font-size: 14px;
            }

            .actions a {
                padding: 6px 10px;
                font-size: 14px;
            }

            .btn-back {
                width: 100%;
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            th, td {
                padding: 8px;
            }

            td img {
                width: 40px;
            }

            .actions a {
                margin: 0 5px;
                padding: 4px 8px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Manage Products</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($products as $product) : ?>
            <tr>
                <td><?= $product['id']; ?></td>
                <td><?= htmlspecialchars($product['name']); ?></td>
                <td>$<?= number_format($product['price'], 2); ?></td>
                <td><?= htmlspecialchars($product['description']); ?></td>
                <td><img src="../images/<?= htmlspecialchars($product['image']); ?>" alt="Product Image"></td>
                <td class="actions">
                    <a href="edit_product.php?id=<?= $product['id']; ?>">Edit</a>
                    <a href="delete_product.php?id=<?= $product['id']; ?>" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
    <a href="dashboard.php" class="btn-back">Back to Dashboard</a>
</div>

</body>
</html>