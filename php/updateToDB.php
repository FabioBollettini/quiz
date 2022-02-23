<?php

include 'config.php';

$id = $_POST['id'];
$question = trim($_POST["question"]);
$answers = array_map('trim', $_POST["answers"]);
$solution = trim($_POST["solution"]);
$JSONanswers = json_encode($answers);

$sql = "UPDATE questions 
        SET question = '$question', answers = '$JSONanswers', solution = '$solution' 
        WHERE id = '$id'";

if ($conn->query($sql) === TRUE) {
    echo "Record updated successfully";
    header("Location: http://192.168.1.61/php/panelPage.php");
} else {
    echo "Error updating record: " . $conn->error;
}

?>