
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <title>Aggiungi una domanda</title>
</head>
<body>
    
    <form class="container col-md-8 mt-5 mb-5" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
        <div class="form-group">
            <label for="question">Domanda</label>
            <input class="form-control form-control-lg" name="question" type="text" placeholder="Inserisci la domanda">
        </div>
        <div class="form-group">
            <label for="answers">Risposte</label>
            <div id="input-container">
                <div id="undeletable">
                    <input class='form-control form-control-sm' name='answers[]' type='text' placeholder="Inserisci una risposta">
                    <br>
                </div>
            </div>
            <a id="button" href="#">Aggiungi una risposta</a>
            <a class="btn btn-outline-danger" href="#" id="delete" data-toggle="tooltip">X</span></a>
        </div>

        <div class="form-group">
            <label for="solutions">Soluzione</label>
            <select id="select" class="form-control" name="solution">
                <option value="1">Risposta 1</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success" name="submit" value="submit">Submit</button>
    </form>

    <script>
        risposta = 1;
        
        // adding another form and select
        $("#button").click( function() {
            //$("#single-input").clone().appendTo("#input-container");
            risposta++;
            singleInput = "<div id='single-input'><input class='form-control form-control-sm' name='answers[]' type='text' placeholder='Inserisci una risposta'><br></div>"
            option = "<option id='option" + risposta + "' value=" + risposta + ">Risposta " + risposta + "</option>";
            $( "#select" ).append( option );
            $( "#input-container" ).append( singleInput );
        });

        // removing previous form and select
        $("#delete").click( function() {
            $("#single-input").remove();
            $( "#option" + risposta ).remove();
            risposta--;
            if (risposta < 1) {
                risposta = 1;
            }
        })
    </script>

    
    <?php
    // FORM HANDLING

    ini_set('display_errors','1');

    error_reporting(E_ALL);

    include "config.php";

    if(isset($_POST["submit"])) {
        $question = trim($_POST["question"]);
        $answers = array_map('trim', $_POST["answers"]);
        $solution = trim($_POST["solution"]);
        $JSONanswers = json_encode($answers);


        $sql = "INSERT INTO questions (question, answers, solution) VALUES ('$question', '$JSONanswers', '$solution')";
        if ($conn->query($sql) === TRUE) {
            echo "Record inserted successfully";
            header("Location: http://192.168.1.61/php/panelPage.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } 
    }
    ?>

</body>
</html>
