
                    
                    <form  action="#" method="POST" id='contacto'>
                        <div class='campo'>
                            <label for="nombre">Nombre:</label>
                            <input type="text" 
                            name='nombre'
                            placeholder='Nombre' 
                            id='nombre'
                            value=
                            <?php 
                                if($_GET==NULL){
                                    echo'';
                                }else
                                echo $contacto['nombre_contacto'];
                            ?>>
                        </div>

                        <div class='campo'>
                            <label for="empresa">Empresa:</label>
                            <input type="text" 
                            name='empresa'
                            placeholder='Empresa' 
                            id='empresa'
                            value=                            <?php 
                                if($_GET==NULL){
                                    echo'';
                                }else
                                echo $contacto['empresa_contacto'];
                            ?>>
                        </div> 
                        

                        <div class='campo'>
                            <label for="telefono">Telefono:</label>
                            <input type="tel" 
                            name='Telefono' 
                            placeholder='Telefono'  
                            id='telefono'
                            value=                            <?php 
                                if($_GET==NULL){
                                    echo'';
                                }else
                                echo $contacto['telf_contacto'];
                            ?>>
                        </div>   
                        <!-- $contacto['id_contacto'] lo ponemos en un if ternario para comprobar si tiene ese dato en concreto -->
                            <?php $accion = $_GET ? 'editar':'crear' ?>
                            <input type="hidden" id='accion' value=<?php echo $accion ?>>

                            <?php if(isset($contacto['id_contacto'])){ ?>
                                <input type="hidden" id='id' value=<?php echo $contacto['id_contacto'] ?> >
                            <?php } ?>
                            <!-- Si encuentra cualquier dato dentro del get devolveraun true y mostrara Editar en el boton -->
                            <input type="submit" class='btn btn-principal' 
                            <?php $boton = $_GET ? 'Editar': 'Añadir'; ?>                               
                             value= <?php echo $boton ?>>

                        </form>

            </div><!-- div amarillo -->
    </section>