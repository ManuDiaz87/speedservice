let btnSiguiente = document.querySelector('#btnSiguiente');
let btnEnviar = document.querySelector('#btnEnviar');

function validar(archivo,tam) {
    // Recibir nombre de archivo
     // Obtener extensión del archivo
     let extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
    //  var size= tam.files[0].size;
        switch (extension) {
          case '.jpg':
            if(tam > 5242880){
                return false;
            }
            return true ;
          
              
          case '.png':
            if(tam > 5242880){
                return false;
            }
            return true ;
              
          case '.jpeg':
            if(tam > 5242880){
                return false;
            }
            return true ;
              
          
          default:
            return false ;
              
      }
   
        
   
}




btnSiguiente.addEventListener('click', (e) => {
    e.preventDefault();
        let formularioRegistroFletes = document.querySelector('#formRegistroFletes');
        let arrayInputs = formularioRegistroFletes.querySelectorAll('input');
   

        let regexPatente = /(^[a-zA-Z]{3}[-]{0,1}[0-9]{3,4}$)|(^[a-zA-Z]{2}[-]{0,1}[0-9]{3}[a-zA-Z]{1}$)|(^[a-zA-Z]{2}[-]{0,1}[0-9]{3}[a-zA-Z]{2}$)/;
        console.log(arrayInputs);
       
        arrayInputs.forEach(element => {
            element.style.border = '1px solid #ced4da';
        });
        let banderaForm = true;

        if(arrayInputs[0].value.length <= 5){
            arrayInputs[0].style.border = "3px solid red";
            if(!arrayInputs[0].nextElementSibling){
                let msj = document.createElement('p');
                msj.textContent = "Debe ser mayor a 5 caracteres.";
                msj.style.backgroundColor = 'red';
                arrayInputs[0].parentNode.append(msj);
            }
            banderaForm = false;  
        }else{
            if(arrayInputs[0].nextElementSibling){
                arrayInputs[0].nextElementSibling.remove();
                banderaForm = true;
            }
        }

        if(arrayInputs[1].value == ""){
            arrayInputs[1].style.border = "3px solid red";
            
            banderaForm = false;
        
        }else{
            if(arrayInputs[1].nextElementSibling){
                arrayInputs[1].nextElementSibling.remove();
                banderaForm = true;
            }
        }
        // if(arrayInputs[2].value >2000|arrayInputs[2].value < 1){
        //     arrayInputs[2].style.border = "3px solid red";
        //     if(!arrayInputs[2].nextElementSibling){
        //         let msj = document.createElement('p');
        //         msj.textContent = "El alcance debe ser mayor a 0 y menor a 2000km.";
        //         msj.style.backgroundColor = 'red';
        //         arrayInputs[2].parentNode.append(msj);
        //     }
        //     banderaForm = false;
        // }else{
        //     if(arrayInputs[2].nextElementSibling){
        //         arrayInputs[2].nextElementSibling.remove();
        //         banderaForm = true;
        //     }

            
        
        //     }
        if(banderaForm == true)
           {
                let datosServicio = document.querySelector('#datosServicio');
                let datosVehiculo = document.querySelector('#datosVehiculo');

                datosServicio.classList.toggle('opacity-0');
                
                
                setTimeout(() => {
                    datosServicio.classList.toggle('d-none');
                },"300")

                setTimeout(() => {
                    datosVehiculo.classList.toggle('d-none');
                },"470")
                
                setTimeout(() => {
                    datosVehiculo.classList.toggle('opacity-0');
                    datosVehiculo.classList.toggle('opacity-100');
                    e.target.remove();
                    btnEnviar.classList.toggle('d-none'); 
                },"500") 
                btnEnviar.addEventListener('click', (e) => {
                    /** Patentes validas : aaa3333,aaa333,aa333a,aa333aa */
                    
                e.preventDefault();
                    if( !regexPatente.test(arrayInputs[2].value)){
                        arrayInputs[2].style.border = "3px solid red";
                        if(!arrayInputs[2].nextElementSibling){
                            let msj = document.createElement('p');
                            msj.textContent = "La patente ingresada no es válida.";
                            msj.style.backgroundColor = 'red';
                            arrayInputs[2].parentNode.append(msj);
                        }
                        banderaForm = false;
                    }else{
                        if(arrayInputs[2].nextElementSibling){
                            arrayInputs[2].nextElementSibling.remove();
                            banderaForm = true;
                        }
                        
                    }
                    if(arrayInputs[3].value == ""){
                            arrayInputs[3].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(!validar(arrayInputs[4].value,arrayInputs[5].files[0].size)){
                            arrayInputs[4].style.border = "3px solid red";
                            
                            if(!arrayInputs[4].nextElementSibling){
                                let msj = document.createElement('p');
                                msj.textContent = "El formato o tamaño de la imagen es incorrecto.";
                                msj.style.backgroundColor = 'red';
                                arrayInputs[4].parentNode.append(msj);
                            }
                            banderaForm = false;
                        }else{
                            if(arrayInputs[4].nextElementSibling){
                                arrayInputs[4].nextElementSibling.remove();
                                banderaForm = true;
                            }
                        
                    }
                    if(!validar(arrayInputs[5].value)){
                        arrayInputs[5].style.border = "3px solid red";
                        
                        if(!arrayInputs[5].nextElementSibling){
                            let msj = document.createElement('p');
                            msj.textContent = "El formato o tamaño de la imagen es incorrecto.";
                            msj.style.backgroundColor = 'red';
                            arrayInputs[5].parentNode.append(msj);
                        }
                        banderaForm = false;
                    }else{
                        if(arrayInputs[5].nextElementSibling){
                            arrayInputs[5].nextElementSibling.remove();
                            banderaForm = true;
                        }
                    
                }
                    if(banderaForm){
                        formularioRegistroFletes.submit();
                    }
                });
            }            
            

        

});