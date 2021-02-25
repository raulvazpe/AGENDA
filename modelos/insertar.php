<?php 


    if($_POST['accion']== 'crear'){

    
            require_once('../includes/conexion/conexion.php');
            
                //validar las entradas

            $nombre = filter_var($_POST['nombre'], FILTER_SANITIZE_STRING);
            $empresa = filter_var($_POST['empresa'], FILTER_SANITIZE_STRING);
            $telefono = filter_var($_POST['telefono'], FILTER_SANITIZE_STRING);

                    try{
                        //preparamos la consulta
                        $stmt = $conn->prepare ("INSERT INTO `tbl_contacto` (`nombre_contacto`, `empresa_contacto`, `telf_contacto`) VALUES (?, ?, ?)");
                        //le pasamos la variables
                        $stmt->bind_param("sss", $nombre,$empresa,$telefono);
                        //ejecutamos la consulta
                        $stmt->execute();

                        if($stmt->affected_rows ==1){

                            $respuesta = array(
                                'respuesta' => 'correcto',
                                'id_insertado'=> $stmt->insert_id,
                                'datos' => array(
                                    'nombre'=> $nombre,
                                    'empresa'=> $empresa,
                                    'telefono'=> $telefono
                                )
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
      
      

    
