let btnSiguiente = document.querySelector('#btnSiguiente');
let btnEnviar = document.querySelector('#btnEnviar');
let datosServicio = document.querySelector('#datosServicio');
let datosVehiculo = document.querySelector('#datosVehiculo');

btnSiguiente.addEventListener('click', (e) => {
    e.preventDefault();
    
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
   
    
});