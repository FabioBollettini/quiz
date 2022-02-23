<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="container col-md-8 offset-md-2 mt-5 mb-3">
    <?php
        
        ini_set('display_errors','1');

        error_reporting(E_ALL);

        require_once "config.php";
        $id = $_GET['id'];

        $sql = "SELECT * FROM questions WHERE id = '$id'";
        if($result = mysqli_query($conn, $sql)){
            $row = mysqli_fetch_array($result);
            $solution = $row['solution'];
            $answers = json_decode($row['answers']);
            $count = count($answers);
        
            echo "<div class='mt-5 mb-3 clearfix'>";
                echo "<h2 class='pull-left'>" . $row['question'] . "</h2>";
                echo '<a class="btn btn-warning ml-2 pull-left" href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                echo '<a class="btn btn-danger ml-2 pull-left" href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';       
            echo "</div>";
            echo "<ul class='mt-5'>"; 
                for($i = 0; $i < $count; $i++) {
                    echo "<li>" . $answers[$i] . "</li>";
                }
            echo "</ul>";

            echo "<p class='alert alert-success mt-5'><strong>" . "Soluzione: " . $answers[$solution - 1] . "</strong></p>";

        }
    ?>
    <a class="btn btn-dark mt-3" href="panelPage.php">< Indietro</a>
    </div>


</body>
</html>