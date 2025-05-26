<?php
require_once("./db_connection.php");
$book = [];
$success = '';
$err = '';

// Fetch the book by ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM books WHERE id = $id";
    $result = $connection->query($sql);
    if ($result->num_rows == 1) {
        $book = $result->fetch_assoc();
    } else {
        $err = "Book not found.";
    }
}

// Update book on form submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $author = $_POST['author'];
    $edition = $_POST['edition'];
    $no_of_page = $_POST['no_of_page'];
    $price = $_POST['price'];
    $publish_date = $_POST['publish_date'];
    $isbn = $_POST['isbn'];

    $sql = "UPDATE books SET 
                title='$title',
                publisher='$publisher',
                author='$author',
                edition='$edition',
                no_of_page=$no_of_page,
                price=$price,
                publish_date='$publish_date',
                isbn='$isbn'
            WHERE id = $id";

    if ($connection->query($sql)) {
        $success = "Book updated successfully.";
    } else {
        $err = "Error updating book: " . $connection->error;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Book</title>
</head>

<body>
    <h2>Edit Book</h2>
    <?php if ($err)
        echo "<p style='color:red;'>$err</p>"; ?>
    <?php if ($success)
        echo "<p style='color:green;'>$success</p>"; ?>

    <?php if (!empty($book)): ?>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?= $book['id'] ?>">
            <label>Title: <input type="text" name="title" value="<?= $book['title'] ?>"></label><br>
            <label>Publisher: <input type="text" name="publisher" value="<?= $book['publisher'] ?>"></label><br>
            <label>Author: <input type="text" name="author" value="<?= $book['author'] ?>"></label><br>
            <label>Edition: <input type="text" name="edition" value="<?= $book['edition'] ?>"></label><br>
            <label>No of Pages: <input type="number" name="no_of_page" value="<?= $book['no_of_page'] ?>"></label><br>
            <label>Price: <input type="number" name="price" value="<?= $book['price'] ?>" step="0.01"></label><br>
            <label>Publish Date: <input type="date" name="publish_date" value="<?= $book['publish_date'] ?>"></label><br>
            <label>ISBN: <input type="text" name="isbn" value="<?= $book['isbn'] ?>"></label><br><br>
            <input type="submit" value="Update Book">
        </form>
    <?php endif; ?>
</body>

</html>