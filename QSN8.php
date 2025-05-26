<?php
// Connect to the database
require_once('db_connection.php');

// Retrieve data
$sql = "SELECT * FROM books";
$result = $connection->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Book List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 8px 12px;
            border: 1px solid #ccc;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Book Records</h2>
    <?php if ($result && $result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Publisher</th>
                <th>Author</th>
                <th>Edition</th>
                <th>Pages</th>
                <th>Price</th>
                <th>Publish Date</th>
                <th>ISBN</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= ($row['title']) ?></td>
                    <td><?= ($row['publisher']) ?></td>
                    <td><?= ($row['author']) ?></td>
                    <td><?= ($row['edition']) ?></td>
                    <td><?= $row['no_of_page'] ?></td>
                    <td><?= $row['price'] ?></td>
                    <td><?= $row['publish_date'] ?></td>
                    <td><?= ($row['isbn']) ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No books found.</p>
    <?php endif; ?>
</body>

</html>