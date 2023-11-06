<?php

    include("conn.php");

    $id=$_POST["id"];
    $dni_e=$_POST["dni_e"];

    if(isset($_POST["nombre_alum"])){
        $nombre_alum=$_POST["nombre_alum"];
    }
    if(isset($_POST["apellido_alum"])){
        $apellido_alum=$_POST["apellido_alum"];
    }
    if(isset($_POST["fecha_alum"])){
        $fecha_alum=$_POST["fecha_alum"];
    }

    if(isset($_POST["dni_t"])){
        $dni_t=$_POST["dni_t"];
    }
    if(isset($_POST["nombre_tutor"])){
        $nombre_tutor=$_POST["nombre_tutor"];
    }
    if(isset($_POST["apellido_tutor"])){
        $apellido_tutor=$_POST["apellido_tutor"];
    }
    if(isset($_POST["fecha_tutor"])){
        $fecha_tutor=$_POST["fecha_tutor"];
    }

    $sqlLoc="SELECT * FROM localidad WHERE 1";

    $sqlPrim="SELECT * FROM escuelas WHERE 1";

    $sqlSec="SELECT * FROM secundarias WHERE 1";

    $sqlSec2="SELECT * FROM secundarias WHERE 1";

    $sqlSelectSec="SELECT * FROM secundarias WHERE id = '".$id."'";


    $queryLoc = mysqli_query($conn,$sqlLoc);

    $queryPrim = mysqli_query($conn,$sqlPrim);

    $querySec = mysqli_query($conn,$sqlSec);

    $querySec2 = mysqli_query($conn,$sqlSec2);

    $querySelectSec = mysqli_query($conn,$sqlSelectSec);


    $rowSelectSec = mysqli_fetch_array($querySelectSec);

    
    $sqlSelectLoc = "SELECT * FROM localidad WHERE id = '".$rowSelectSec['id_localidad']."'";

    $querySelectLoc = mysqli_query($conn,$sqlSelectLoc);
    
    $rowSelectLoc = mysqli_fetch_array($querySelectLoc);

?>

<html>
    <!DOCTYPE html>

    <head>
    
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link rel="stylesheet" href="../css/app.css"></link>
        <link rel="stylesheet" href="../css/bootstrap.css"></link>
    

    </head>
    <body>
    <div class="page-heading">
            <br>
            <h2>Inscripción Secundaria 2023</h2>
            <h6><?php echo $rowSelectSec["nombre"]; ?> - <?php echo $rowSelectLoc["localidad"] ?></h6>                
        </div>  
    <form  enctype="multipart/form-data">
        

    <div class="page-content">
        <section id="basic-horizontal-layouts">
            <div class="row match-height">
                <div class="col-md-6 col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Datos del Alumno</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div>
                                            <input type="hidden" id="id" value="<?php echo $id ?>"></input>
                                        </div>
                                        <div class="col-md-4">
                                            <label>DNI</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="dni" value="<?php echo $dni_e ?>" class="form-control" name="dni" disabled="">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nombre</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <?php if(isset($nombre_alum)){ ?>      
                                                <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre" value="<?php echo $nombre_alum ?>" disabled>
                                            <?php }else{ ?>
                                            <input type="text" id="nombre" class="form-control" name="nombre" placeholder="Nombre">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Apellido</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <?php if(isset($apellido_alum)){ ?>      
                                                <input type="text" id="apellido" class="form-control" name="contact" placeholder="Apellido" value="<?php echo $apellido_alum ?>" disabled>
                                            <?php }else{ ?>
                                                <input type="text" id="apellido" class="form-control" name="contact" placeholder="Apellido">
                                            <?php } ?>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Fecha de Nacimiento</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <?php if(isset($fecha_alum)){ ?>      
                                                <input type="text" id="fecha" class="form-control" name="password" value="<?php echo $fecha_alum ?>" disabled>
                                            <?php }else{ ?>
                                                <input type="date" id="fecha" class="form-control" name="password">
                                            <?php } ?>
                                                
                                        </div>
                                        <div class="col-md-4">
                                            <label>Dirección</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="direccion" class="form-control" name="contact" placeholder="Dirección">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Localidad</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="localidad">
                                                    
                                                    <?php while($rowLoc = mysqli_fetch_array($queryLoc)) { ?>

                                                        <option> <?php echo $rowLoc["localidad"] ?> </option>

                                                    <?php } ?>

                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Escuela de procedencia</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="prim">

                                                        <?php while($rowPrim = mysqli_fetch_array($queryPrim)) { ?>

                                                            <option> <?php echo $rowPrim["nombre"] ?> </option>

                                                        <?php } ?>

                                                    </select>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-4">
                                                <label>2da Opcion de escuela</label>
                                            </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="escuela">
                                                        
                                                    <?php while($rowSec = mysqli_fetch_array($querySec)) { ?>

                                                        <option> <?php echo $rowSec["nombre"] ?> </option>

                                                    <?php } ?>
                                                
                                                </select>
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <label>3ra Opcion de escuela</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="escuela2">

                                                    <?php while($rowSec2 = mysqli_fetch_array($querySec2)) { ?>

                                                        <option> <?php echo $rowSec2["nombre"] ?> </option>

                                                    <?php } ?>

                                                </select> 
                                            </fieldset>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Turno de preferencia (No se asegura)</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="turno" class="form-control" name="turno" placeholder="Turno">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Vínculo con la escuela</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <fieldset class="form-group">
                                                <select class="form-select" id="vinculo" name="vinculo">
                                                    <option value="0">Ninguno</option>
                                                    <option value="1">Hermano/a de alumno/a</option>
                                                    <option value="2">Hijo/a de personal</option>                                                               
                                                </select>
                                            </fieldset>
                                        </div>                                                  
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="hermano" style="display: none">
                        <div class="card-header">
                            <h4 class="card-title">Datos del hermano/a</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>DNI</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="dni_hermano" placeholder="DNI" class="form-control" name="dni_hermano">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Curso</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="curso_hermano" placeholder="Curso" class="form-control" name="dni">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nombre</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nombre_hermano" placeholder="Nombre y Apellido" class="form-control" name="dni">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="hijo" style="display: none">
                        <div class="card-header">
                            <h4 class="card-title">Datos del adulto/a que lo vincula a la escuela</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>DNI</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="number" id="dni_vinculo" placeholder="DNI" class="form-control" name="dni">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Nombre</label>
                                        </div>
                                        <div class="col-md-8 form-group">
                                            <input type="text" id="nombre_vinculo" placeholder="Nombre y Apellido" class="form-control" name="nombre">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Datos del padre, madre o tutor</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label>DNI</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <?php if(isset($dni_t)){ ?>      
                                                    <input type="number" id="dni_padre" placeholder="DNI" class="form-control" name="dni" value="<?php echo $dni_t ?>" disabled>
                                                <?php }else{ ?>
                                                    <input type="number" id="dni_padre" placeholder="DNI" class="form-control" name="dni">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Nombre</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <?php if(isset($nombre_tutor)){ ?>      
                                                    <input type="text" id="nombre_padre" class="form-control" name="email-id" placeholder="Nombre" value="<?php echo $nombre_tutor ?>" disabled>
                                                <?php }else{ ?>
                                                    <input type="text" id="nombre_padre" class="form-control" name="email-id" placeholder="Nombre">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Apellido</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <?php if(isset($apellido_tutor)){ ?>      
                                                    <input type="text" id="apellido_padre" class="form-control" name="contact" placeholder="Apellido" value="<?php echo $apellido_tutor ?>" disabled>
                                                <?php }else{ ?>
                                                    <input type="text" id="apellido_padre" class="form-control" name="contact" placeholder="Apellido">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Fecha de Nacimiento</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <?php if(isset($fecha_tutor)){ ?>      
                                                    <input type="text" id="fecha_padre" class="form-control" name="password" value="<?php echo $fecha_tutor ?>" disabled>
                                                <?php }else{ ?>
                                                    <input type="date" id="fecha_padre" class="form-control" name="password">
                                                <?php } ?>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Telefono</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="text" id="telefono_padre" class="form-control" name="contact" placeholder="Telefono">
                                            </div>
                                            <div class="col-md-4">
                                                <label>E-Mail</label>
                                            </div>
                                            <div class="col-md-8 form-group">
                                                <input type="mail" id="mail_padre" class="form-control" name="contact" placeholder="E-Mail">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="basic-horizontal-layouts">
                <div class="row match-height">
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Fotos del Alumno</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Frente del DNI</label>
                                                <input class="form-control" type="file" id="frentedni" name="frentedni">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Reverso del DNI</label>
                                                <input class="form-control" type="file" id="reversodni">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Fotos del padre, madre o tutor</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Frente del DNI</label>
                                                <input class="form-control" type="file" id="frente_padre">
                                            </div>
                                            <div class="mb-3">
                                                <label for="formFile" class="form-label">Reverso del DNI</label>
                                                <input class="form-control" type="file" id="reverso_padre">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                        <div class="col-sm-12 d-flex justify-content-end" id="boton_guardar">
                            <button type="button" class="btn btn-primary me-1 mb-1" id="btn_guardar">Guardar</button>
                        </div>
                        <div class="col-sm-12 d-flex justify-content-end">
                            <div class="spinner-border text-primary text-center" role="status" id="cargando" style="display: none">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="col-12 col-md-12">
                            <div class="alert alert-success text-center" id="felicitaciones" style="display: none">Felicitaciones, el alumno se cargó correctamente</div>
                        </div>

                </div>
            </section>
        </div>
                                                </form>
        <script src="js/app.js"></script>
    </body>