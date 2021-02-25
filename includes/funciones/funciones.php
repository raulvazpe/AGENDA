<?php
    function obtenerContacto($id){
        
        require_once('includes/conexion/conexion.php');
        try{
                return $conn->query("SELECT id_contacto, nombre_contacto, empresa_contacto, telf_contacto FROM tbl_contacto WHERE id_contacto = $id");
        
        }catch (Exception $e) {
            echo 'Excepción capturada: ',  $e->getMessage(), "\n"; //en caso de que noo pueda hacerse nos mostrara el error y el resto de la pagina seguira funcionando con normalidad
            return false;
        }
    
    }


//     function obtenerContacto($id) {
//         include 'includes/conexion/conexion.php';
//         try{
//              return $conn->query("SELECT id, nombre, empresa, telefono FROM contactos WHERE id = $id");
//         } catch(Exception $e) {
//              echo "Error!!" . $e->getMessage() . "<br>";
//              return false;
//         }
//    }

?>


