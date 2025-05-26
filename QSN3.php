<!-- for qsn no 3 and 4-->
<?php
if (isset($_COOKIE['email'])) {
    session_start();
    $_SESSION['user']['name'] = $_COOKIE['name'];
    $_SESSION['user']['email'] = $_COOKIE['email'];

    header('location:dashboard.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $err = [];
    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = 'Enter email';
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] = 'Enter password';
    }

    if (count($err) == 0) {
        // if ($email == 'basanta' && $password == 'basanta123') {
        //     header('location:10.dashboard.php');
        // } else {
        //     $err['validation'] = 'Invalid email/password';
        // }
        try {
            $connection = new mysqli('localhost', 'root', '', 'project');
            // echo "Input Email: $email <br>";
            // echo "Input Password: $password <br>";

            $sql = "select * from registrations where email='$email' and password='$password'";
            // $sql = "SELECT * FROM registrations WHERE BINARY email='oliajita@gmail.com' AND BINARY password='ajita';";
            //
            // echo "Query: $sql <br>";
            //
            $result = $connection->query($sql);
            // echo "Num Rows: " . $result->num_rows . "<br>";


            $result = $connection->query($sql);
            if ($result->num_rows == 1) {
                $user = $result->fetch_assoc();
                session_start();
                $_SESSION['user'] = $user;
                //check for remember me button
                if (isset($_POST['remember'])) {
                    $timestamp = time() + 7 * 24 * 60 * 60;
                    setcookie('email', $email, $timestamp);
                    setcookie('name', $user['name'], $timestamp);
                }
                header('location:dashboard.php');
                // echo 'Dashboard';
            } else {
                $err['validation'] = 'Invalid email/Password';
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
</head>

<body>
    <h1>Login Form</h1>
    <?php echo isset($err['validation']) ? $err['validation'] : ''; ?>

    <form action="" method="post">
        <label for="name">email</label>
        <input type="text" name="email" placeholder="Enter email" value="<?php echo isset($email) ? $email : ''; ?>" />
        <?php echo isset($err['email']) ? $err['email'] : ''; ?>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Enter password" />
        <?php echo isset($err['password']) ? $err['password'] : ''; ?>
        <br />
        <input type="checkbox" name="remember" value='remember' id="remember">Remember me for 7 days
        <br />
        <input type="submit" name="login" value="Login" />
    </form>
</body>

</html>