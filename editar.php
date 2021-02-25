<?php include_once 'includes/templates/header.php';?>

<?php include 'includes/funciones/funciones.php';?>

<pre>
    <?php
    //FILTER_VALIDATE_INT convierte un string e un int
    $id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
    // var_dump($id);
     //comprobamos qu el id sea valido, en el caso de que no lo sea manara un mensaje de error y no seguira con el script 
        if(!$id){
            die('no es valido'); // die imprime un mensaje y termina el script actual
        }
        
        $resultado = obtenerContacto($id);
        $contacto = $resultado->fetch_assoc();

        echo '<pre>';
            //var_dump($contacto['nombre_contacto']);
        echo '</pre>';
     ?>
</pre>

<body >
    <div class='barra'>
        <div class="contenedor-barra centrar">
<a href="index.php" class="btn btn-secundario">volver</a>

        <h1>Editar Contactos</h1>
        </div><!-- contenedor-barra -->
    </div><!-- barra -->
    
<section>
    <div class= 'contenedor '>
        <div class="div-amarillo clearfix">
            <div>
                <legend>Editar contacto</legend>
        
            </div>

    <?php include_once 'includes/templates/formulario.php';?>

<?php include_once 'includes/templates/footer.php';?>