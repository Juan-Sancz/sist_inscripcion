<?php

include("conn.php");

 if ($_SERVER['REQUEST_METHOD'] === 'POST') {


     if (isset($_POST['dni'])) {
if (isset($_FILES['frentedni']) && $_FILES['frentedni']['error'] === UPLOAD_ERR_OK) {
    $targetDirectory = "imagenes/dni/";
    $fileExtension = pathinfo($_FILES["frentedni"]["name"], PATHINFO_EXTENSION);

    $newFileName = $_POST["dni"] . "." . $fileExtension;
    $newFilePath = $targetDirectory . $newFileName;

    if (move_uploaded_file($_FILES["frentedni"]["tmp_name"], $newFilePath)) {
        echo "File uploaded successfully as: " . $newFileName;
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file uploaded or an error occurred during upload.";
}



if (isset($_FILES['reversodni']) && $_FILES['reversodni']['error'] === UPLOAD_ERR_OK) {
    $targetDirectory = "imagenes/dni/";
    $fileExtension = pathinfo($_FILES["reversodni"]["name"], PATHINFO_EXTENSION);

    $newFileName = $_POST["dni"] . "-r." . $fileExtension;
    $newFilePath = $targetDirectory . $newFileName;

    if (move_uploaded_file($_FILES["reversodni"]["tmp_name"], $newFilePath)) {
        echo "File uploaded successfully as: " . $newFileName;
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file uploaded or an error occurred during upload.";
}



if (isset($_FILES['frente_padre']) && $_FILES['frente_padre']['error'] === UPLOAD_ERR_OK) {
    $targetDirectory = "imagenes/dni/";
    $fileExtension = pathinfo($_FILES["frente_padre"]["name"], PATHINFO_EXTENSION);

    $newFileName = "P" . $_POST["dni"] . "." . $fileExtension;
    $newFilePath = $targetDirectory . $newFileName;

    if (move_uploaded_file($_FILES["frente_padre"]["tmp_name"], $newFilePath)) {
        echo "File uploaded successfully as: " . $newFileName;
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file uploaded or an error occurred during upload.";
}



if (isset($_FILES['reverso_padre']) && $_FILES['reverso_padre']['error'] === UPLOAD_ERR_OK) {
    $targetDirectory = "imagenes/dni/";
    $fileExtension = pathinfo($_FILES["reverso_padre"]["name"], PATHINFO_EXTENSION);

    $newFileName = "P" . $_POST["dni"] . "-r." . $fileExtension;
    $newFilePath = $targetDirectory . $newFileName;

    if (move_uploaded_file($_FILES["reverso_padre"]["tmp_name"], $newFilePath)) {
        echo "File uploaded successfully as: " . $newFileName;
    } else {
        echo "Error uploading the file.";
    }
} else {
    echo "No file uploaded or an error occurred during upload.";
}




        


        $cargaValues = "";

         $dni = $_POST["dni"];
         $nombre = $_POST["nombre"];
         $apellido = $_POST["apellido"];
         $fecha = $_POST["fecha"];
         $dir = $_POST["dir"];
         $loc_e = $_POST["loc_e"];
         $prime_e = $_POST["prim_e"];
         $opc1 = $_POST["opc1"];
         $opc2 = $_POST["opc2"];
         $turno = $_POST["turno"];
         $dni_padre = $_POST["dni_padre"];
         $nombre_padre = $_POST["nombre_padre"];
         $apellido_padre = $_POST["apellido_padre"];
         $fecha_padre = $_POST["fecha_padre"];
         $tel_padre = $_POST["tel_padre"];
         $mail_padre = $_POST["mail_padre"];
         if(isset($_POST["dni_v"])){
            $dni_v = $_POST["dni_v"];
         }
         if(isset($_POST["nombre_v"])){
            $nombre_v = $_POST["nombre_v"];
         }
         if(isset($_POST["curso_v"])){
            $curso_v = $_POST["curso_v"];
         }
         $vin = $_POST["vin"];
         $id = $_POST["id"];
        
         $cargaInsert="INSERT INTO `alumnos`(`apellido`, `nombre`, `dni`, `fecha`, `direccion`, `localidad`, `escuela`, `vinculo`, `id_secundaria`,";
         
        if($vin == "1"){
            $cargaValues = "`dni_hermano`, `nombre_hermano`, `curso`, `turno`) 
            VALUES ('".$apellido."','".$nombre."','".$dni."','".$fecha."','".$dir."','".$loc_e."','".$prime_e."','".$vin."','".$id."','".$dni_v."','".$nombre_v."','".$curso_v."','".$turno."')";
        }
        if($vin == "2"){
            $cargaValues = "`dni_personal`, `nombre_personal`, `turno`) 
            VALUES ('".$apellido."','".$nombre."','".$dni."','".$fecha."','".$dir."','".$loc_e."','".$prime_e."','".$vin."','".$id."','".$dni_v."','".$nombre_v."','".$turno."')";
        }
        if($vin == "0"){
            $cargaValues = "`turno`) 
            VALUES ('".$apellido."','".$nombre."','".$dni."','".$fecha."','".$dir."','".$loc_e."','".$prime_e."','".$vin."','".$id."','".$turno."')";
        }
         
         $cargaAlumno = $cargaInsert.$cargaValues;
        
         $query = mysqli_query($conn,$cargaAlumno);
         
        echo "success";
    

     } else {
         echo "Missing data in POST request";
     }
    }else {
     echo "Invalid request method";
 }


 $sqlTutor = "INSERT INTO `padres`(`nombre`, `apellido`, `dni`, `fecha`, `telefono`, `mail`) VALUES ('".$nombre_padre."','".$apellido_padre."','".$dni_padre."','".$fecha_padre."','".$tel_padre."','".$mail_padre."')";
 $queryTutor = mysqli_query($conn, $sqlTutor);
 if($queryTutor){
    echo "tutor success";
 }else{
    echo "tutor error";
 }


 if($queryTutor && $query){
    $selectId = "SELECT alumnos.id AS alumnos_id, padres.id AS padres_id
    FROM alumnos
    INNER JOIN padres ON alumnos.dni = '".$dni."' AND padres.dni = '".$dni_padre."';
    ";
    
    $querySelect = mysqli_query($conn, $selectId);
    if($querySelect){
        echo "select success";
    }else{
        echo "select error";
    }

    $rowSelect = mysqli_fetch_array($querySelect);

    $sqlPadreAlumno = "INSERT INTO padrealumno (dni_alumno, dni_padre) VALUES ('".$rowSelect["alumnos_id"]."','".$rowSelect["padres_id"]."')";

    $queryPadreAlumno = mysqli_query($conn, $sqlPadreAlumno);
    if($queryPadreAlumno){
        echo "success";
    }else{
        echo "padrealumno error";
    }
 }else{
    echo "error";
 }
?>