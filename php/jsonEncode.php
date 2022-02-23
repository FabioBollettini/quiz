<?php

header("Content-type:application/json;charset=utf-8");

ini_set('display_errors','1');

error_reporting(E_ALL);

include 'config.php';

$sql = "SELECT * FROM questions";

if($result = mysqli_query($conn, $sql)){
    $data = [];
    while($row = mysqli_fetch_assoc($result)){
        $answers = json_decode($row['answers']);
        $answersAssoc = ["risposte" => $answers];
        $merge = array_merge($row, $answersAssoc);
        array_splice($merge, 2, 1);
        $data[] = $merge;
    }
    echo json_encode($data);
}

?>