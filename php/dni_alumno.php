<?php

$id=$_POST["id"];
$dni_e=$_POST["dni_e"];

?>
<html>
    <!DOCTYPE html>

            <head>
            
                <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
                <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
                <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
                <div id="readerAlumno"  width="600px"></div>
                

            
            <style>
            form {
            display: flex;
            flex-direction: column;
            width: 300px;
            }
            label {
            font-weight: bold;
            margin-top: 10px;
            }
            input {
            margin-top: 5px;
            }
            </style>

        <script>
                function include(html5QrcodeScanner){
                    
                    return HtmlService.createHtmlOutputFromFile(html5QrcodeScanner).getContent();
                    
                }
            //-----------------------------------------------------
                    function onScanSuccessAlumno(decodedText, decodedResult) {
                    // handle the scanned code as you like, for example:
                    var datos=`${decodedText}`, decodedResult;
                    console.log(datos); 
                    array=datos.split('@');
                    $(document.getElementById('apellido_alum')).val(array[1]);
                    $(document.getElementById('nombre_alum')).val(array[2]);
                    $(document.getElementById('dni_e')).val(array[4]);
                    $(document.getElementById('fecha_alum')).val(array[6]);
                    

                    }

                    function onScanFailureAlumno(error) {
                    // handle scan failure, usually better to ignore and keep scanning.
                    // for example:
                    console.warn(`Code scan error = ${error}`);
                    }

                    let html5QrcodeScannerAlumno = new Html5QrcodeScanner(
                    "readerAlumno",
                    { fps: 10, qrbox: {width: 500, height: 300} },
                    /* verbose= */ false    );
                    html5QrcodeScannerAlumno.render(onScanSuccessAlumno, onScanFailureAlumno);
                
                //-------------------------------------------------------
            </script>
            </head>
            <body>
                <div>
                <form method="POST" action="dni_tutor.php">
                    <div>
                        <input type="text" id="id" name="id" value="<?php echo $id ?>" hidden></input>
                    </div>
                    <div class="col-md-4">
                        <label>DNI</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" id="dni_e" name="dni_e" value="<?php echo $dni_e ?>" class="form-control" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Nombre</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" id="nombre_alum" class="form-control" name="nombre_alum" placeholder="Nombre" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Apellido</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" id="apellido_alum" class="form-control" name="apellido_alum" placeholder="Apellido" readonly>
                    </div>
                    <div class="col-md-4">
                        <label>Fecha de Nacimiento</label>
                    </div>
                    <div class="col-md-8 form-group">
                        <input type="text" id="fecha_alum" class="form-control" name="fecha_alum" readonly>
                    </div>
                    <div class="col-sm-12 d-flex justify-content-end" id="boton_guardar">   
                        <button type="submit" class="btn btn-primary me-1 mb-1" id="guardar_dni">Guardar</button>
                    </div>
                </form>
                    <form method="POST" action="carga.php">
                        <input type="text" id="id" name="id" value="<?php echo $id ?>" hidden></input>
                        <input type="text" id="dni_e" name="dni_e" value="<?php echo $dni_e ?>" hidden></input>
                        <button type="submit" class="btn btn-success" id="carga_manual">Carga manual</button>
                    </form>
                </div> 
                <!--<script src="qr.js"></script>--> 
            </body>
    </html>