<?php
//error_reporting(E_ERROR);
//session_start();
/*if(!isset($_SESSION["useradmin"]))
{
  header("location:index.php");
}*/
$datos=$_SESSION["useradmin"];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Matriz de Cotizacion</title>
    <link rel="shortcut icon" type="image/x-icon" href="resources/logoserrate3.jfif">
    <link rel="stylesheet" type="text/css" href="resources/menu.css">
    <link rel="stylesheet" type="text/css" href="resources/tabla.css">
    
     <link rel="stylesheet" type="text/css" href="resources/tablamatriz.css">
    <link rel="stylesheet" type="text/css" href="resources/font-awesome-4.7.0/css/font-awesome.min.css">

    <script src="js/sweet-alert.min.js"></script>  
<link rel="stylesheet" href="css/sweet-alert.css">
     <script src="js/jquery.js"></script>
     <script src="js/bootstrap.min.js"></script>

  
</head>
<body>
<?php

include_once('model/clsprioridad.php');
include_once('controller/control-matriz.php');
?>
    <div id="header">
        
        <div class="container">
        
        <?php
        include_once('model/clscajasdesalida.php');
        $objimg=new Cajasdesalida();
        $resulimg=$objimg->mostrarImagenIndex();
        $filimg=mysqli_fetch_object($resulimg);
        if ($filimg->imagenindex=='') 
        {
          echo '<img src="resources/logo.jpg" class="logo">';
        }
        else
        {
          echo "<img src='fotos/imagenindex/$filimg->imagenindex' class='logo'>";
        }

        ?>
        
       <div id="main_menu_admin">
            <ul>
               
                 <li class="first_listleftadm"><a href="cerrarSesion.php" class="main_menu_first">SALIR</a></li>
                 <li class="first_listleftadm"><a href="causasActivas.php" class="main_menu_first ">CAUSAS ACTIVAS</a></li>
                  <li class="first_listleftadm"><a href="matriz.php"  class="main_menu_first main_current">MATRIZ COTIZACIONES</a></li>
                
                <li class="first_listleftadm"><a href="usuarios.php" class="main_menu_first">USUARIOS</a></li>
                <li class="first_listleftadm"><a href="avancefisico.php" class="main_menu_first">AVANCE FISICO</a></li>
               
                
                 <li  class="" style="float: left; margin: 0 14px; width: 475px;"><a >USUARIO:<?php echo $datos['nombreusuario']; ?>  TIPO:Administrador</a></li>
            </ul>
         
        </div> <!-- FIN MENU 1 -->
    
        </div> <!-- FIN container -->
    
    </div> <!-- FIN header -->


    <div id="main_content">
            
        <div id="portfolio_area">
        </div>
   </div>
   

    <!--TABLA CAUSAS ACTIVAS las condiciones se leen de arriba hacia abajo
   ES DECIR: 
   condicon 1:
   condicon 2:
   condicon 3:
   condicon 4:
   condicon 5:
   condicon 6:
    -->
    

    <h3 style="color: #000000;font-size: 25px;text-align: center;">MATRIZ</h3><br>
    <form method="post">
    <div class="container">
     <table id="tablamatriz">
       <thead>
         
       </thead>
       <tr id="fila1">
           <th id="tdorden" rowspan="2">CONDICION</th>
           <th id="tdorden" colspan="3">COMPRA DE PROCURADORIA</th>
           <th id="tdorden" colspan="3">VENTA DE PROCURADORIA</th>
           <th id="tdorden" colspan="3">PENALIZACION DE PROCURADORIA</th>
         </tr>
           <tr id="fila2">
             <td id="tdorden">PRIORIDAD 1</td>
             <td id="tdorden">PRIORIDAD 2</td>
             <td id="tdorden">PRIORIDAD 3</td>
             <td id="tdorden">PRIORIDAD 1</td>
             <td id="tdorden">PRIORIDAD 2</td>
             <td id="tdorden">PRIORIDAD 3</td>
             <td id="tdorden">PRIORIDAD 1</td>
             <td id="tdorden">PRIORIDAD 2</td>
             <td id="tdorden">PRIORIDAD 3</td>
           </tr>

       <?php //LISTADO DE CONDICION  1 ,(LA CONDICION 1 ES 96)  
       $objprioridad11=new Prioridad();// PRIORIDAD 1
      $listprio11=$objprioridad11->listaunaprioridad(1,1);
      $p1con1=mysqli_fetch_object($listprio11);

      $objprioridad21=new Prioridad();// PRIORIDAD  2
      $listprio21=$objprioridad21->listaunaprioridad(2,1);
      $p2con1=mysqli_fetch_object($listprio21);

      $objprioridad31=new Prioridad(); //PRIORIDAD 3
      $listprio31=$objprioridad31->listaunaprioridad(3,1);
      $p3con1=mysqli_fetch_object($listprio31);


       ?>

           <tr style="background: #D0E2D1;">
             <td>mas de 96 horas</td>
             <td><input  type="number" name="p1con1compra" value="<?php echo $p1con1->preciocompra ?>"></td>
             <td><input  type="number" name="p2con1compra" value="<?php echo $p2con1->preciocompra ?>"></td>
             <td><input  type="number" name="p3con1compra" value="<?php echo $p3con1->preciocompra ?>"></td>

             <td><input  type="number" name="p1con1venta" value="<?php echo $p1con1->precioventa ?>"></td>
             <td><input  type="number" name="p2con1venta" value="<?php echo $p2con1->precioventa ?>"></td>
             <td><input  type="number" name="p3con1venta" value="<?php echo $p3con1->precioventa ?>"></td>

             <td><input  type="number" name="p1con1penal" value="<?php echo $p1con1->penalizacion ?>"></td>
             <td><input  type="number" name="p2con1penal" value="<?php echo $p2con1->penalizacion ?>"></td>
             <td><input  type="number" name="p3con1penal" value="<?php echo $p3con1->penalizacion ?>"></td>
           </tr>

           <?php  //Listado de condicion 2 (CONDICION 2 ES DE 24 A 96)
       $objprioridad12=new Prioridad();//prioridad 1
      $listprio12=$objprioridad12->listaunaprioridad(1,2);
      $p1con2=mysqli_fetch_object($listprio12);

      $objprioridad22=new Prioridad();//prioridad 2
      $listprio22=$objprioridad22->listaunaprioridad(2,2);
      $p2con2=mysqli_fetch_object($listprio22);

      $objprioridad32=new Prioridad();// prioridad 3
      $listprio32=$objprioridad32->listaunaprioridad(3,2);
      $p3con2=mysqli_fetch_object($listprio32);


       ?>

           <tr style="background: #42A4D2;">
             <td>de 24 a 96 horas</td>
             <td><input  type="number" name="p1con2compra" value="<?php echo $p1con2->preciocompra ?>"></td>
             <td><input  type="number" name="p2con2compra" value="<?php echo $p2con2->preciocompra ?>"></td>
             <td><input  type="number" name="p3con2compra" value="<?php echo $p3con2->preciocompra ?>"></td>

             <td><input  type="number" name="p1con2venta" value="<?php echo $p1con2->precioventa ?>"></td>
             <td><input  type="number" name="p2con2venta" value="<?php echo $p2con2->precioventa ?>"></td>
             <td><input  type="number" name="p3con2venta" value="<?php echo $p3con2->precioventa ?>"></td>

             <td><input  type="number" name="p1con2penal" value="<?php echo $p1con2->penalizacion ?>"></td>
             <td><input  type="number" name="p2con2penal" value="<?php echo $p2con2->penalizacion ?>"></td>
             <td><input  type="number" name="p3con2penal" value="<?php echo $p3con2->penalizacion ?>"></td>
           </tr>

           <?php  //Listado de condicion 3(ES DE 8 A 24)
       $objprioridad13=new Prioridad();//prioridad 1
      $listprio13=$objprioridad13->listaunaprioridad(1,3);
      $p1con3=mysqli_fetch_object($listprio13);

      $objprioridad23=new Prioridad();//prioridad 2
      $listprio23=$objprioridad23->listaunaprioridad(2,3);
      $p2con3=mysqli_fetch_object($listprio23);

      $objprioridad33=new Prioridad();// prioridad 3
      $listprio33=$objprioridad33->listaunaprioridad(3,3);
      $p3con3=mysqli_fetch_object($listprio33);

       ?>

           <tr style="background: #39B743;">
             <td>de 8 a 24 horas</td>
             <td><input  type="number" name="p1con3compra" value="<?php echo $p1con3->preciocompra ?>"></td>
             <td><input  type="number" name="p2con3compra" value="<?php echo $p2con3->preciocompra ?>"></td>
             <td><input  type="number" name="p3con3compra" value="<?php echo $p3con3->preciocompra ?>"></td>

             <td><input  type="number" name="p1con3venta" value="<?php echo $p1con3->precioventa ?>"></td>
             <td><input  type="number" name="p2con3venta" value="<?php echo $p2con3->precioventa ?>"></td>
             <td><input  type="number" name="p3con3venta" value="<?php echo $p3con3->precioventa ?>"></td>

             <td><input  type="number" name="p1con3penal" value="<?php echo $p1con3->penalizacion ?>"></td>
             <td><input  type="number" name="p2con3penal" value="<?php echo $p2con3->penalizacion ?>"></td>
             <td><input  type="number" name="p3con3penal" value="<?php echo $p3con3->penalizacion ?>"></td>
           </tr>
       <?php  //Listado de condicion 4 (3 A 8)
       $objprioridad14=new Prioridad();//prioridad 1
      $listprio14=$objprioridad14->listaunaprioridad(1,4);
      $p1con4=mysqli_fetch_object($listprio14);

      $objprioridad24=new Prioridad();//prioridad 2
      $listprio24=$objprioridad24->listaunaprioridad(2,4);
      $p2con4=mysqli_fetch_object($listprio24);

      $objprioridad34=new Prioridad();// prioridad 3
      $listprio34=$objprioridad34->listaunaprioridad(3,4);
      $p3con4=mysqli_fetch_object($listprio34);

       ?>

           <tr style="background: #F5EB0F;">
             <td>de 3 a 8 horas</td>
             <td><input  type="number" name="p1con4compra" value="<?php echo $p1con4->preciocompra ?>"></td>
             <td><input  type="number" name="p2con4compra" value="<?php echo $p2con4->preciocompra ?>"></td>
             <td><input  type="number" name="p3con4compra" value="<?php echo $p3con4->preciocompra ?>"></td>

             <td><input  type="number" name="p1con4venta" value="<?php echo $p1con4->precioventa ?>"></td>
             <td><input  type="number" name="p2con4venta" value="<?php echo $p2con4->precioventa ?>"></td>
             <td><input  type="number" name="p3con4venta" value="<?php echo $p3con4->precioventa ?>"></td>

             <td><input  type="number" name="p1con4penal" value="<?php echo $p1con4->penalizacion ?>"></td>
             <td><input  type="number" name="p2con4penal" value="<?php echo $p2con4->penalizacion ?>"></td>
             <td><input  type="number" name="p3con4penal" value="<?php echo $p3con4->penalizacion ?>"></td>
           </tr>

            <?php  //Listado de condicion 5 (1 A 3)
       $objprioridad15=new Prioridad();//prioridad 1
      $listprio15=$objprioridad15->listaunaprioridad(1,5);
      $p1con5=mysqli_fetch_object($listprio15);

      $objprioridad25=new Prioridad();//prioridad 2
      $listprio25=$objprioridad25->listaunaprioridad(2,5);
      $p2con5=mysqli_fetch_object($listprio25);

      $objprioridad35=new Prioridad();// prioridad 3
      $listprio35=$objprioridad35->listaunaprioridad(3,5);
      $p3con5=mysqli_fetch_object($listprio35);

       ?>

           <tr style="background: #F5860F;">
             <td>de 1 a 3 horas</td>
             <td><input  type="number" name="p1con5compra" value="<?php echo $p1con5->preciocompra ?>"></td>
             <td><input  type="number" name="p2con5compra" value="<?php echo $p2con5->preciocompra ?>"></td>
             <td><input  type="number" name="p3con5compra" value="<?php echo $p3con5->preciocompra ?>"></td>

             <td><input  type="number" name="p1con5venta" value="<?php echo $p1con5->precioventa ?>"></td>
             <td><input  type="number" name="p2con5venta" value="<?php echo $p2con5->precioventa ?>"></td>
             <td><input  type="number" name="p3con5venta" value="<?php echo $p3con5->precioventa ?>"></td>

             <td><input  type="number" name="p1con5penal" value="<?php echo $p1con5->penalizacion ?>"></td>
             <td><input  type="number" name="p2con5penal" value="<?php echo $p2con5->penalizacion ?>"></td>
             <td><input  type="number" name="p3con5penal" value="<?php echo $p3con5->penalizacion ?>"></td>
           </tr>

                   <?php  //Listado de condicion 6 (0 A 1)
       $objprioridad16=new Prioridad();//prioridad 1
      $listprio16=$objprioridad16->listaunaprioridad(1,6);
      $p1con6=mysqli_fetch_object($listprio16);

      $objprioridad26=new Prioridad();//prioridad 2
      $listprio26=$objprioridad26->listaunaprioridad(2,6);
      $p2con6=mysqli_fetch_object($listprio26);

      $objprioridad36=new Prioridad();// prioridad 3
      $listprio36=$objprioridad36->listaunaprioridad(3,6);
      $p3con6=mysqli_fetch_object($listprio36);

       ?>

           <tr style="background: red;">
             <td>de 0 a 1 hora</td>
             <td><input  type="number" name="p1con6compra" value="<?php echo $p1con6->preciocompra ?>"></td>
             <td><input  type="number" name="p2con6compra" value="<?php echo $p2con6->preciocompra ?>"></td>
             <td><input  type="number" name="p3con6compra" value="<?php echo $p3con6->preciocompra ?>"></td>

             <td><input  type="number" name="p1con6venta" value="<?php echo $p1con6->precioventa ?>"></td>
             <td><input  type="number" name="p2con6venta" value="<?php echo $p2con6->precioventa ?>"></td>
             <td><input  type="number" name="p3con6venta" value="<?php echo $p3con6->precioventa ?>"></td>

             <td><input  type="number" name="p1con6penal" value="<?php echo $p1con6->penalizacion ?>"></td>
             <td><input  type="number" name="p2con6penal" value="<?php echo $p2con6->penalizacion ?>"></td>
             <td><input  type="number" name="p3con6penal" value="<?php echo $p3con6->penalizacion ?>"></td>
           </tr>

       <tbody>
         

      
       </tbody>
     </table>
     <?php
     $obpp=new Prioridad();
     $resulpp=$obpp->mostrarConteoRegistros();
     $filpp=mysqli_fetch_object($resulpp);
     if ($filpp->totalregistrosmatriz>1) {
       echo '<input type="submit" name="btnmodificarmatriz" value="MODIFICAR MATRIZ"> ';
     }
     else
      echo '<input type="submit" name="btncrearmatriz" value="CREAR MATRIZ">';
     ?>
     
    </div><br>
    </form>


     

    <br>
    <br>
    <br>

<script type="text/javascript" src="resources/jquery.js"></script>
</body>
</html>
