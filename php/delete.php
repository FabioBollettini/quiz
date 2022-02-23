<?php

include 'config.php';

$id = $_GET['id'];

$sql = "DELETE FROM questions WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    header("Location: http://192.168.1.61/php/panelPage.php");
} else {
    echo "Error deleting record: " . $conn->error;
}

?>