<?php

    include("conn.php");

    $id=$_POST["id"];
    $sql = "SELECT * FROM secundarias WHERE id = '".$id."'";
    $query = mysqli_query($conn, $sql);

    $row = mysqli_fetch_array($query);

    $sqlLoc = "SELECT * FROM localidad WHERE id = '".$row["id_localidad"]."'";
    $queryLoc = mysqli_query($conn, $sqlLoc);

    $rowLoc = mysqli_fetch_array($queryLoc);

?>
<html>
    <!DOCTYPE html>
    <head>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="style.css"></link>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    </head>

<body>


<div class="page-heading mt-5">
                    <h2>Inscripción Secundaria 2023</h2>
                    <h5>Ingrese el DNI <b>SIN PUNTOS</b> del alumno para continuar la inscripción</h5>
                </div>

                <div class="page-content">
                    <section class="row">
                        <div class="col-lg-12 col-12">
                            <div id="auth-left">
                                <h5 class="card-title"><?php echo $row["nombre"] ?></h5>
                                <h6><?php echo $rowLoc["localidad"] ?></h6>
                                    <div class="form-group position-relative has-icon-left mb-4 mt-2">
                                        <label for="basicInput">Ingrese el DNI, SIN PUNTOS, del alumno</label>
                                        <input type="number" class="form-control form-control-xl  mt-2" id="dni" name="dni" placeholder="DNI del alumno" required="">
                                    </div>
                                    <div>
                                        <form id="formulario" name="formulario" method="POST" action="dni_alumno.php">
                                            <input type="hidden" id="dni_e" name="dni_e">
                                            <input type="hidden" id="id" name="id" value="<?php echo $id ?>">
                                        </form>
                                    </div>
                                    
                                    <div class="col-sm-12 d-flex justify-content-end">
                                        <button type="submit" id="btn_comenzar" class="btn btn-primary me-1 mb-1">Comenzar!</button>
                                    </div>
                            </div>
                        </div>                        
                            
                        

                                                


                    </section>
                    
                </div>
    <script language="javascript">

        $(document).ready(function(){

        $('#btn_comenzar').click(function(){
            let dni = $('#dni').val();
            $.post("comprueba.php",{dni:dni},function(data){
                if(data == 1){
                    var formulario = document.getElementById("formulario");
                    document.getElementById('dni_e').value = dni;
                    formulario.submit();
                } else {
                    swal.fire({
                        title: "El alumno/a se encuentra inscripto",
                        icon: "error",
                        confirmButtonText: 'Aceptar'
                    })                 

                }
            })
        });

        });


    </script>
</body>