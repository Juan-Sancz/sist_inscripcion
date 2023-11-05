<?php

    include("conn.php");

    $dni = $_POST["dni"];

    $comp = "SELECT * FROM alumnos WHERE dni = '".$dni."'";
    $query = mysqli_query($conn,$comp);

    $row = mysqli_fetch_array($query);


    
    if(isset($row["id"])){
       echo json_encode(0);
    }else{
        echo json_encode(1);
    }


?>