<?php
$principal = $rate = $time = $result = '';
$err = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Input validation
    if (isset($_POST['principal']) && !empty($_POST['principal']) && is_numeric($_POST['principal'])) {
        $principal = (float) $_POST['principal'];
    } else {
        $err['principal'] = "Enter valid principal amount";
    }

    if (isset($_POST['rate']) && !empty($_POST['rate']) && is_numeric($_POST['rate'])) {
        $rate = (float) $_POST['rate'];
    } else {
        $err['rate'] = "Enter valid rate";
    }

    if (isset($_POST['time']) && !empty($_POST['time']) && is_numeric($_POST['time'])) {
        $time = (float) $_POST['time'];
    } else {
        $err['time'] = "Enter valid time period";
    }

    // Perform calculation if no errors
    if (empty($err)) {
        if (isset($_POST['simple'])) {
            $result = "Simple Interest = " . ($principal * $rate * $time) / 100;
        } elseif (isset($_POST['compound'])) {
            $amount = $principal * pow((1 + $rate / 100), $time);
            $ci = $amount - $principal;
            $result = "Compound Interest = " . round($ci, 2);
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Interest Calculator</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h2>Interest Calculator</h2>
    <form method="post">
        <label>Principal:</label>
        <input type="text" name="principal" value="<?php echo ($principal); ?>">
        <span class="error"><?php echo $err['principal'] ?? ''; ?></span>
        <br><br>

        <label>Rate (%):</label>
        <input type="text" name="rate" value="<?php echo ($rate); ?>">
        <span class="error"><?php echo $err['rate'] ?? ''; ?></span>
        <br><br>

        <label>Time (years):</label>
        <input type="text" name="time" value="<?php echo ($time); ?>">
        <span class="error"><?php echo $err['time'] ?? ''; ?></span>
        <br><br>

        <button type="submit" name="simple">Calculate Simple Interest</button>
        <button type="submit" name="compound">Calculate Compound Interest</button>
    </form>

    <h3 style="color:green;"><?php echo $result; ?></h3>
</body>

</html>