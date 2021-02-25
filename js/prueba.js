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
                         console.log(resultado);
 
                    }
               }
 
               // enviar la petición
               xhr.send();
          }
     }
 }



function eliminarContacto(e){
    // parent Element es para elegir el elemento padre, para que no seleccione el body, si no el boton
    //(comprobamos que contenga la clase btn-borrar)
    if(e.target.parentElement.classList.contains('btn-borrar')){
        //cogemos el id
         const id= e.target.parentElement.getAttribute('data-id');

         //console.log(id);
         //preguntar al usuario
         const respuesta = confirm('¿Estas seguro/a de que quieres eliminar este contacto?');
        
         if(respuesta){
              //llamado a ajax
              //crear objeto
              const xhr = new XMLHttpRequest();

              //abrir la conexion
              xhr.open('GET',`modelos/modelo-contactos.php?id=${id}&accion=borrar`, true);
              
              //leer la respuesta
              xhr.onload=function(){
                   console.log('no va');
                   if(xhr.readyState = 4 && xhr.status==200){
                        //console.log(JSON.parse(xhr.responseText))
    
                        const resultado=JSON.parse(xhr.responseText);
                        console.log('ENTRA')
                        console.log(resultado);
           
                   }        
              }

              xhr.send();
          }

      } 
    

}