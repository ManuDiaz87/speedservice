<?php 

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $img = $_FILES['imgPerfil']['name'];
    $imgTmpName = $_FILES['imgPerfil']['tmp_name'];
    $extension = pathinfo($img, PATHINFO_EXTENSION);

    switch ($extension) {
        case 'jpg':
            echo 'ES JPG';
        break;
            
        case 'png':
            echo 'ES PNG';
            break;
        case 'jpeg':
           echo 'ES JPEG';
            break;
        
        default:
            echo 'ERROR INVALIDO';
            break;
    }

    
}


?>

<section>
    <div class="container">
        
        <form action="prueba.php" id="formPrueba"  method="POST" enctype="multipart/form-data">


        <div class="mb-3">
            <label for="imgPerfil">Imagen de perfil:</label>
            <input type="file" class="form-control" id="imgPerfil" name="imgPerfil">
        
        </div>
    <button type="submit" onclick="validar()">Enviar</button>
        </form>
    </div>
</section>

<script>
    function validar() {
  // Obtener nombre de archivo
  let archivo = document.getElementById('imgPerfil').value,
  // Obtener extensión del archivo
      extension = archivo.substring(archivo.lastIndexOf('.'),archivo.length);
      var tam= document.archivo.files[0].size;
      switch (extension) {
        case '.jpg':
           
            alert(tam) ;
        break;
            
        case '.png':
            alert('ES PNG') ;
            break;
        case '.jpeg':
            alert('ES JPEG') ;
            break;
        
        default:
            alert ('ERROR INVALIDO');
            break;
    }
 
      alert(extension);
 
}
    
   
</script>
