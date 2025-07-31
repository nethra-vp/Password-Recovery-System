<?php
$con = new mysqli("localhost", "root", "", "database");
if ($con->connect_error) {
    echo "Failed to connect to MySQL: ".mysqli_connect_error();
    exit();
}

    $email = $_POST['email'];
    $secret_key = $_POST['secret_key'];

    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($secret_key, $user['secret_key'])) {
        header("Location: reset_pwd.php?email=" . urlencode($email));
        exit();
    } else {
        echo "Invalid email or secret key.";
    }
?>
