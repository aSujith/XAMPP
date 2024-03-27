<?php
// Database configuration
$host = 'localhost'; // or the IP of your database server
$dbname = 'user_registration';
$username = 'root'; // default XAMPP username
$password = ''; // default XAMPP password is empty

// Create database connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize input
    $user = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    // Password hashing for security
    // $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);

    // Prepare SQL and bind parameters
    $sql = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $sql->bind_param("sss", $user, $email, $pwd);

    // Execute the query
    if ($sql->execute()) {
        echo "Registration successful!";
    } else {
        echo "Error: " . $sql->error;
    }

    // Close statement and connection
    $sql->close();
    $conn->close();
}
?>
