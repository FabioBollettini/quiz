
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
    <div class="wrapper" style="width: 80vw; margin: auto;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 table-responsive-sm">
                    <a class='btn btn-outline-primary btn-lg mt-5' href='../'><-- Vai al quiz</a>
                    <div class="mt-2 mb-3 clearfix">
                        <h2 class="pull-left">Quiz details</h2>
                        <a href="add.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add new question</a>
                    </div>
                    <?php

                    require_once "config.php";
                    ini_set('display_errors','1');

                    error_reporting(E_ALL);
                    
                    $sql = "SELECT * FROM questions";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-bordered table-striped table-hover ">';
                                echo "<thead class='thead-dark'>";
                                    echo "<tr>";
                                        echo "<th scope='col'>Question</th>";
                                        // echo "<th scope='col'>Answer 1</th>";
                                        // echo "<th scope='col'>Answer 2</th>";
                                        // echo "<th scope='col'>Answer 3</th>";
                                        echo "<th scope='col'>Solution</th>";
                                        echo "<th scope='col'>Actions</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    $solution = $row['solution'];
                                    $answers = json_decode($row['answers']);
                                    $count = count($answers);

                                    echo "<tr>";
                                        echo "<th scope='row'>" . $row['question'] . "</th>";
 
                                            // for($i = 0; $i < $count ; $i++) {
                                            //     $separatedAns[$i];
                                            // }
                                            echo "<td>" . $answers[$solution - 1] . "</td>";
                                            echo "<td>";
                                                echo '<a class="btn btn-primary" href="read.php?id='. $row['id'] .'" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                                echo '<a class="btn btn-warning" href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                echo '<a class="btn btn-danger" href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                            echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                        } else{
                            echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
                        }
                    } else{
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                    ?>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>