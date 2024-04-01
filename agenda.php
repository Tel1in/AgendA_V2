<?php
require_once 'funcionesSql.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.10/index.global.min.js'></script>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css' rel='stylesheet'>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
    
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {


        });
        calendar.render();
        calendar.getOption('locale');
        calendar.setOption('locale', 'mx');
    });

</script>

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const myModal = document.getElementById('myModal');

        myModal.addEventListener('shown.bs.modal', () => {
        });
    });
</script>


<style>
    .initial-hidden {
        display: none;
    }
</style>
<script 
src="funciones.js">
</script>

<script 
src="salas.js">
</script>

 <script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('s1').addEventListener('change', function () {
            var selectedValue = this.value;

            fetch('llenarExp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'id_tipo_expediente=' + selectedValue, 
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('s11').innerHTML = data;
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });

    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('s11').addEventListener('change', function () {
            var selectedValue = this.value;

            fetch('llenarExp2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'valor1=' + selectedValue, // Enviar el valor seleccionado
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('s12').innerHTML = data; // Llenar el tercer select con las opciones recibidas
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById('s110').addEventListener('change', function () {
            var selectedValue = this.value;

            fetch('llenarExp2.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'valor1=' + selectedValue, // Enviar el valor seleccionado
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.text();
            })
            .then(data => {
                document.getElementById('s120').innerHTML = data; // Llenar el tercer select con las opciones recibidas
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
</script>


 <!-- 
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var selectAudiencia = document.getElementById("s3");
                var inputAudiencia = document.getElementById("inputAudiencia");
                selectAudiencia.addEventListener("change", function () {
                    inputAudiencia.disabled = (selectAudiencia.value === "");
                });
            });
    </script>
-->
 <script>
        document.addEventListener("DOMContentLoaded", function () {
            var inputAudiencia = document.getElementById("inputAudiencia");
            function deshabilitarInput() {
                
            }
            document.querySelector("button[type='reset']").addEventListener("click", deshabilitarInput);

            var modal = new bootstrap.Modal(document.getElementById("exampleModal"));
            modal._element.addEventListener("hidden.bs.modal", function () {
                document.querySelector("form").reset();
                deshabilitarInput();
            });
        });
 </script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var form = document.querySelector("form");

        form.addEventListener("submit", function(event) {
            event.preventDefault();
            var formData = new FormData(form);
            fetch("insertarEvento.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status} ${response.statusText}`);
                }
                return response.text();
            })
            .then(data => {
                if (!data.trim()) {
                    // Si la respuesta está vacía, mostramos un mensaje de éxito genérico
                    swal("Evento Insertado con Éxito", "CONTINUAR", "success")
                    .then(() => {
                        location.reload();
                    });
                } else if (data.trim() === "Evento insertado correctamente.") {
                    // Si la respuesta contiene el mensaje de éxito esperado
                    swal("Evento Insertado con Éxito", "CONTINUAR", "success")
                    .then(() => {
                        location.reload();
                    });
                } else {
                    swal("Error", data, "error");
                }
            })
            .catch(error => {
                console.error("Error en la solicitud Fetch: " + error.message);
                swal("Error", "Hubo un error en la solicitud", "error");
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var modificarForm = document.getElementById("modificarFormulario");

        modificarForm.addEventListener("submit", function(event) {
            event.preventDefault();
            var formData = new FormData(modificarForm);

            fetch("modificar_evento.php", {
                method: "POST",
                body: formData
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error en la solicitud: ${response.status} ${response.statusText}`);
                }
                return response.text();
            })
            .then(data => {
                if (!data.trim()) {
                    // Si la respuesta está vacía, mostramos un mensaje de éxito genérico
                    swal("Evento Modificado con Éxito", "CONTINUAR", "success")
                    .then(() => {
                        location.reload();
                    });
                } else if (data.trim() === "Evento modificado correctamente.") {
                    // Si la respuesta contiene el mensaje de éxito esperado
                    swal("Evento Modificado con Éxito", "CONTINUAR", "success")
                    .then(() => {
                        location.reload();
                    });
                } else {
                    swal("Error", data, "error");
                }
            })
            .catch(error => {
                console.error("Error en la solicitud Fetch: " + error.message);
                swal("Error", "Hubo un error en la solicitud", "error");
            });
        });
    });
</script>

<script>
    function eliminarDatos(id_evento_agenda) {
        var confirmacion = confirm('¿Estás seguro de que deseas eliminar este evento?');

        if (confirmacion) {
            fetch('eliminar_evento.php?id_evento_agenda=' + id_evento_agenda)
                .then(response => response.text())
                .then(data => {
                    alert('Éxito: ' + data);
                    window.location.reload();
                })
                .catch(error => {
                    alert('Error: Hubo un problema al eliminar el evento');
                    console.error(error);
                });
        } else {
            alert('Eliminación cancelada');
        }
    }
</script>

<script>
   document.addEventListener('DOMContentLoaded', function () {
        var modificarDatosBtns = document.querySelectorAll('.modificarDatosBtn');
        var modal = document.getElementById('exampleModal2');
        var form = modal.querySelector('form');

        modificarDatosBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
    
                var idEvento = this.getAttribute('data-id');
                console.log('ID del evento:', idEvento);

                fetch('llenarform.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded'
                    },
                    body: 'id_evento_agenda=' + encodeURIComponent(idEvento),
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Datos del evento recibidos:', data);
                    if (data && Object.keys(data).length > 0) {
                        form.querySelector('#idE').value = data.id_evento_agenda;
                        form.querySelector('#s10').value = data.nom_expediente;
                        form.querySelector('#s110').value = data.numero;

                        if (typeof data.nombreInv === 'string') {
                            var id_involucrado = data.id_inv;
                            var option = document.createElement('option');
                            option.value = id_involucrado;
                            option.textContent = data.nombreInv;
                            form.querySelector('#s120').innerHTML = ''; 
                            form.querySelector('#s120').appendChild(option);
                        } else {
                            console.error('nombre_inv no es una cadena de texto:', data.nombreInv);
                        }
 

                        var optionGuardada = document.createElement('option');
                        optionGuardada.value = data.id_tipo_audiencia; 
                        optionGuardada.textContent = data.nom_tipo_audiencia; 
                        optionGuardada.selected = true; 
                        form.querySelector('#s30').appendChild(optionGuardada);

                        // Verificar si nom_tipo_audiencia es un arreglo
                        if (Array.isArray(data.nom_tipo_audiencia)) {
                            // Iterar sobre cada tipo de audiencia en el arreglo
                            data.nom_tipo_audiencia.forEach(function(audiencia) {
                                // Crear una opción para cada tipo de audiencia
                                var option = document.createElement('option');
                                option.value = audiencia.id_tipo_audiencia;
                                option.textContent = audiencia.nom_tipo_audiencia;

                                // Agregar la opción al select
                                form.querySelector('#s30').appendChild(option);
                            });
                        } 

                        var optionGuardada2 = document.createElement('option');
                        optionGuardada2.value = data.id_sala; 
                        optionGuardada2.textContent = data.nombre_sala; 
                        optionGuardada2.selected = true; 
                        form.querySelector('#sala1').appendChild(optionGuardada2);

                        // Verificar si nom_tipo_audiencia es un arreglo
                        if (Array.isArray(data.nombre_sala)) {
                            // Iterar sobre cada tipo de audiencia en el arreglo
                            data.nombre_sala.forEach(function(sala) {
                                // Crear una opción para cada tipo de audiencia
                                var option = document.createElement('option');
                                option.value = sala.id_sala;
                                option.textContent = sala.nom_tipo_audiencia;

                                // Agregar la opción al select
                                form.querySelector('#sala1').appendChild(option);
                            });
                        } 

                        
                        var optionGuardada3 = document.createElement('option');
                        optionGuardada3.value = data.id_juez; 
                        optionGuardada3.textContent = data.nom_juez; 
                        optionGuardada3.selected = true; 
                        form.querySelector('#juez1').appendChild(optionGuardada3);

                        // Verificar si nom_tipo_audiencia es un arreglo
                        if (Array.isArray(data.nom_juez)) {
                            data.nom_juez.forEach(function(juez) {
                                var option = document.createElement('option');
                                option.value = juez.id_juez;
                                option.textContent = juez.nom_juez;
                                // Agregar la opción al select
                                form.querySelector('#juez1').appendChild(option);
                            });
                        } 
                    

                        form.querySelector('#d10').value = data.fecha;
                        form.querySelector('#h10').value = data.hora;
                        form.querySelector('#evento1').value = data.evento;
                    } else {
                        console.error('Datos del evento no válidos:', data);
                    }
                })
                .catch(error => {
                    console.error('Error al obtener los datos del evento:', error);
                });
            });
        });
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Escuchar el evento 'shown.bs.modal' para el modal 'exampleModal2'
        document.getElementById('exampleModal2').addEventListener('shown.bs.modal', function () {
            var modificarBtn = document.getElementById("modificarBtn");
            var modalFooter = document.querySelector("#exampleModal2 .modal-footer");
            var inputs = document.querySelectorAll("#exampleModal2 input");

            // Agregar evento al botón "Modificar"
            modificarBtn.addEventListener("click", function () {
                // Habilitar la edición de los campos de entrada
                for (var i = 0; i < inputs.length; i++) {
                    inputs[i].readOnly = false;
                }

                // Crear botón "Cancelar"
                var cancelarBtn = document.createElement("button");
                cancelarBtn.setAttribute("type", "button");
                cancelarBtn.setAttribute("class", "btn btn-secondary");
                cancelarBtn.textContent = "Cancelar";
                cancelarBtn.addEventListener("click", function () {
                    // Restaurar los campos de entrada a solo lectura
                    for (var i = 0; i < inputs.length; i++) {
                        inputs[i].readOnly = true;
                    }

                    // Restaurar el botón "Modificar"
                    modificarBtn.style.display = "inline-block";

                    // Eliminar el botón "Cancelar" y "Confirmar"
                    modalFooter.removeChild(cancelarBtn);
                    modalFooter.removeChild(confirmarBtn);
                });

                // Crear botón "Confirmar"
                var confirmarBtn = document.createElement("button");
                confirmarBtn.setAttribute("type", "submit");
                confirmarBtn.setAttribute("class", "btn btn-danger");
                confirmarBtn.textContent = "Confirmar";
                confirmarBtn.addEventListener("click", function () {
                    // Este es el lugar donde podrías agregar la lógica para confirmar
                    // Por ahora, no haremos nada al hacer clic en "Confirmar"
                });

                // Agregar botones "Cancelar" y "Confirmar" al pie de página del modal
                modalFooter.appendChild(cancelarBtn);
                modalFooter.appendChild(confirmarBtn);

                // Ocultar el botón "Modificar"
                modificarBtn.style.display = "none";
            });
        });
    });
</script>



<title>AGENDA V1</title>
</head>

<body>
    <div class="container-fluid">
        <div class="navbar ">
            <div class="container-fluid justify-content-start">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <button type="button" class="btn btn-secondary" onclick="cambiarVentana('calendar')">MES</button>
                    <button type="button" class="btn btn-secondary" onclick="cambiarVentana('tabla2')">DIA</button>
                    <button typr="button" class="btn btn-secondary" onclick="cambiarVentana('tabla3')">EVENTO</button>
                </div>
            </div>

        </div>
        <div class="row-3";>
            <div class="col-10">
                <div id="calendar">
                </div>
                <div id="tabla2">

                    <div class="navbar">
                        <div class="container">
                            <h2 id="fechaHeader" class="i" style="font-size:27px;"></h2>
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                <div class="me-2" role="group" aria-label="First group">
                                    <label for="fechaInput">Seleccione fecha:</label>
                                    <input type="date" id="fechaInput" onchange="actualizarFecha()">
                                </div>
                                <div class="btn-group me-2" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-dark" onclick="hoy()"
                                        id="diaActual">today</button>
                                </div>
                                <div class="btn-group me-2" role="group" aria-label="First group">
                                    <button type="button" class="btn btn-dark" onclick="moverDia(-1)"><i
                                            class="bi bi-chevron-left"></i></button>
                                    <button type="button" class="btn btn-dark" onclick="moverDia(1)"><i
                                            class="bi bi-chevron-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <div class="text-center">
                            <div class="spinner-border" role="status" id="spinner">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n0">
                            <div class="container">
                                <P>SALAS TEPIC</P>
                                <H5>S1</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>S2</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                                <H5>S3</H5>
                                <i class="bi bi-circle-fill" style="color: blue;"></i>
                                <H5>S4</H5>
                                <i class="bi bi-circle-fill" style="color: green;"></i>
                                <H5>S5</H5>
                                <i class="bi bi-circle-fill" style="color:pink;"></i>
                                <H5>SV 1</H5>
                                <i class="bi bi-circle-fill" style="color:blueviolet;"></i>
                                <H5>SV 2</H5>
                                <i class="bi bi-circle-fill" style="color:deepskyblue;"></i>
                                <H5>SV 3</H5>
                                <i class="bi bi-circle-fill" style="color:gray;"></i>
                                <H5>SV 4</H5>
                                <i class="bi bi-circle-fill" style="color:purple;"></i>
                                <H5>SV 16</H5>
                                <i class="bi bi-circle-fill" style="color:aquamarine;"></i>
                                <H5>SV 17</H5>
                                <i class="bi bi-circle-fill" style="color:chartreuse;"></i>
                                <H5>SV 18</H5>
                                <i class="bi bi-circle-fill" style="color:darkblue;"></i>
                                <H5>SV 19</H5>
                                <i class="bi bi-circle-fill" style="color:darkcyan;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n1">
                            <div class="container">
                                <p>SALAS ADOLECENTES</p>
                                <H5>SALA ADOLECENTES</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SALAV 5 ADOLECENTES</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                                <H5>SALAV 15 ADOLECENTES</H5>
                                <i class="bi bi-circle-fill" style="color: blue;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n2">
                            <div class="container">
                                <P>SALAS BAHIA</P>
                                <H5>S1 BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>S2 BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                                <H5>S10 BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: blue;"></i>
                                <H5>SV11 BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: green;"></i>
                                <H5>SV CJM BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: coral;"></i>
                                <H5>SV14 CJM BAHIA</H5>
                                <i class="bi bi-circle-fill" style="color: cyan;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n3">
                            <div class="container">
                                <P>SALAS CJM</P>
                                <H5>SALA DE MUJER TEPIC</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SV13 CJM TEPIC</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                                <H5>SALA EJECUCION</H5>
                                <i class="bi bi-circle-fill" style="color: blue;"></i>
                                <H5>SV20 CJM TEPIC</H5>
                                <i class="bi bi-circle-fill" style="color: green;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n4">
                            <div class="container">
                                <P>SALAS SANTIAGO</P>
                                <H5>SV6 SANTIAGO</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SV12 SANITAGO</H5>
                                <i class="bi bi-circle-fill" style="color: blue;"></i>
                                <H5>SALA SANTIAGO</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n5">
                            <div class="container">
                                <P>SALAS IXTLAN</P>
                                <H5>SALA VIRTUAL 8 IXTLAN</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SALA IXTLAN</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n6">
                            <div class="container">
                                <P>SALAS TECUALA</P>
                                <H5>SALA VIRTUAL 7 TECUALA</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SALA TECUALA</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                            </div>
                        </div>
                        <div class="navbar initial-hidden" id="n7">
                            <div class="container">
                                <P>SALAS SAN PEDRO</P>
                                <H5>SALA VIRTUAL 8 SAN PEDRO</H5>
                                <i class="bi bi-circle-fill" style="color: yellow;"></i>
                                <H5>SALA SAN PEDRO</H5>
                                <i class="bi bi-circle-fill" style="color: red;"></i>
                            </div>
                        </div>
                    </div>
                    <div class="container">
                        <table id="example" class="table table-bordered "
                            style="border-style:hidden; border-color: black;">
                            <thead>
                                <tr>
                                    <th style="width: 120px;">Hora</th>
                                    <th>Evento</th>
                                </tr>
                            </thead>
                                    <tbody class="">
                                    <?php
                                        $horas_fijas = array("08:00am", "09:00am", "10:00am","11:00am","12:00pm","13:00pm","14:00pm","15:00pm","16:00pm","17:00pm","18:00pm","19:00pm","20:00pm",
                                                            "21:00pm","22:00pm","23:00pm","00:00am","01:00am","02:00am","03:00am","04:00am","05:00am","06:00am","07:00pm");

                                        foreach ($horas_fijas as $hora) {
                                            // Convertir la hora a formato deseado
                                            

                                            
                                            // Obtener los eventos para esta hora
                                            $eventosAmarillo = obtenerDatos3($hora,[1,14,5,31,26,25,27]);
                                            $eventosRojo = obtenerDatos3($hora,[2,23,33,32,7,17,8,9]);
                                            $eventosAzul = obtenerDatos3($hora,[3,35,18]);
                                            $eventosVerde = obtenerDatos3($hora,[12,40,11]);
                                            $eventosRosa = obtenerDatos3($hora,[13,6]);
                                            $eventosAV = obtenerDatos3($hora,[19,4]);
                                            $eventosAC = obtenerDatos3($hora,[20]);
                                            $eventosMorado = obtenerDatos3($hora,[22]);
                                            $eventosGris = obtenerDatos3($hora,[21]);
                                            $eventosAM = obtenerDatos3($hora,[23]);
                                            $eventosCT = obtenerDatos3($hora,[37]);
                                            $eventosAO = obtenerDatos3($hora,[38]);
                                            $eventosVO = obtenerDatos3($hora,[39]);


                                            // Imprimir la fila de la tabla para esta hora
                                            echo "<tr>";
                                            echo "<th>$hora</th>";
                                            echo "<td>";

                                            // Verificar si hay eventos para esta hora
                                                    $eventos = array_merge($eventosAmarillo, $eventosRojo, $eventosAzul, $eventosVerde, $eventosRosa, $eventosAV, $eventosAC, $eventosMorado, $eventosGris, $eventosAM, $eventosCT, $eventosAO, $eventosVO);
                                            if (!empty($eventos)) {
                                                // Mostrar las divisiones con eventos y colores de fondo dentro del td
                                                echo '<div class="container">';
                                                echo '<div class="row">'; 
                                                foreach ($eventos as $evento) {
                                                    // Determinar el color en función de la sala
                                                    $color = '';
                                                    if (in_array($evento, $eventosAmarillo)) {
                                                        $color = 'yellow';
                                                    } else if (in_array($evento, $eventosRojo)) {
                                                        $color = 'red';
                                                    } else if (in_array($evento, $eventosAzul)) {
                                                        $color = 'blue';
                                                    } else if (in_array($evento, $eventosVerde)) {
                                                        $color = 'green';
                                                    } else if (in_array($evento, $eventosRosa)) {
                                                        $color = 'pink';
                                                    } else if (in_array($evento, $eventosAV)) {
                                                        $color = 'blueviolet';
                                                    } else if (in_array($evento, $eventosAC)) {
                                                        $color = 'deepskyblue';
                                                    } else if (in_array($evento, $eventosMorado)) {
                                                        $color = 'purple';
                                                    } else if (in_array($evento, $eventosGris)) {
                                                        $color = 'gray';
                                                    } else if (in_array($evento, $eventosAM)) {
                                                        $color = 'aquamarine';
                                                    } else if (in_array($evento, $eventosCT)) {
                                                        $color = 'chartreuse';
                                                    } else if (in_array($evento, $eventosAO)) {
                                                        $color = 'darkblue';
                                                    } else if (in_array($evento, $eventosVO)) {
                                                        $color = 'darkcyan';
                                                    }
                                                    echo '<div class="col" style="border: 1px solid black; background-color: ' . $color . ' ;"> <h6>' . $evento . '</h6></div>';
                                                }
                                                
                                                echo '</div>';
                                                echo '</div>';
                                            } else {
                                                // Mostrar un mensaje predeterminado si no hay eventos para esta hora
                                                echo "No hay evento";
                                            }

                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                        ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="tabla3">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Exp</th>
                            <th scope="col">Numero</th>
                            <th scope="col">Involucrado</th>
                            <th scope="col">Audiencia</th>
                            <th scope="col">Sala</th>
                            <th scope="col">Juez</th>
                            <th scope="col">Hora</th>
                            <th scope="col">fecha</th>
                            <th scope="col">Evento</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <TBody>
                            <?php $result=obtenerDatos()?>
                                <?php if ($result->num_rows > 0) { ?>
                                    <?php while ($row = $result->fetch_assoc()) { ?>
                                        <tr>
                                            <td><?php echo $row["id_evento_agenda"]?></td>
                                            <td><?php echo $row["nom_expediente"]?></td>
                                            <td><?php echo $row["numero"]?> </td>
                                            <td><?php echo $row["nombreInv"]?> </td>
                                            <td><?php echo $row["nom_tipo_audiencia"]?> </td>
                                            <td><?php echo $row["nombre_sala"]?> </td>
                                            <td><?php echo $row["nom_juez"]?> </td>
                                            <td><?php echo $row["fecha"]?> </td>
                                            <?php $horaFormato12 = date("h:i A", strtotime($row["hora"]))?>
                                            <td><?php echo $horaFormato12 ?></td>
                                            <td><?php echo $row["evento"]?></td>
                                                    <td>                                                  
                                                        <button type='button' id='eliminarDatos' class='btn btn-outline-dark' onclick='eliminarDatos(<?php echo $row["id_evento_agenda"]; ?>)'><i class='bi bi-trash3' style='color:red'></i></button></div>          
                                                        <button type='button' id='modificarDatos' class='btn btn-outline-dark modificarDatosBtn' data-bs-toggle="modal" data-bs-target="#exampleModal2" data-id="<?php echo $row["id_evento_agenda"]; ?>">
                                                            <i class="bi bi-arrow-repeat" style='color:blue'></i>
                                                        </button>                                                                  
                                                    </td>
												<?php } ?>
                                        </tr>
											<?php } else { ?>
												<tr>
													<td colspan="5" class="text-center">No se encontraron resultados</td>
												</tr>
											<?php } ?>
                    </TBody>
                </table>
                </div>
            </div>
            <div class="col-5">
                
            </div>
        </div>
        <div class="row">
            <div id="myModal" >
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Agregar Evento
                </button>

                <div class="modal fade" id="exampleModal" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">AGREGAR EVENTO</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="insertarEvento.php" method="post">
                                    <label for="s1">Expediente</label>
                                    <select class="form-select" name="s1" id="s1" required>
                                    <option value="" selected disabled>Selecciona un tipo de expediente</option>
                                        <?php
                                             $exp = expediente();
                                             foreach ($exp as $exp) {
                                                echo "<option value='" . $exp["id_tipo_expediente"] . "'>" . $exp["nom_expediente"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="s11">Numero</label>
                                    <select  class="form-select" name="s11" id="s11" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    </select>
                                    <div class="form-text" id="basic-addon4">Seleccione un tipo de expediente para habilitar</div>
                                    <label for="s12">Inputado</label>
                                    <select  class="form-select" name="s12" id="s12" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    </select>
                                    <div class="form-text" id="basic-addon4">Seleccione un numero para habilitar</div>
                                    <label for="s3">Tipo Audiencia</label>
                                    <select name="s3" id="s3" class="form-select" required>
                                    <option value="" selected disabled>Selecciona una audiencia</option>
                                    <?php
                                             $audiencia = audiencias();
                                             foreach ($audiencia as $audiencia) {
                                                echo "<option value='" . $audiencia["id_tipo_audiencia"] . "'>" . $audiencia["nom_tipo_audiencia"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="sala">Sala</label>
                                    <select name="sala" id="sala" class="form-select" required>
                                    <option value="" selected disabled>Selecciona una sala</option>
                                    <?php
                                             $salas = sala();
                                             foreach ($salas as $salas) {
                                                echo "<option value='" . $salas["id_sala"] . "'>" . $salas["nombre_sala"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="juez">Juez</label>
                                    <select name="juez" id="juez" class="form-select" required>
                                    <option value="" selected disabled>Seleccione un juez</option>
                                    <?php
                                             $jueces = juez();
                                             foreach ($jueces as $jueces) {
                                                echo "<option value='" . $jueces["id_juez"] . "'>" . $jueces["nom_juez"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="d1">Fecha</label>
                                    <input type="date" id="d1" name="d1" class="form-control" required>
                                    <label for="h1">Hora</label>
                                    <input type="time" min="00:00" max="23:59" pattern="[0-2][0-9]:[0-5][0-9]" class="form-select" name="h1" id="h1" required>
                                    <label for="evento">Nombre Evento</label>
                                    <input id="evento" name="evento" type="text" required class="form-control">
                                

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                        <button type="reset" class="btn btn-danger">Limpiar Formulario</button>
                                        <button type="submit" class="btn btn-primary">Insertar Datos</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div id="myModal2" >
                <div class="modal fade" id="exampleModal2" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">EVENTO</h5>

                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="modificar_evento.php" method="post" id="modificarFormulario">
                                    <input type="hidden" class="form-control" name="idE" id="idE">
                                    <label for="s10">Expediente</label>
                                    <input type="text" class="form-control" name="s10" id="s10" disabled>
                                    <label for="s110">Numero</label>
                                    <input type="text" class="form-control" name="s110" id="s110" disabled>                      
                                    <label for="s120">Inputado</label>
                                    <select  class="form-select" name="s120" id="s120" disabled>
                                    <option value="" selected disabled>Seleccione</option>
                                    </select>
                                    <label for="s30">Tipo Audiencia</label>
                                    <select name="s30" id="s30" class="form-select" readonly>
                                    <option value="" selected disabled>Seleccione</option>
                                    <?php
                                             $audiencia = audiencias();
                                             foreach ($audiencia as $audiencia) {
                                                echo "<option value='" . $audiencia["id_tipo_audiencia"] . "'>" . $audiencia["nom_tipo_audiencia"] . "</option>";
                                            }
                                    ?>
                                    </select>
                                    <label for="sala1">Sala</label>
                                    <select name="sala1" id="sala1" class="form-select" readonly>
                                    <option value="" selected disabled>Seleccione</option>
                                    <?php
                                             $salas = sala();
                                             foreach ($salas as $salas) {
                                                echo "<option value='" . $salas["id_sala"] . "'>" . $salas["nombre_sala"] . "</option>";
                                            }
                                     ?>
                                    </select>
                                    <label for="juez1">Juez</label>
                                    <select name="juez1" id="juez1" class="form-select" readonly>
                                    <option value="" selected disabled>Seleccione</option>
                                    <?php
                                             $jueces = juez();
                                             foreach ($jueces as $jueces) {
                                                echo "<option value='" . $jueces["id_juez"] . "'>" . $jueces["nom_juez"] . "</option>";
                                            }
                                        ?>
                                    </select>
                                    <label for="d10">Fecha</label>
                                    <input type="date" id="d10" name="d10" class="form-control" readonly>
                                    <label for="h10">Hora</label>
                                    <input type="time" min="00:00" max="23:59" pattern="[0-2][0-9]:[0-5][0-9]" class="form-select" name="h10" id="h10" readonly>
                                    <label for="evento1">Nombre Evento</label>
                                    <input id="evento1" name="evento1" type="text" required class="form-control" readonly>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="button" class="btn btn-primary" id="modificarBtn">Modificar</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>