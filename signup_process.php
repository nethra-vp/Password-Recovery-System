<?php
$con = new mysqli("localhost", "root", "", "database");
if ($con->connect_error) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    exit();
}

    $name = $_POST['name'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $confirm_pwd = $_POST['confirm_pwd'];
    $secret_key = $_POST['secret_key'];

    if ($pwd !== $confirm_pwd) {
        echo "Passwords do not match.";
        exit();
    }

    $pwd_hash = password_hash($pwd, PASSWORD_DEFAULT);
    $secret_hash = password_hash($secret_key, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password, confirm_password, secret_key) VALUES (?, ?, ?, ?, ?)";
    $stmt = $con->prepare($sql);
    $stmt->bind_param("sssss", $name, $email, $pwd_hash, $pwd_hash, $secret_hash);

    if ($stmt->execute()) {
        echo "Signup successful!";
        header("Location: login.html");
        exit();
    } else {
        echo "Insertion Failed: " . $stmt->error;
    }
?>

