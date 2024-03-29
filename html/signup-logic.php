<?php 
  include "db_conn.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])
    && isset($_POST['email']) && isset($_POST['confirm_email'])
    && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {

    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = $_POST['role'];
    $email = $_POST['email'];
    $confirm_email = $_POST['confirm_email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($firstname)) {
        header("Location: signup.php?error=First Name is required");
    } else if (empty($lastname)) {
        header("Location: signup.php?error=Last Name is required");
    } else if (empty($role)) {
        header("Location: signup.php?error=Role is required");
    } else if (empty($email)) {
        header("Location: signup.php?error=Email is required");
    } else if (empty($confirm_email)) {
        header("Location: signup.php?error=Confirm email is required");
    } else if ($email !== $confirm_email) {
        header("Location: signup.php?error=Emails do not match");
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: signup.php?error=Invalid email format");
    } else if (empty($username)) {
        header("Location: signup.php?error=Username is required");
    } else if (empty($password)) {
        header("Location: signup.php?error=Password is required");
    } else if (empty($confirm_password)) {
        header("Location: signup.php?error=Confirm password is required");
    } else if ($password !== $confirm_password) {
        header("Location: signup.php?error=Passwords do not match");
    } else {
        $salt = bin2hex(random_bytes(16));

    // Hash the password with the salt
    $hashed_password = hash('sha256', $salt . $password);

    $sql = "INSERT INTO users (firstname, lastname, role, email, username, salt, hashed_password) 
            VALUES ('$firstname', '$lastname', '$role', '$email', '$username', '$salt', '$hashed_password')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            echo "Success";
            header("Location: login.php");
        }
    }
} else {
    header("Location: olti.php");
}
?>