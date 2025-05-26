<?php
session_start();
$name = isset($_SESSION['user']['name']) ? $_SESSION['user']['name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>

<body>
    <h1>Welcome <?php echo ($name); ?></h1>

    <?php if ($name !== 'Guest'): ?>
        <a href="QSN4_logout.php">Logout</a>
    <?php endif; ?>
</body>

</html>