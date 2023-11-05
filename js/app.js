
const guardar = document.getElementById("btn_guardar");
var vinculo = document.getElementById("vinculo");
var id = document.getElementById("id");
var vin = vinculo.value;
var dni_v = "";
var nombre_v = "";
var curso_v = "";




if (guardar){
    
        if(vinculo){
            vinculo.addEventListener("change", function(){
                let vinculo = document.getElementById("vinculo");
                let vin1 = vinculo.value;
                let hermano = document.getElementById("hermano");
                let hijo = document.getElementById("hijo");
                
                switch(vin1){
                    case "0" : 
                        hijo.style.display = "none";
                        hermano.style.display = "none";
                    break;
                    case "1" : 
                        if(hermano){
                            let display = hermano.style.display;
                            hijo.style.display = "none";
                            if(display == "none"){
                                hermano.style.display = "block";
                                dni_v = document.getElementById("dni_hermano");
                                curso_v = document.getElementById("curso_hermano");
                                nombre_v = document.getElementById("nombre_hermano");
                            }else{
                                hermano.style.display = "none";
                            }
                        }else{
                            console.log("error")
                        }
                    break;
                    case "2" : 
                        if(hijo){
                            let display = hijo.style.display;
                            hermano.style.display = "none";
                            if(display == "none"){
                                hijo.style.display = "block";
                                dni_v = document.getElementById("dni_vinculo");
                                nombre_v = document.getElementById("nombre_vinculo");
                            }else{
                                hijo.style.display = "none";
                            }
                        }else{
                            console.log("error")
                        }
                    break;
                }
            

            })
        }else{
            console.log("err")
        }
    guardar.addEventListener("click", function(){

        let dni = document.getElementById("dni");
        let nombre = document.getElementById("nombre");
        let apellido = document.getElementById("apellido");
        let fecha = document.getElementById("fecha");
        let dir = document.getElementById("direccion");


        let loc_e = document.getElementById("localidad");

        let prim_e = document.getElementById("prim");

        let opc1 = document.getElementById("escuela");

        let opc2 = document.getElementById("escuela2");

        let turno = document.getElementById("turno");


        let dni_padre = document.getElementById("dni_padre");
        let nombre_padre = document.getElementById("nombre_padre");
        let apellido_padre = document.getElementById("apellido_padre");
        let fecha_padre = document.getElementById("fecha_padre");
        let tel_padre = document.getElementById("telefono_padre");
        let mail_padre = document.getElementById("mail_padre");

        var formData = new FormData();
        let frentedni = document.getElementById("frentedni").files[0];
        formData.append("frentedni",frentedni);
        let reversodni = document.getElementById("reversodni").files[0];
        formData.append("reversodni",reversodni);


        let frente_padre = document.getElementById("frente_padre").files[0];
        formData.append("frente_padre",frente_padre);
        let reverso_padre = document.getElementById("reverso_padre").files[0];
        formData.append("reverso_padre",reverso_padre);


        formData.append("dni", dni.value);
        formData.append("nombre", nombre.value);
        formData.append("apellido", apellido.value);
        formData.append("fecha", fecha.value);
        formData.append("dir", dir.value);
        formData.append("loc_e", loc_e.value);
        formData.append("prim_e", prim_e.value);
        formData.append("opc1", opc1.value);
        formData.append("opc2", opc2.value);
        formData.append("turno", turno.value);
        formData.append("dni_padre", dni_padre.value);
        formData.append("nombre_padre", nombre_padre.value);
        formData.append("apellido_padre", apellido_padre.value);
        formData.append("fecha_padre", fecha_padre.value);
        formData.append("tel_padre", tel_padre.value);
        formData.append("mail_padre", mail_padre.value);
        formData.append("dni_v", dni_v.value);
        formData.append("nombre_v", nombre_v.value);
        formData.append("curso_v", curso_v.value);
        formData.append("vin", vinculo.value);
        formData.append("id", id.value);

        $.ajax({
            type: 'POST',
            url: 'carga_alumno.php',
            data: formData,
            contentType: false,
            processData: false, 
            success: function(response){
                console.log(response);
                
                let timerInterval
                Swal.fire({
                title: 'Cargando...',
                timer: 1000,
                didOpen: () => {
                    Swal.showLoading()
                    const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
                }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500
                      })
                }
                })

            }
        })
    })
}else{
    console.log("error")
}



