<?php
$con = new mysqli("localhost", "root", "", "database");
if ($con->connect_error) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    exit();
}

    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm = $_POST['confirm_password'];

    if ($new_password !== $confirm) {
        echo "Passwords do not match.";
        exit();
    }

    $password_hash = password_hash($new_password, PASSWORD_DEFAULT);

    $stmt = $con->prepare("UPDATE users SET password = ? WHERE email = ?");
    $stmt->bind_param("ss", $password_hash, $email);
    
    if ($stmt->execute()) {
        echo "Password reset successful. <a href='login.html'>Login here</a>";
    } else {
        echo "Reset failed: " . $stmt->error;
    }
?>


