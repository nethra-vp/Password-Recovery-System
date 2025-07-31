<?php
session_start();
$con = new mysqli("localhost", "root", "", "database");
if ($con->connect_error) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    exit();
}

    $email = $_POST['email'];
    $password = $_POST['pwd'];

    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'] ?? $user['email'];
        echo "Login successful.";
    } else {
        echo "Invalid email or password.";
    }
?>
