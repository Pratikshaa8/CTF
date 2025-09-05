<?php
// Challenge: Secrets of the Vault
// Vulnerable to SQL Injection

// Step 1: Connect to MySQL server (no database yet)
$mysqli = new mysqli("localhost", "root", "");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Step 2: Create database if not exists
$mysqli->query("CREATE DATABASE IF NOT EXISTS ctfdb");

// Step 3: Select the database
$mysqli->select_db("ctfdb");

// Step 4: Create table if not exists
$mysqli->query("CREATE TABLE IF NOT EXISTS users (username VARCHAR(50), password VARCHAR(50))");

// Step 5: Insert admin user if not exists
$mysqli->query("INSERT INTO users (username, password)
                SELECT 'admin', 'admin123'
                FROM DUAL
                WHERE NOT EXISTS (SELECT 1 FROM users WHERE username='admin')");

// Step 6: Handle login form
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // ❌ VULNERABLE QUERY
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result = $mysqli->query($query);

    if ($result && $result->num_rows > 0) {
        echo "<h2>✅ Welcome, $username!</h2>";
        echo "<p>Here is your flag:</p>";
        echo "<b>H4CK3RF0RGE{sql_injection_unlocked}</b>";
    } else {
        echo "<p>❌ Invalid credentials.</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head><title>Vault Login</title></head>
<body>
    <h2>Vault Login</h2>
    <form method="POST">
        <input type="text" name="username" placeholder="Username"><br><br>
        <input type="password" name="password" placeholder="Password"><br><br>
        <button type="submit">Login</button>
    </form>
</body>
</html>
