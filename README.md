# 🛒 E-commerce Website Project

This is a simple PHP-based e-commerce platform designed for customers and admins to manage shopping and product listings efficiently.

---

## 🔹 1. User Section

### 1.1. User Registration
- Page: `register.php`
- Users can create an account using name, email, and password.

### 1.2. User Login & Logout
- Login: `login.php` — Validates email and password.
- Logout: `logout.php` — Ends the session securely.

### 1.3. Viewing Products
- Page: `index.php`
- Shows product name, price, description, and image.

### 1.4. Adding to Cart
- Users click "Add to Cart" on `index.php` to store items in their cart.

### 1.5. Cart Management
- Page: `cart.php`
- Users can view, update, or remove items.
- Displays total cost.

---

## 🔹 2. Admin Section

### 2.1. Admin Login & Logout
- Login: `admin/login.php`
- Logout: `admin/logout.php`

### 2.2. Dashboard
- Page: `admin/dashboard.php`
- Provides controls for managing products.

### 2.3. Add Products
- Page: `admin/add_product.php`
- Admins can add product details and upload images.

### 2.4. Manage Products
- Page: `admin/manage_products.php`
- View products in a table format.
- Options: Edit and Delete.

---

## 🔹 3. Database Structure

### 3.1. users Table
- Stores: username, email, hashed password, and role (`user` or `admin`).

### 3.2. products Table
- Stores: name, price, description, image filename.

### 3.3. cart Table
- Links users with products.
- Stores: product ID, user ID, and quantity.

---

## 🔹 4. Website Flow

### 4.1. User Registration
- Input is validated.
- Password is hashed using `password_hash()`.

### 4.2. User Login
- Checks credentials and starts a session (`$_SESSION['user_id']`).

### 4.3. Adding to Cart
- Saves product and quantity in `cart` table tied to the user.

### 4.4. Admin Adds Product
- Uploads image and saves product info to `products` table.

### 4.5. Admin Deletes Product
- Removes product from the database.
- It disappears from the homepage.

---

## 🔹 5. Security Measures

### 5.1. Passwords
- Hashed with `password_hash()` before storing.

### 5.2. Session Management
- Users: `$_SESSION['user_id']`
- Admins: `$_SESSION['admin_id']`

### 5.3. Admin Access Control
- Only users with `role = admin` can access admin routes.

---

## 🔧 Tech Stack

| Layer     | Tech                        |
|-----------|-----------------------------|
| Backend   | PHP                         |
| Database  | MySQL                       |
| Server    | Apache (via XAMPP)          |

---

## 🚀 How to Run Locally

1. Install [XAMPP](https://www.apachefriends.org/index.html).
2. Copy the project folder into the `htdocs` directory (inside XAMPP folder).
3. Start Apache and MySQL via the XAMPP control panel.
4. Go to `http://localhost/phpmyadmin` and create a database.
5. Import the provided SQL file if available.
6. Visit the website:
