<?php 

     
    if($_POST['accion']=='editar'){

        
            require_once('../includes/conexion/conexion.php');
            
                //validar las entradas

            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);
            $id = filter_var($_POST['id'], FILTER_SANITIZE_NUMBER_INT);


            

                    try{
                        //preparamos la consulta
                        $stmt = $conn->prepare ("UPDATE `tbl_contacto` SET `nombre_contacto` = ?, `empresa_contacto` = ?, `telf_contacto` = ? WHERE `tbl_contacto`.`id_contacto` = ?; ");
                        //le pasamos la variables
                        $stmt->bind_param("sssi", $nombre,$empresa,$telefono,$id);
                        //ejecutamos la consulta
                        $stmt->execute();

                        if($stmt->affected_rows ==1){

                            $respuesta = array(
                                'respuesta' => 'correcto',

                            );
                        }
                       
                        $stmt->close();
                        $conn->close();

                    }catch (Exception $e) {
                        $respuesta = array(
                            'error' => $e->getMessage()
                        );
                    }




        echo json_encode($respuesta);  
    }

?>