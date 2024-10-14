 <!DOCTYPE html>
 <html>
 <head>
 	<title></title>
 </head>
 <body onload="cargarsettime()">
 
 </body>
 </html>

 <script src="../js/sweet-alert.min.js"></script>  
    <link rel="stylesheet" href="../css/sweet-alert.css">
<?php
if (isset($_POST['btnguardarfile'])) 
{
	guardarArchivoenDirectorio();
}

function guardarArchivoenDirectorio()
{
	$linkdecarpeta=$_POST['textlincarpeta'];/*el nombre da la carpeta del tribunal en la causa*/
	$archivo=$_FILES['filecuerpoexpediente']['name'];
	$ruta=$_FILES['filecuerpoexpediente']['tmp_name'];/*el nombre temporal del archivo*/
	$destino="../expedientes/".$linkdecarpeta."/".$archivo;/*la ruta con el archivo a guardarse*/

	/*****************CODIGO PARA GENERAR EL LINK *******************/
    $host= $_SERVER["HTTP_HOST"];
    $url= $_SERVER["REQUEST_URI"];
    $urlresumen='/expedientes/'.$linkdecarpeta.'/'.$archivo;
   // echo "http://" . $host . $url;echo "<br>";
   // echo $url;
   $urlcompleto=$host.$urlresumen;
    
   echo '<div id="copiartexto" style="display:none">
         <p id="textcopy">'.$urlcompleto.'</p>
         </div>

         ';

   if (file_exists($destino)) 
   {
   	 echo "<script > setTimeout(function(){  }, 3000); swal('ERROR','YA HAY UN ARCHIVO CON ESTE NOMBRE, ','warning'); 
   	   </script>";

   	   echo "
   	   <script>
   	   function cargarsettime()
       {
        setTimeout('redireccionar()',3000);
       }

   	   </script>

       <script type='text/javascript'>
	      function redireccionar()
	      {
	        window.close();
	      }
      </script>

   	   ";
   }
   else
   {


		if (copy($ruta,$destino)) 
		 {
		   echo "<script > setTimeout(function(){ // Crea un campo de texto 'oculto'
			  var aux = document.createElement('input');

			  // Asigna el contenido del elemento especificado al valor del campo
			  aux.setAttribute('value', document.getElementById('textcopy').innerHTML);

			  // Añade el campo a la página
			  document.body.appendChild(aux);

			  // Selecciona el contenido del campo
			  aux.select();

			  // Copia el texto seleccionado
			  document.execCommand('copy');

			  // Elimina el campo de la página
			  document.body.removeChild(aux);
			 location.href='http://$urlcompleto'	
			   }, 2000); swal('EXELENTE','Se Subio El Archivo Con Exito, Esta siendo direccionado...','success'); </script>";


			    
		 }
		 else
		 {
		 	 echo "<script > setTimeout(function(){  }, 2000); swal('ERROR','No Se Subio El Archivo','warning'); </script>";
		 } 
    }
}
?>

<!--FUNCION  EN JAVA SCRIPT PARA COPIAR EL LINK DESPUES DE PRESIONAR EL BOTON *************************** -->


<script type="text/javascript" src="../resources/jquery.js"></script>