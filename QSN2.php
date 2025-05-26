<?php
error_reporting(E_ALL & E_STRICT);
ini_set('display_errors', '1');
require_once("./db_connection.php");

$name = $email = $phone = $password = $gender = $faculty = $term = '';
$err = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name']) && !empty($_POST['name']) && trim($_POST['name'])) {
        $name = $_POST['name'];
    } else {
        $err['name'] = 'Please enter your name';
    }

    if (isset($_POST['email']) && !empty($_POST['email']) && trim($_POST['email'])) {
        $email = $_POST['email'];
    } else {
        $err['email'] = 'Please enter your email';
    }

    if (isset($_POST['phone']) && !empty($_POST['phone']) && trim($_POST['phone'])) {
        $phone = $_POST['phone'];
    } else {
        $err['phone'] = 'Please enter your phone';
    }
    if (isset($_POST['password']) && !empty($_POST['password']) && trim($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $err['password'] = 'Please enter your password';
    }
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    } else {
        $err['gender'] = 'Please choose your gender';
    }

    if (isset($_POST['faculty']) & !empty($_POST['faculty'])) {
        $faculty = $_POST['faculty'];
    } else {
        $err['faculty'] = 'Please choose your faculty';
    }

    // If no errors, insert into DB
    if (count($err) == 0) {
        try {
            $sql = "INSERT INTO registrations (name, email, phone, password, gender, faculty) 
                    VALUES ('$name', '$email', '$phone', '$password', '$gender', '$faculty')";
            if ($connection->query($sql)) {
                echo "Insert success";
            } else {
                echo "Insert failed: " . $connection->error;
            }
        } catch (Exception $ex) {
            die("Error: " . $ex->getMessage());
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body>
    <h1>Form Validation</h1>
    <form action="" method="post">
        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo isset($name) ? $name : '' ?>" />
        <span class="error"><?php echo isset($err['name']) ? $err['name'] : ''; ?> </span>

        <br>
        <label for="email">Email</label>
        <input type="email" name="email" value="<?php echo isset($email) ? $email : '' ?>" />
        <span class="error"><?php echo isset($err['email']) ? $err['email'] : ''; ?> </span>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" />
        <span class="error"><?php echo isset($err['password']) ? $err['password'] : ''; ?> </span>

        <br>
        <label for="address">Phone</label>
        <input type="text" name="phone" value="<?php echo isset($phone) ? $phone : '' ?>" />
        <span class="error">
            <?php echo isset($err['phone']) ? $err['phone'] : ''; ?>
        </span>
        <br>
        <label for="gender">Gender</label>
        <input type="radio" name="gender" value="m" <?php echo (isset($gender) && $gender == 'm') ? 'checked' : '' ?> />Male
        <input type="radio" name="gender" value="f" <?php echo (isset($gender) && $gender == 'f') ? 'checked' : '' ?> />Female
        <input type="radio" name="gender" value="o" <?php echo (isset($gender) && $gender == 'o') ? 'checked' : '' ?> />Others
        <span class="error"><?php echo isset($err['gender']) ? $err['gender'] : ''; ?> </span>
        <br />
        <label>Faculty</label>
        <select name="faculty" id="faculty">
            <option value="">Select faculty</option>
            <option value="Humanities" <?php echo (isset($faculty) && $faculty == 'Humanities') ? 'selected' : '' ?>>
                Humanites
            </option>
            <option value="Science" <?php echo (isset($faculty) && $faculty == 'Science') ? 'selected' : '' ?>>Science
            </option>
            <option value="Management" <?php echo (isset($faculty) && $faculty == 'Management') ? 'selected' : '' ?>>
                Management
            </option>
        </select>
        <span class="error"><?php echo isset($err['faculty']) ? $err['faculty'] : ''; ?> </span>
        <br />
        <input type="submit" name="btnSubmit" />
    </form>
</body>

</html>