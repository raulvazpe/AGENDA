const formularioContactos = document.querySelector('#contacto'),
     listadoContactos = document.querySelector('#listado-contactos'),
     inputBuscador= document.querySelector('#buscador');

eventListener();

function eventListener(){

     if(listadoContactos){
          listadoContactos.addEventListener('click',eliminarContacto);
     }
    
     formularioContactos.addEventListener('submit', leerFormulario);
     inputBuscador.addEventListener('input',buscarContactos);
}

//BUSCAR CONTACTOS
function buscarContactos(e) {
     const expresion = new RegExp(e.target.value, "i" );
           registros = document.querySelectorAll('tbody tr');
 
           registros.forEach(registro => {
                registro.style.display = 'none';
 
                if(registro.childNodes[1].textContent.replace(/\s/g, " ").search(expresion) != -1 ){
                     registro.style.display = 'table-row';
                }
                numeroContactos();
           })
 }
 function numeroContactos() {
     const totalContactos = document.querySelectorAll('tbody tr'),
          contenedorNumero = document.querySelector('.total-contactos span');

     let total = 0;

     totalContactos.forEach(contacto => {
          if(contacto.style.display === '' || contacto.style.display === 'table-row'){
               total++;
          }
     });

     // console.log(total);
     contenedorNumero.textContent = total;
}

function leerFormulario(e){
     e.preventDefault();
     const nombre = document.querySelector('#nombre').value;
     const empresa = document.querySelector('#empresa').value;
     const telefono = document.querySelector('#telefono').value;
     const accion = document.querySelector('#accion').value;

     if(nombre===''||empresa===''|| telefono===''){
          mostrarNotificacion('Todos los campos son obligatorios','error');
     }else
           var infoContacto = new FormData();
           infoContacto.append('nombre', nombre);
           infoContacto.append('empresa', empresa);
           infoContacto.append('telefono', telefono);
           infoContacto.append('accion', accion);


         // console.log(...infoContacto);
          if(accion==='crear'){
               insertarBD(infoContacto);
          }else{
               const idRegistro = document.querySelector('#id').value;
               infoContacto.append('id',idRegistro);
               actualizarContacto(infoContacto);
          }
                   

}
//ACTUALIZAR CONTACTO
function actualizarContacto(datos){
     console.log(...datos);
     //llamado a ajax
     //crear objeto
     const xhr = new XMLHttpRequest();

     //abrir la conexion
     xhr.open('POST',`modelos/actualizar.php`,true);
     xhr.onload = function(){
          if(xhr.readyState = 4 && xhr.status==200){
               const respuesta=JSON.parse(xhr.responseText);
                    console.log(respuesta);
                         if(respuesta.respuesta=='correcto'){
                              mostrarNotificacion('Se ha modificado correctamente','correcto');
                         }else{
                              
                              mostrarNotificacion('Se ha producido un error','error');
                         }
               //Establecer el tiempo y redireccionar a index
               
               setTimeout(function(){
                    window.location.href='index.php';
               },3000);

                    
          }
     }
     //enviar la peticion
     xhr.send(datos);
     
}


//ELIMINAR CONTACTO

function eliminarContacto(e) {
     if( e.target.parentElement.classList.contains('btn-borrar') ) {
          // tomar el ID
          const id = e.target.parentElement.getAttribute('data-id');
 
          // console.log(id);
          // preguntar al usuario
          const respuesta = confirm('¿Estas seguro/a de que quieres eliminar este contacto?');
 
          if(respuesta) {
               // llamado a ajax
               // crear el objeto
               const xhr = new XMLHttpRequest();
 
               // abrir la conexión
               xhr.open('GET',`modelos/eliminar.php?id=${id}&accion=borrar`, true);
 
               // leer la respuesta
               xhr.onload = function() {
                    if(xhr.readyState = 4 && xhr.status==200){
                         const resultado = JSON.parse(xhr.responseText);
                         console.log(resultado.respuesta);
                         if(resultado.respuesta =='correcto'){
                              mostrarNotificacion('Se ha eliminado correctamente', 'correcto');
                              e.target.parentElement.parentElement.parentElement.remove();
                         }else{
                              mostrarNotificacion('No se ha podido eliminar el contacto', 'error');
                         }
                    }
               }
 
               // enviar la petición
               xhr.send();
          }
     }
 }



//INSERTAR CONTACTO
function insertarBD(datos){

     var xhr = new XMLHttpRequest();

          xhr.open('POST','modelos/insertar.php',true);


          xhr.onload = function(){

               if(xhr.readyState = 4 && xhr.status==200){
                    //console.log(JSON.parse(xhr.responseText))

                    const respuesta=JSON.parse(xhr.responseText);
                    console.log(respuesta.datos);

                    //insertar nuevo elemento a la tabla con AJAX
                     const nuevoContacto = document.createElement('tr')
                     nuevoContacto.innerHTML = `
                         <td class='referencia'>${respuesta.datos.nombre}</td>
                         <td class='referencia'>${respuesta.datos.empresa}</td>
                         <td class='referencia'>${respuesta.datos.telefono}</td>
                     `;

                     //crearcntenedor para los botones
                     const contenedorAcciones = document.createElement('td');
                         

                         contenedorAcciones.classList.add('referencia');

                     //crear el icono de editar
                     const iconoEditar = document.createElement('i');
                     iconoEditar.classList.add('fas','fa-user-edit');

                     //Crear el enlace de editar
                     const btnEditar = document.createElement('a');
                     btnEditar.appendChild(iconoEditar);
                     btnEditar.href =`editar.php?id=${respuesta.id_insertado}`;
                     btnEditar.classList.add('btn-editar');

                     //agregar el 'a' dentro de el 'td'
                     contenedorAcciones.appendChild(btnEditar);

                     //crear el 'i' de eliminar
                     const iconEliminar = document.createElement('i');
                     iconEliminar.classList.add('fas','fa-trash-alt');

                     //crear el 'button' de eliminar
                     const btnEliminar = document.createElement('button');
                     btnEliminar.classList.add('btn-borrar');
                    //agregar 'i' dentro de 'button'
                    btnEliminar.appendChild(iconEliminar);
                    btnEliminar.setAttribute('data-id', respuesta.id_insertado)

                    //agregar 'button' al 'td'
                    contenedorAcciones.appendChild(btnEliminar);
                    //agragar el 'td' al 'tr'
                    nuevoContacto.appendChild(contenedorAcciones);

                    //agregamos todo el tr a listado contactos
                    listadoContactos.appendChild(nuevoContacto);

                    //resetear el formulario
                    document.querySelector('form').reset();
                    //muestra la notificacion 
                    mostrarNotificacion('Se ha realizado correctamente','correcto');
                    console.log(respuesta.id_insertado);
               }
          }

     xhr.send(datos);
}

//MOSTRAR LA NOTIFICACION
function mostrarNotificacion(mensaje,clase){
     const notificacion = document.createElement('div');
     notificacion.classList.add(clase,'notificacion','sombra');
     notificacion.textContent = mensaje;

     formularioContactos.insertBefore(notificacion, document.querySelector('form .div-amarillo'));

     // Ocultar y Mostrar la notificacion
     setTimeout(() => {
          notificacion.classList.add('visible');
          setTimeout(() => {
               notificacion.classList.remove('visible');
               setTimeout(() => {
                    notificacion.remove();
               }, 500)
          }, 3000);
     }, 100);

}



