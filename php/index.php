<?php
include 'config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "<h1>Vulnerable PHP Site</h1>";

// Função de SQL Injection e XSS (já existente)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['username'])) {
    $username = $_POST['username'];
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        echo "<p>Welcome, " . $username . "</p>";
    } else {
        echo "<p>User not found</p>";
    }

    echo "<p>Search term: " . $_POST['username'] . "</p>";
}

// Função de Command Injection
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['ip_address'])) {
    $ip_address = $_POST['ip_address'];
    
    // Executa o comando ping sem sanitizar a entrada
    $output = shell_exec("ping -c 4 " . $ip_address);

    echo "<pre>$output</pre>";
}
?>

<!-- Formulário para SQL Injection e XSS -->
<form method="POST">
    Username: <input type="text" name="username">
    <input type="submit" value="Login">
</form>

<!-- Formulário para Command Injection -->
<h2>Ping Host</h2>
<form method="POST">
    IP Address: <input type="text" name="ip_address">
    <input type="submit" value="Ping">
</form>

<a href="upload.php">Upload a file</a>

