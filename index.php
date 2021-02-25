<?php include_once 'includes/templates/header.php';?>

<body >
    <div class='barra'>
        <div class="contenedor-barra centrar">
            <h1>Agenda de Contactos</h1>
        </div><!-- contenedor-barra -->
    </div><!-- barra -->
    

<section>
    <div class= 'contenedor '>
        <div class="div-amarillo clearfix">
            <div >
                <legend >Añadir un contacto</legend>
        
            </div>
    <?php include_once 'includes/templates/formulario.php';?>

    <section>
        <div class= 'contenedor '>
            <div class="div-blanco clearfix">
                <div class='contenedor centrar'>

                   <legend>Busca un contacto</legend>
                   <input type="text" id='buscador' class='buscador sombra' placeholder='Busca un contacto...'>
                    <i class="fas fa-search lupa"></i>
                                   <div class= 'centrar'>
                    <p class='num-contactos'> 32 Contactos </p>
                </div>
                </div>
                

                <?php
                    try{
                        require_once('includes/conexion/conexion.php');
                        $sql = 'SELECT id_contacto, nombre_contacto, empresa_contacto, telf_contacto FROM tbl_contacto';
                        $resultado = $conn->query($sql);

                    }catch (Exception $e) {
                        echo 'Excepción capturada: ',  $e->getMessage(), "\n"; //en caso de que noo pueda hacerse nos mostrara el error y el resto de la pagina seguira funcionando con normalidad
                    }
                
                
                
                ?>

            <table id='listado-contactos'>
                    <thead>
                    <tr> 
                        <th class='referencia'>Nombre</th>
                        <th class='referencia'>Empresa</th>
                        <th class='referencia'>Telefono</th>

                    </tr>
                    </thead>
        
                        <?php while ($row = mysqli_fetch_array($resultado)){ ?>
                            <tr>
                                <td class='referencia'><?php echo $row['nombre_contacto']; ?></td>
                                <td class='referencia'><?php echo $row['empresa_contacto']; ?></td>
                                <td class='referencia'><?php echo $row['telf_contacto']; ?></td>
                                <td>
                                    <a class='btn-editar'href="editar.php?id=<?php echo $row['id_contacto'];?>">
                                        <i class="fas fa-user-edit" ></i>
                                    </a>

                                    <button type='button' data-id=<?php echo $row['id_contacto']; ?> class='btn-borrar'>
                                        <i class="fas fa-trash-alt"></i>
                                    </button>

                            
                                </td>
                            </tr>
                            
                        <?php } ?>
            </table>

   
                
            </div><!-- div blanco -->
    </section>
        
        </div><!-- contenedor -->
    

    <?php include_once 'includes/templates/footer.php';?>


