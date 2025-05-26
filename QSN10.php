<?php
require_once("./db_connection.php");
$success = '';
$error = '';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // First, check if book exists
    $check = $connection->query("SELECT * FROM books WHERE id = $id");
    if ($check->num_rows == 1) {
        // Then delete
        $sql = "DELETE FROM books WHERE id = $id";
        if ($connection->query($sql)) {
            $success = "Book deleted successfully.";
        } else {
            $error = "Error deleting book: " . $connection->error;
        }
    } else {
        $error = "Book with ID $id not found.";
    }
} else {
    $error = "No ID provided.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Book</title>
</head>

<body>
    <h2>Delete Book</h2>
    <?php if ($success)
        echo "<p style='color:green;'>$success</p>"; ?>
    <?php if ($error)
        echo "<p style='color:red;'>$error</p>"; ?>
    <a href="QSN8.php">Back to Book List</a>
</body>

</html>