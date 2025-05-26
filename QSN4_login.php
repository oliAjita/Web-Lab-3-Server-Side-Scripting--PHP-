<?php
require_once("./db_connection.php");
session_start();

// If session already exists, redirect to dashboard
if (isset($_SESSION['user'])) {
    header('location:dashboard.php');
    exit();
}

// If cookie is set, auto-login and store into session
if (isset($_COOKIE['email']) && isset($_COOKIE['name'])) {
    $_SESSION['user']['email'] = $_COOKIE['email'];
    $_SESSION['user']['name'] = $_COOKIE['name'];
    header('location:dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $err = [];
    if (!empty(trim($_POST['email']))) {
        $email = trim($_POST['email']);
    } else {
        $err['email'] = 'Enter email';
    }

    if (!empty(trim($_POST['password']))) {
        $password = trim($_POST['password']);
    } else {
        $err['password'] = 'Enter password';
    }

    if (count($err) == 0) {
        try {
            $sql = "SELECT * FROM registrations WHERE email='$email' AND password='$password'";
            $result = $connection->query($sql);
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                $_SESSION['user'] = $user;

                if (isset($_POST['remember'])) {
                    $timestamp = time() + (7 * 24 * 60 * 60); // 7 days
                    setcookie('email', $user['email'], $timestamp);
                    setcookie('name', $user['name'], $timestamp);
                }

                header('location:dashboard.php');
                exit();
            } else {
                $err['validation'] = 'Invalid email or password.';
            }
        } catch (Exception $ex) {
            die("Connection error: " . $ex->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login Form</title>
</head>

<body>
    <h1>Login Form</h1>
    <?php echo isset($err['validation']) ? "<p style='color:red;'>{$err['validation']}</p>" : ''; ?>

    <form action="" method="post">
        <label>Email</label>
        <input type="text" name="email" value="<?php echo isset($email) ? $email : ''; ?>">
        <?php echo isset($err['email']) ? "<p style='color:red;'>{$err['email']}</p>" : ''; ?><br>

        <label>Password</label>
        <input type="password" name="password">
        <?php echo isset($err['password']) ? "<p style='color:red;'>{$err['password']}</p>" : ''; ?><br>

        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember me for 7 days</label><br>

        <input type="submit" name="login" value="Login">
    </form>
</body>

</html>