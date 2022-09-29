let btnSiguiente = document.querySelector('#btnSiguiente');
let btnEnviar = document.querySelector('#btnEnviar');
btnSiguiente.addEventListener('click', (e) => {
    e.preventDefault();
        let formularioRegistroFletes = document.querySelector('#formRegistroFletes');
        let arrayInputs = formularioRegistroFletes.querySelectorAll('input');
   

        let regexPatente = /(^[a-zA-Z]{3}[-]{0,1}[0-9]{3,4}$)|(^[a-zA-Z]{2}[-]{0,1}[0-9]{3}[a-zA-Z]{1}$)/
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
                arrayInputs[0].parentNode.append(msj);
            }
            banderaForm = false;  
        }else{
            if(arrayInputs[0].nextElementSibling){
                arrayInputs[0].nextElementSibling.remove();
            }
        }

        if(arrayInputs[1].value == ""){
            arrayInputs[1].style.border = "3px solid red";
            
            banderaForm = false;
        
            }
        if(arrayInputs[2].value >2000){
            arrayInputs[2].style.border = "3px solid red";
            
            banderaForm = false;
        
            }
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
                    /** Patentes validas : aaa3333,aaa333,aa333a */
                e.preventDefault();
                    if( !regexPatente.test(arrayInputs[3].value)){
                        arrayInputs[3].style.border = "3px solid red";
                            
                        banderaForm = false;
                        
                    }
                    if(arrayInputs[4].value == ""){
                            arrayInputs[4].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(arrayInputs[5].value == ""){
                            arrayInputs[5].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(arrayInputs[6].value == ""){
                            arrayInputs[6].style.border = "3px solid red";
                            
                            banderaForm = false;
                        
                    }
                    if(banderaForm){
                        formularioRegistroFletes.submit();
                    }
                });
            }            
            

        

});