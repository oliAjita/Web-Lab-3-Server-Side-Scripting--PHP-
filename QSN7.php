<?php
require_once("db_connection.php");

$title = $publisher = $author = $edition = $no_of_page = $price = $publish_date = $isbn = '';
$err = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Basic validation
    $title = trim($_POST['title']);
    $publisher = trim($_POST['publisher']);
    $author = trim($_POST['author']);
    $edition = trim($_POST['edition']);
    $no_of_page = $_POST['no_of_page'];
    $price = $_POST['price'];
    $publish_date = $_POST['publish_date'];
    $isbn = trim($_POST['isbn']);

    if ($title === '')
        $err['title'] = 'Title is required';


    if (count($err) === 0) {
        try {
            $sql = "INSERT INTO books (title, publisher, author, edition, no_of_page, price, publish_date, isbn) VALUES ($title, $publisher, $author, $edition, $no_of_page, $price, $publish_date, $isbn)";
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
<html>

<head>
    <title>Add Book</title>
</head>

<body>
    <h2>Add Book</h2>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" required><br>

        <label>Publisher:</label>
        <input type="text" name="publisher"><br>

        <label>Author:</label>
        <input type="text" name="author"><br>

        <label>Edition:</label>
        <input type="text" name="edition"><br>

        <label>No. of Pages:</label>
        <input type="number" name="no_of_page"><br>

        <label>Price:</label>
        <input type="text" name="price"><br>

        <label>Publish Date:</label>
        <input type="date" name="publish_date"><br>

        <label>ISBN:</label>
        <input type="text" name="isbn"><br><br>

        <input type="submit" value="Save Book">
    </form>
</body>

</html>