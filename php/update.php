<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <title>Aggiungi una domanda</title>
</head>
<body>
    <?php
            
        ini_set('display_errors','1');
        
        error_reporting(E_ALL);
        
        require_once "config.php";
        $id = $_GET['id'];
        
        $sql = "SELECT * FROM questions WHERE id = '$id'";
        if($result = mysqli_query($conn, $sql)){
            $row = mysqli_fetch_array($result);
            $answers = json_decode($row['answers']);
            $count = count($answers);
        }
    ?>

    <form class="container col-md-8 mt-5" action="updateToDB.php" method="POST">
        <div class="form-group">
            <label for="question">Domanda</label>
            <input class="form-control form-control-lg" name="question" type="text" value="<?php echo $row['question'];?>">
            <input name="id" type="hidden" value="<?php echo $row['id'];?>">
        </div>
        <div class="form-group">
            <label for="answers">Risposte</label>
            <?php
                for($i = 0; $i < $count; $i++) { ?>
                    <input class='form-control form-control-sm' name='answers[]' type='text' value="<?php echo $answers[$i] ?>">
                    <br>
                <?php }; ?>
        </div>

        <div class="form-group">
            <label for="solutions">Soluzione</label>
            <select class="form-control" name="solution">
                <?php 
                    for($i = 0; $i < $count; $i++) { ?>
                        <option value="<?php echo $i + 1 ?>">Risposta <?php echo $i + 1; ?></option>
                <?php }; ?>
            </select>

        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>

</body>
</html>
