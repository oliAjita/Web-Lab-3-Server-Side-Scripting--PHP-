<?php
try {
    $connection = new mysqli('localhost', 'root', '', 'project');
    // echo 'DB CONNECTION SUCCESS';

} catch (Exception $ex) {
    die("Connection error: " . $ex->getMessage());
}

?>