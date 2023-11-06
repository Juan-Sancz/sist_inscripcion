<?php
    include("php/conn.php");

     // Cambiar distrito
     $distrito = "123";
     //-----------------

    $sql = "SELECT * FROM secundarias WHERE distrito = '".$distrito."' AND abreviatura != 'JEFATURA'";
    $query = mysqli_query($conn,$sql);

?>

<html>
<!DOCTYPE html>

    <head>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>    
        <link rel="stylesheet" href="css/app.css"></link>
        <link rel="stylesheet" href="css/bootstrap.css"></link>
        <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscripción Secundaria 2023</title>

    </head>

    <body>

    <div class="error-page container">

        <div class="page-heading mt-5 text-center">
            <div class="col-sm-12 d-flex justify-content-end">
                <a href="../escuela/index.php"><button type="submit" id="btn_comenzar" class="btn btn-primary me-1 mb-1">Login</button></a>
            </div>
            <h2>Inscripción Secundaria La Costa 2023</h2>
            <h5>Seleccione una escuela para comenzar la inscripción</h5>
            <h6>La inscripción no garantiza vacante. En caso de superar el cupo en algunas escuelas, se realizará un sorteo.</h6>

        </div>


        <div class="page-content">
            <?php
            $count = 0; // Counter to track the number of cards in a row
            while ($row = mysqli_fetch_array($query)) {
                // Start a new row after every 2 cards
                if ($count % 2 == 0) {
                    echo '<section class="row">';
                }
            ?>
            <div class="col-12 col-lg-6">
                <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <div class="text-center">
                                <h4 class="card-tite"><?php echo $row["nombre"]?></h4>
                                <img src="imagenes/<?php echo $row["logo"] ?>" alt="...">
                                <p class="card-text"></p>
                                    <div class="icon dripicons-location">
                                        <?php echo $row["direccion"] ?>
                                    </div>
                                <p class="card-text">
                                <div class="icon dripicons-phone">
                                    <?php echo $row["telefono"] ?>
                                </div>
                                </p>
                                <form method="POST" action="php/escuelas.php">
                                    <input type="hidden" id="id" name="id" value="<?php echo $row["id"] ?>">
                                    <button type="submit" class="btn btn-primary">Inscribir</button>
                                </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php 
                // Close the row after every 2 cards
                if ($count % 2 == 1) {
                    echo '</section>';
                }
                $count++;
            }
            // Close any open row at the end if there are an odd number of cards
            if ($count % 2 == 1) {
                echo '</section';
            }
            ?>
    </div>

        <script src="js/app.js"></script>

    </body>

</html>