<?php
$email = htmlspecialchars($_GET['email'] ?? '');
?>
<!DOCTYPE html>
<html>
<head><title>Reset Password</title></head>
<link rel="stylesheet" href="styles.css">
<body>
  <form action="reset_process.php" method="POST">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <label for="new_password">New Password: </label><br>
    <input name="new_password" type="password" placeholder="New Password" required><br><br>
    <label for="confirm_password">Confirm Password: </label><br>
    <input name="confirm_password" type="password" placeholder="Confirm Password" required><br><br>
    <input type="submit" value="Submit">
  </form>
</body>
</html>

