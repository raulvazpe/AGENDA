<?php

    
    if($_GET['accion']=='borrar'){

        //echo json_encode($_GET);
        

    $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);


    try{
        require_once('../includes/conexion/conexion.php');

        //preparamos la consulta
        $stmt = $conn->prepare("DELETE FROM `tbl_contacto` WHERE `tbl_contacto`.`id_contacto` = ?");
        //pasamos los valores para que haga la consulta con variables
        $stmt->bind_param('i', $id);
        //ejecutamos la consulta
        $stmt->execute();

            if($stmt->affected_rows==1){
                $resultado = array(
                    'respuesta'=>'correcto'
                );
            }
        //Cerramos consulta    
        $stmt->close();
        //cerramos conexion con la base de datos
        $conn->close();


    }catch (Exception $e) {
        $resultado = array(
            'respuesta' => 'error'
        );
    }
    echo json_encode($resultado);
}

?>