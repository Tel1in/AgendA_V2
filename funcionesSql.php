<?php
require_once 'conexion.php';

    
    function expediente(){
        $conn = conexion();
        require_once 'sesion.php';
        $usuario = $_SESSION['usuario'];
        $usuarioSala = obtenerRegionYJuzgadoUsuario($usuario);
        $juzgado = $usuarioSala["juzgado"];
        $sql = "SELECT c.id_tipo_expediente,c.nom_expediente 
        from cat_tipo_expediente c
        where c.agenda='Si'";

        if ($juzgado == "ADOL") {
            $sql .= " AND c.id_tipo_expediente IN (9, 10, 11, 15, 12, 13)";
        } else if ($juzgado != "") {
            $sql .= " AND EXISTS (
                SELECT 1
                FROM relacionado u
                WHERE u.juzgado = '$juzgado'
                AND u.usuario = '$usuario'
            )
            AND c.id_tipo_expediente NOT IN (9, 10, 11, 15, 12, 13)";
        }
            
        $result = $conn->query($sql );
    
        $exp = array();
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $exp[] = $row;
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    
        $conn->close();
    
        return $exp;
    }
    
    function audiencias() {
        $conn = conexion();
        
        $sql = "SELECT id_tipo_audiencia,nom_tipo_audiencia FROM tipo_audiencia";
        $result = $conn->query($sql);
    
        $audiencia = array();
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $audiencia[] = $row;
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    
        $conn->close();
    
        return $audiencia;
    }
    
    function sala() {
        $conn = conexion();
        require_once 'sesion.php';
        $usuario = $_SESSION['usuario'];
        $usuarioSala = obtenerRegionYJuzgadoUsuario($usuario);
        $region = $usuarioSala["region"];
        $juzgado = $usuarioSala["juzgado"];
    
        $sql = "SELECT DISTINCT s.id_sala, s.nombre_sala
                FROM sala s
                JOIN relacionado r ON s.region = r.region
                WHERE r.region = '$region' AND r.juzgado = '$juzgado'";
    
        $filtroJuzgado = "";
        switch ($juzgado) {
            case "CRJP":
                $filtroJuzgado = " AND s.id_sala IN (1, 2, 3, 6, 12, 13, 19, 20, 21, 22, 36, 37, 38, 39, 42, 43)";
                break;
            case "ADOL":
                $filtroJuzgado = " AND s.id_sala IN (4, 14, 23, 35)";
                break;
            case "CJM":
                $filtroJuzgado = " AND s.id_sala IN (5, 18, 33, 40, 41)";
                break;
            case "SGO":
                $filtroJuzgado = " AND s.id_sala IN (7, 31, 32)";
                break;
            case "TEC":
                $filtroJuzgado = " AND s.id_sala IN (8, 25)";
                break;
            case "SP":
                $filtroJuzgado = " AND s.id_sala IN (9, 27, 10)";
                break;
            case "BAHIA":
                $filtroJuzgado = " AND s.id_sala IN (11, 16, 15, 29, 30, 34)";
                break;
            case "IXTLAN":
                $filtroJuzgado = " AND s.id_sala IN (17, 26)";
                break;
        }
    
        $sql .= $filtroJuzgado . " ORDER BY s.id_sala ASC";
    
        $result = $conn->query($sql);
        $salas = array();
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $salas[] = $row;
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    
        $conn->close();
        return $salas;
        session_destroy();
    }
    
    function juez() {
        $conn = conexion();
        
        $sql = "SELECT id_juez,nom_juez FROM juez";
        $result = $conn->query($sql);
    
        $jueces = array();
    
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $jueces[] = $row;
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }
    
        $conn->close();
    
        return $jueces;
    }

    function solicitante(){
        $conn = conexion();
        $sql = "SELECT idSolicitante,TipoSolicitante FROM solicitante";
        $result = $conn->query($sql);

        $solicitante = array();

        if($result){
            while ($row = $result->fetch_assoc()){
                $solicitante[] = $row;
            }
        } else {
            echo "Error en la consulta: " . $conn->error;
        }

        $conn->close();

        return $solicitante;
    }
    
    function expediente2($id_tipo_expediente) {
        $conn = conexion();
        require_once 'sesion.php';
        $usuario = $_SESSION['usuario'];
        $regionExp2 = obtenerRegionYJuzgadoUsuario($usuario);
        $region = $regionExp2["region"];
        $sql = "";

        if($region=="TEPIC"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);

        } else if($region=="BAHIA"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);

        } else if($region=="TECUALA"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);

        } else if($region=="SANPEDRO"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);

        } else if($region=="IXTLAN"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);

        } else if($region=="SANTIAGO"){
            $sql = obtenerConsultaSegunTipoExpediente($id_tipo_expediente);
        }

        $exp2 = array();
    
        if (!empty($sql)) {
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error en la consulta SQL: " . $conn->error;
            } else {
                while ($row = $result->fetch_assoc()) {
                    $exp2[] = array(
                        'id' => $row['id'],
                        'valor' => $row['valor']
                    );
                }
            }
        } else {
            echo "Error: La consulta SQL está vacía.";
        }
    
        $conn->close();
        return $exp2;
        session_destroy();
    }
    
    function obtenerConsultaSegunTipoExpediente($id_tipo_expediente) {
        $sql = "";
        require_once 'sesion.php';
        $usuario = $_SESSION['usuario'];
        $regionExp2 = obtenerRegionYJuzgadoUsuario($usuario);
        $region = $regionExp2["region"];
        switch ($id_tipo_expediente) {
            case 1:
                $sql = "SELECT a.id_asunto  as id, a.numero_asunto AS valor 
                        FROM asunto_penal a 
                        INNER JOIN relacionado r
                        ON a.region = r.region
                        WHERE r.region = '$region' AND a.numero_asunto LIKE 'AP%'
                        GROUP BY id";
                break;
            case 12:
                $sql = "SELECT id_asunto as id, numero_asunto AS valor FROM asunto_penal WHERE numero_asunto LIKE 'AP-CENNA%'";
                break;
            case 13:
                $sql = "SELECT id_asunto as id, numero_asunto AS valor FROM asunto_penal WHERE numero_asunto LIKE 'AP-CEJA%'";
                break;
            case 17:
            case 19:
            case 16:
            case 5:
            case 4:
            case 25:
                $sql = "SELECT id_cuadernillo_constancia as id, numero_cuadernillo AS valor 
                        FROM cuadernilloS_constancia c
                        INNER JOIN relacionado r
                        ON c.region = r.region
                        WHERE r.region = '$region'
                        GROUP BY id";
                break;
            case 23:
                $sql = "SELECT id_causa as id, num_causa AS valor FROM causa";
                break;
            case 8:
                $sql = "SELECT c.id_causa as id, c.num_causa AS valor 
                        FROM causa c
                        INNER JOIN relacionado r
                        ON c.region = r.region
                        WHERE tipo_causa=1 AND r.region = '$region'
                        GROUP BY id";
                break;
            case 10:
                $sql = "SELECT id_causa as id, num_causa AS valor FROM causa WHERE tipo_causa=2";
                break;
            case 9:
                $sql = "SELECT id_causa as id, num_causa AS valor FROM causa WHERE tipo_causa=3";
                break;
            case 14:
            case 15:
                $sql = "SELECT id_ejecucion as id, num_ejecucion AS valor FROM ejecucion";
                break;
            default:
                echo "Error: Tipo de expediente no reconocido para nom_expediente = $id_tipo_expediente.";
                break;
        }
        return $sql;
    }
    
    function expediente3($id, $id_tipo_expediente) {
        $conn = conexion();
        $sql = "";
        $exp3 = array();
    
        switch ($id_tipo_expediente) {
            case 1:
            case 12:
            case 13:
                $sql = "SELECT id_asunto AS idinvolucrado, procesado AS nombreInputado FROM asunto_penal WHERE id_asunto='$id'";
                break;
            case 2:
            case 17:
            case 19:
            case 5:
            case 4:
            case 25:
                $sql = "SELECT id_inv AS idinvolucrado, CONCAT(nombre_inv,' ',paterno_inv,' ',materno_inv) AS nombreInputado FROM involucrado WHERE id_cc = '$id'";
                break;
            case 23:
            case 8:
            case 10:
            case 11:
            case 9:
                $sql = "SELECT id_inv AS idinvolucrado, CONCAT(nombre_inv,' ',paterno_inv,' ',materno_inv) AS nombreInputado FROM involucrado WHERE causa_id = '$id'";
                break;
            case 14:
            case 15:
                // Agregar la lógica correspondiente para el caso de ejecución si es necesario
                break;
            default:
                echo "Error: Tipo de expediente no reconocido para expediente3.";
                break;
        }
    
        if (!empty($sql)) {
            $result = $conn->query($sql);
            if (!$result) {
                echo "Error en la consulta SQL: " . $conn->error;
            } else {
                while ($row = $result->fetch_assoc()) {
                    $exp3[] = $row;
                }
            }
        } else {
            echo "Error: La consulta SQL esta vacia.";
        }
    
        $conn->close();
        return $exp3;
    }
    
    
    function insertar($nom_expediente, $numero, $inputado, $tipoAud, $sala, $juez, $solicitante, $fecha, $hora, $evento) {
        $conn = conexion();

            $sql_check = "SELECT COUNT(*) FROM eventoAgenda WHERE fecha = '$fecha' AND hora = '$hora'";
            $result = $conn->query($sql_check);
            $row = $result->fetch_row();
            if ($row[0] > 0) {
                $response = "Error: Ya existe un evento con el mismo  fecha y hora.";
                echo $response;
                $conn->close();
                return;
            }
    
            $sql_insert = "INSERT INTO eventoAgenda (expediente, numero, inputado, tipoAudiencia, sala, juez, Solicitante, fecha, hora, evento) VALUES ('$nom_expediente', '$numero', $inputado, '$tipoAud', '$sala', '$juez', '$solicitante', '$fecha', '$hora', '$evento')";
            if ($conn->query($sql_insert) === TRUE) {
                $response = "Evento insertado correctamente.";
                echo $response;
            } else {
                $response = "Error en la inserción del evento: " . $conn->error;
                echo $response;
            }
    
        $conn->close();
    }
    
    
    function obtenerDatos(){
        $conn = conexion();
        $sql = "SELECT
                    eventoagenda.id_evento_agenda,
                    cat_tipo_expediente.nom_expediente,
                    eventoagenda.numero,
                    COALESCE(
                        CONCAT(involucrado.nombre_inv, ' ', involucrado.paterno_inv, ' ', involucrado.materno_inv),
                        asunto_penal.procesado
                    ) AS nombreInputado,
                    tipo_audiencia.nom_tipo_audiencia,
                    sala.nombre_sala,
                    juez.nom_juez,
                    solicitante.Solicitante,
                    eventoagenda.fecha,
                    eventoagenda.hora,
                    eventoagenda.evento
                FROM
                    eventoagenda
                    INNER JOIN cat_tipo_expediente ON cat_tipo_expediente.id_tipo_expediente = eventoagenda.expediente
                    LEFT JOIN involucrado ON involucrado.id_inv = eventoagenda.inputado
                    LEFT JOIN asunto_penal ON asunto_penal.id_asunto = eventoagenda.inputado
                    INNER JOIN tipo_audiencia ON tipo_audiencia.id_tipo_audiencia = eventoagenda.tipoAudiencia
                    INNER JOIN sala ON sala.id_sala = eventoagenda.sala
                    INNER JOIN juez ON juez.id_juez = eventoagenda.juez
                    INNER JOIN solicitante ON solicitante.idSolicitante = eventoagenda.solicitante
                ORDER BY
                    eventoagenda.id_evento_agenda ASC;";
    
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
    
    function obtenerDatos2($id_evento_agenda){
        $conn = conexion();
        $sql = "SELECT
                    eventoagenda.id_evento_agenda,
                    cat_tipo_expediente.nom_expediente,
                    eventoagenda.numero,
                    COALESCE(
                        CONCAT(involucrado.nombre_inv, ' ', involucrado.paterno_inv, ' ', involucrado.materno_inv),
                        asunto_penal.procesado
                    ) AS nombreInputado,
                    COALESCE(involucrado.id_inv, asunto_penal.id_asunto) AS idInputado,
                    tipo_audiencia.id_tipo_audiencia,
                    tipo_audiencia.nom_tipo_audiencia,
                    sala.id_sala,
                    sala.nombre_sala,
                    juez.nom_juez,
                    juez.id_juez,
                    solicitante.idSolicitante,
                    solicitante.TipoSolicitante,
                    eventoagenda.fecha,
                    DATE_FORMAT(eventoagenda.hora, '%H:%i') AS hora,
                    eventoagenda.evento
                FROM
                    eventoagenda
                    INNER JOIN cat_tipo_expediente ON cat_tipo_expediente.id_tipo_expediente = eventoagenda.expediente
                    LEFT JOIN involucrado ON involucrado.id_inv = eventoagenda.inputado
                    LEFT JOIN asunto_penal ON asunto_penal.id_asunto = eventoagenda.inputado
                    INNER JOIN tipo_audiencia ON tipo_audiencia.id_tipo_audiencia = eventoagenda.tipoAudiencia
                    INNER JOIN sala ON sala.id_sala = eventoagenda.sala
                    INNER JOIN juez ON juez.id_juez = eventoagenda.juez
                    INNER JOIN solicitante ON solicitante.idSolicitante = eventoagenda.solicitante
                WHERE
                    eventoagenda.id_evento_agenda = '$id_evento_agenda';";

        $result = $conn->query($sql);
        $evento = array();

        if ($result->num_rows > 0) {
            $evento = $result->fetch_assoc();
        }

        $conn->close();
        return $evento;
    }

    function obtenerDatos3($hora, $sala, $fecha) {
        $conn = conexion();  
        $subHora = substr($hora, 0, 2);
        $salas_str = implode(',', $sala); // Convertir el array de salas en una cadena separada por comas
        $sql = "SELECT id_evento_agenda, CONCAT(TIME_FORMAT(hora,'%H:%i'),' = ',numero) as eventoFN FROM eventoagenda WHERE hora LIKE '$subHora%' AND sala IN ($salas_str) AND fecha = '$fecha'";
        
        $result = $conn->query($sql);
        $eventos = array(); 
    
        if ($result->num_rows > 0) {
            // Si se encuentran eventos, los agregamos al array $eventos
            while ($row = $result->fetch_assoc()) {
                $eventos[] = $row; // Modificar para agregar el array asociativo completo
            }
        }
    
        $conn->close();
    
        return $eventos;
    }

    function obtenerDatos4() {
        $conn = conexion();
        $sql = "SELECT eventoagenda.id_evento_agenda AS idEvento,CONCAT(cat_tipo_expediente.tipo_expediente, '-', eventoagenda.numero) AS title, eventoagenda.fecha AS f
                FROM eventoagenda
                INNER JOIN cat_tipo_expediente ON eventoagenda.expediente = cat_tipo_expediente.id_tipo_expediente";
        $result = $conn->query($sql);
        $eventos = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $eventos[] = array(
                    'id' => $row['idEvento'],
                    'title' => $row['title'],
                    'date' => $row['f'],
                    'allDay' => true
                );
            }
        }
        $conn->close();
        return $eventos;
    }
    
    function eliminarDatos($id_evento_agenda){
        $conn = conexion();
        $sql = "DELETE FROM eventoagenda WHERE id_evento_agenda = '$id_evento_agenda'";
        $response = "";
    
        if ($conn->query($sql) === TRUE) {
            $response = "Evento eliminado correctamente";
        } else {
            $response = "Error al eliminar el evento: " . $conn->error;
        }
    
        $conn->close();
    
        return $response;
    }
    
    function modificarDatos($id_evento_agenda, $tipoAud, $sala, $juez, $solicitante, $fecha, $hora, $evento){
        $conn = conexion();
        $sql = "UPDATE eventoagenda
                SET  tipoAudiencia = '$tipoAud', sala = '$sala' , juez = '$juez', solicitante ='$solicitante' , fecha = '$fecha' , hora = '$hora' , evento = '$evento'
                WHERE id_evento_agenda = '$id_evento_agenda'";
        $response = "";

        if ($conn->query($sql) === TRUE) {
            $response = "Evento modificado correctamente";
        } else {
            $response = "Error al modificar el evento: " . $conn->error;
        }
    
        $conn->close();
    
        return $response;
    }
    
    function obtenerRegionUsuario($usuario) {
        $conn = conexion();
        $sql = "SELECT region, juzgado FROM relacionado WHERE usuario = '$usuario'";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $region = $row["region"];
            $juzgado = $row["juzgado"];
            return $region . " " . $juzgado;
        } else {
            echo "No se encontró el usuario en la tabla.";
            return "";
        }
    }

    function obtenerRegionYJuzgadoUsuario($usuario) { 
        $conn = conexion(); 
        $sql = "SELECT region, juzgado FROM relacionado WHERE usuario = '$usuario'"; 
        $result = $conn->query($sql); 
    
        if ($result->num_rows > 0) { 
            $row = $result->fetch_assoc();
            $region = $row["region"];
            $juzgado = $row["juzgado"];
        } else { 
            $region = ""; 
            $juzgado = ""; 
            echo "No se encontró el usuario en la tabla."; 
        } 
    
        $conn->close();
    
        return array("region" => $region, "juzgado" => $juzgado); 
    }