<?php
if (isset($_POST['btncrearmatriz'])) {
	crearMatriz();
}

if (isset($_POST['btnmodificarmatriz'])) {
	modificarmatrizprioridad();
}

function crearMatriz()
{
/*///////////////////////////////////////////////CONDICION 1 //////////////////////////////////////////////////////*/	
	/*CREA LA PRIORIDAD 1 CONDICION 1*/
  $objp1con1=new Prioridad();
  $objp1con1->setnonmbreproridad(1);
  $objp1con1->setpreciocompra($_POST['p1con1compra']);
  $objp1con1->setprecioventa($_POST['p1con1venta']);
  $objp1con1->setpenalizacion($_POST['p1con1penal']);
  $objp1con1->setcondicion(1);
  $objp1con1->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 1*/
  $objp2con1=new Prioridad();
  $objp2con1->setnonmbreproridad(2);
  $objp2con1->setpreciocompra($_POST['p2con1compra']);
  $objp2con1->setprecioventa($_POST['p2con1venta']);
  $objp2con1->setpenalizacion($_POST['p2con1penal']);
  $objp2con1->setcondicion(1);
  $objp2con1->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 1*/
  $objp3con1=new Prioridad();
  $objp3con1->setnonmbreproridad(3);
  $objp3con1->setpreciocompra($_POST['p3con1compra']);
  $objp3con1->setprecioventa($_POST['p3con1venta']);
  $objp3con1->setpenalizacion($_POST['p3con1penal']);
  $objp3con1->setcondicion(1);
  $objp3con1->guardarprioridad();

  /*///////////////////////////////////////////////CONDICION 1 //////////////////////////////////////////////////////*/

  /*///////////////////////////////////////////////CONDICION 2 //////////////////////////////////////////////////////*/	
  /*CREA LA PRIORIDAD 1 CONDICION 2*/
  $objp1con2=new Prioridad();
  $objp1con2->setnonmbreproridad(1);
  $objp1con2->setpreciocompra($_POST['p1con2compra']);
  $objp1con2->setprecioventa($_POST['p1con2venta']);
  $objp1con2->setpenalizacion($_POST['p1con2penal']);
  $objp1con2->setcondicion(2);
  $objp1con2->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 2*/
  $objp2con2=new Prioridad();
  $objp2con2->setnonmbreproridad(2);
  $objp2con2->setpreciocompra($_POST['p2con2compra']);
  $objp2con2->setprecioventa($_POST['p2con2venta']);
  $objp2con2->setpenalizacion($_POST['p2con2penal']);
  $objp2con2->setcondicion(2);
  $objp2con2->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 2*/
  $objp3con2=new Prioridad();
  $objp3con2->setnonmbreproridad(3);
  $objp3con2->setpreciocompra($_POST['p3con2compra']);
  $objp3con2->setprecioventa($_POST['p3con2venta']);
  $objp3con2->setpenalizacion($_POST['p3con2penal']);
  $objp3con2->setcondicion(2);
  $objp3con2->guardarprioridad();

   /*///////////////////////////////////////////////CONDICION 3 //////////////////////////////////////////////////////*/	
  /*CREA LA PRIORIDAD 1 CONDICION 3*/
  $objp1con3=new Prioridad();
  $objp1con3->setnonmbreproridad(1);
  $objp1con3->setpreciocompra($_POST['p1con3compra']);
  $objp1con3->setprecioventa($_POST['p1con3venta']);
  $objp1con3->setpenalizacion($_POST['p1con3penal']);
  $objp1con3->setcondicion(3);
  $objp1con3->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 3*/
  $objp2con3=new Prioridad();
  $objp2con3->setnonmbreproridad(2);
  $objp2con3->setpreciocompra($_POST['p2con3compra']);
  $objp2con3->setprecioventa($_POST['p2con3venta']);
  $objp2con3->setpenalizacion($_POST['p2con3penal']);
  $objp2con3->setcondicion(3);
  $objp2con3->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 3*/
  $objp3con3=new Prioridad();
  $objp3con3->setnonmbreproridad(3);
  $objp3con3->setpreciocompra($_POST['p3con3compra']);
  $objp3con3->setprecioventa($_POST['p3con3venta']);
  $objp3con3->setpenalizacion($_POST['p3con3penal']);
  $objp3con3->setcondicion(3);
  $objp3con3->guardarprioridad();

  /*///////////////////////////////////////////////CONDICION 4 //////////////////////////////////////////////////////*/	
  /*CREA LA PRIORIDAD 1 CONDICION 4*/
  $objp1con4=new Prioridad();
  $objp1con4->setnonmbreproridad(1);
  $objp1con4->setpreciocompra($_POST['p1con4compra']);
  $objp1con4->setprecioventa($_POST['p1con4venta']);
  $objp1con4->setpenalizacion($_POST['p1con4penal']);
  $objp1con4->setcondicion(4);
  $objp1con4->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 4*/
  $objp2con4=new Prioridad();
  $objp2con4->setnonmbreproridad(2);
  $objp2con4->setpreciocompra($_POST['p2con4compra']);
  $objp2con4->setprecioventa($_POST['p2con4venta']);
  $objp2con4->setpenalizacion($_POST['p2con4penal']);
  $objp2con4->setcondicion(4);
  $objp2con4->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 4*/
  $objp3con4=new Prioridad();
  $objp3con4->setnonmbreproridad(3);
  $objp3con4->setpreciocompra($_POST['p3con4compra']);
  $objp3con4->setprecioventa($_POST['p3con4venta']);
  $objp3con4->setpenalizacion($_POST['p3con4penal']);
  $objp3con4->setcondicion(4);
  $objp3con4->guardarprioridad();

  /*///////////////////////////////////////////////CONDICION 5 //////////////////////////////////////////////////////*/	
  /*CREA LA PRIORIDAD 1 CONDICION 5*/
  $objp1con5=new Prioridad();
  $objp1con5->setnonmbreproridad(1);
  $objp1con5->setpreciocompra($_POST['p1con5compra']);
  $objp1con5->setprecioventa($_POST['p1con5venta']);
  $objp1con5->setpenalizacion($_POST['p1con5penal']);
  $objp1con5->setcondicion(5);
  $objp1con5->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 5*/
  $objp2con5=new Prioridad();
  $objp2con5->setnonmbreproridad(2);
  $objp2con5->setpreciocompra($_POST['p2con5compra']);
  $objp2con5->setprecioventa($_POST['p2con5venta']);
  $objp2con5->setpenalizacion($_POST['p2con5penal']);
  $objp2con5->setcondicion(5);
  $objp2con5->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 5*/
  $objp3con5=new Prioridad();
  $objp3con5->setnonmbreproridad(3);
  $objp3con5->setpreciocompra($_POST['p3con5compra']);
  $objp3con5->setprecioventa($_POST['p3con5venta']);
  $objp3con5->setpenalizacion($_POST['p3con5penal']);
  $objp3con5->setcondicion(5);
  $objp3con5->guardarprioridad();

  /*///////////////////////////////////////////////CONDICION 6 //////////////////////////////////////////////////////*/	
  /*CREA LA PRIORIDAD 1 CONDICION 6*/
  $objp1con6=new Prioridad();
  $objp1con6->setnonmbreproridad(1);
  $objp1con6->setpreciocompra($_POST['p1con6compra']);
  $objp1con6->setprecioventa($_POST['p1con6venta']);
  $objp1con6->setpenalizacion($_POST['p1con6penal']);
  $objp1con6->setcondicion(6);
  $objp1con6->guardarprioridad();

  /*CREA LA PRIORIDAD 2 CONDICION 6*/
  $objp2con6=new Prioridad();
  $objp2con6->setnonmbreproridad(2);
  $objp2con6->setpreciocompra($_POST['p2con6compra']);
  $objp2con6->setprecioventa($_POST['p2con6venta']);
  $objp2con6->setpenalizacion($_POST['p2con6penal']);
  $objp2con6->setcondicion(6);
  $objp2con6->guardarprioridad();

  /*CREA LA PRIORIDAD 3 CONDICION 6*/
  $objp1con6=new Prioridad();
  $objp1con6->setnonmbreproridad(3);
  $objp1con6->setpreciocompra($_POST['p3con6compra']);
  $objp1con6->setprecioventa($_POST['p3con6venta']);
  $objp1con6->setpenalizacion($_POST['p3con6penal']);
  $objp1con6->setcondicion(6);
  $objp1con6->guardarprioridad();

  echo "<script > setTimeout(function(){  }, 2000); swal('Exelente','Se Creo La Tabla Matriz Con Exito','success'); </script>";


}

function modificarmatrizprioridad()
{
	/*///////////////////////////////////////////////CONDICION 1 //////////////////////////////////////////////////////*/	
	/*MODIFICA LA PRIORIDAD 1 CONDICION 1*/
  $objp1con1=new Prioridad();
  $objp1con1->setnonmbreproridad(1);
  $objp1con1->setpreciocompra($_POST['p1con1compra']);
  $objp1con1->setprecioventa($_POST['p1con1venta']);
  $objp1con1->setpenalizacion($_POST['p1con1penal']);
  $objp1con1->setcondicion(1);
  $objp1con1->modificarmatrizprioridadM();

   /*MODIFICA LA PRIORIDAD 2 CONDICION 1*/
  $objp2con1=new Prioridad();
  $objp2con1->setnonmbreproridad(2);
  $objp2con1->setpreciocompra($_POST['p2con1compra']);
  $objp2con1->setprecioventa($_POST['p2con1venta']);
  $objp2con1->setpenalizacion($_POST['p2con1penal']);
  $objp2con1->setcondicion(1);
  $objp2con1->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 1*/
  $objp3con1=new Prioridad();
  $objp3con1->setnonmbreproridad(3);
  $objp3con1->setpreciocompra($_POST['p3con1compra']);
  $objp3con1->setprecioventa($_POST['p3con1venta']);
  $objp3con1->setpenalizacion($_POST['p3con1penal']);
  $objp3con1->setcondicion(1);
  $objp3con1->modificarmatrizprioridadM();

  /*///////////////////////////////////////////////CONDICION 1 //////////////////////////////////////////////////////*/

  /*///////////////////////////////////////////////CONDICION 2 //////////////////////////////////////////////////////*/	
  /*MODIFICA LA PRIORIDAD 1 CONDICION 2*/
  $objp1con2=new Prioridad();
  $objp1con2->setnonmbreproridad(1);
  $objp1con2->setpreciocompra($_POST['p1con2compra']);
  $objp1con2->setprecioventa($_POST['p1con2venta']);
  $objp1con2->setpenalizacion($_POST['p1con2penal']);
  $objp1con2->setcondicion(2);
  $objp1con2->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 2 CONDICION 2*/
  $objp2con2=new Prioridad();
  $objp2con2->setnonmbreproridad(2);
  $objp2con2->setpreciocompra($_POST['p2con2compra']);
  $objp2con2->setprecioventa($_POST['p2con2venta']);
  $objp2con2->setpenalizacion($_POST['p2con2penal']);
  $objp2con2->setcondicion(2);
  $objp2con2->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 2*/
  $objp3con2=new Prioridad();
  $objp3con2->setnonmbreproridad(3);
  $objp3con2->setpreciocompra($_POST['p3con2compra']);
  $objp3con2->setprecioventa($_POST['p3con2venta']);
  $objp3con2->setpenalizacion($_POST['p3con2penal']);
  $objp3con2->setcondicion(2);
  $objp3con2->modificarmatrizprioridadM();

   /*///////////////////////////////////////////////CONDICION 3 //////////////////////////////////////////////////////*/	
  /*MODIFICA LA PRIORIDAD 1 CONDICION 3*/
  $objp1con3=new Prioridad();
  $objp1con3->setnonmbreproridad(1);
  $objp1con3->setpreciocompra($_POST['p1con3compra']);
  $objp1con3->setprecioventa($_POST['p1con3venta']);
  $objp1con3->setpenalizacion($_POST['p1con3penal']);
  $objp1con3->setcondicion(3);
  $objp1con3->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 2 CONDICION 3*/
  $objp2con3=new Prioridad();
  $objp2con3->setnonmbreproridad(2);
  $objp2con3->setpreciocompra($_POST['p2con3compra']);
  $objp2con3->setprecioventa($_POST['p2con3venta']);
  $objp2con3->setpenalizacion($_POST['p2con3penal']);
  $objp2con3->setcondicion(3);
  $objp2con3->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 3*/
  $objp3con3=new Prioridad();
  $objp3con3->setnonmbreproridad(3);
  $objp3con3->setpreciocompra($_POST['p3con3compra']);
  $objp3con3->setprecioventa($_POST['p3con3venta']);
  $objp3con3->setpenalizacion($_POST['p3con3penal']);
  $objp3con3->setcondicion(3);
  $objp3con3->modificarmatrizprioridadM();

  /*///////////////////////////////////////////////CONDICION 4 //////////////////////////////////////////////////////*/	
  /*MODIFICA LA PRIORIDAD 1 CONDICION 4*/
  $objp1con4=new Prioridad();
  $objp1con4->setnonmbreproridad(1);
  $objp1con4->setpreciocompra($_POST['p1con4compra']);
  $objp1con4->setprecioventa($_POST['p1con4venta']);
  $objp1con4->setpenalizacion($_POST['p1con4penal']);
  $objp1con4->setcondicion(4);
  $objp1con4->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 2 CONDICION 4*/
  $objp2con4=new Prioridad();
  $objp2con4->setnonmbreproridad(2);
  $objp2con4->setpreciocompra($_POST['p2con4compra']);
  $objp2con4->setprecioventa($_POST['p2con4venta']);
  $objp2con4->setpenalizacion($_POST['p2con4penal']);
  $objp2con4->setcondicion(4);
  $objp2con4->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 4*/
  $objp3con4=new Prioridad();
  $objp3con4->setnonmbreproridad(3);
  $objp3con4->setpreciocompra($_POST['p3con4compra']);
  $objp3con4->setprecioventa($_POST['p3con4venta']);
  $objp3con4->setpenalizacion($_POST['p3con4penal']);
  $objp3con4->setcondicion(4);
  $objp3con4->modificarmatrizprioridadM();

  /*///////////////////////////////////////////////CONDICION 5 //////////////////////////////////////////////////////*/	
  /*MODIFICA LA PRIORIDAD 1 CONDICION 5*/
  $objp1con5=new Prioridad();
  $objp1con5->setnonmbreproridad(1);
  $objp1con5->setpreciocompra($_POST['p1con5compra']);
  $objp1con5->setprecioventa($_POST['p1con5venta']);
  $objp1con5->setpenalizacion($_POST['p1con5penal']);
  $objp1con5->setcondicion(5);
  $objp1con5->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 2 CONDICION 5*/
  $objp2con5=new Prioridad();
  $objp2con5->setnonmbreproridad(2);
  $objp2con5->setpreciocompra($_POST['p2con5compra']);
  $objp2con5->setprecioventa($_POST['p2con5venta']);
  $objp2con5->setpenalizacion($_POST['p2con5penal']);
  $objp2con5->setcondicion(5);
  $objp2con5->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 5*/
  $objp3con5=new Prioridad();
  $objp3con5->setnonmbreproridad(3);
  $objp3con5->setpreciocompra($_POST['p3con5compra']);
  $objp3con5->setprecioventa($_POST['p3con5venta']);
  $objp3con5->setpenalizacion($_POST['p3con5penal']);
  $objp3con5->setcondicion(5);
  $objp3con5->modificarmatrizprioridadM();

  /*///////////////////////////////////////////////CONDICION 6 //////////////////////////////////////////////////////*/	
  /*MODIFICA LA PRIORIDAD 1 CONDICION 6*/
  $objp1con6=new Prioridad();
  $objp1con6->setnonmbreproridad(1);
  $objp1con6->setpreciocompra($_POST['p1con6compra']);
  $objp1con6->setprecioventa($_POST['p1con6venta']);
  $objp1con6->setpenalizacion($_POST['p1con6penal']);
  $objp1con6->setcondicion(6);
  $objp1con6->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 2 CONDICION 6*/
  $objp2con6=new Prioridad();
  $objp2con6->setnonmbreproridad(2);
  $objp2con6->setpreciocompra($_POST['p2con6compra']);
  $objp2con6->setprecioventa($_POST['p2con6venta']);
  $objp2con6->setpenalizacion($_POST['p2con6penal']);
  $objp2con6->setcondicion(6);
  $objp2con6->modificarmatrizprioridadM();

  /*MODIFICA LA PRIORIDAD 3 CONDICION 6*/
  $objp1con6=new Prioridad();
  $objp1con6->setnonmbreproridad(3);
  $objp1con6->setpreciocompra($_POST['p3con6compra']);
  $objp1con6->setprecioventa($_POST['p3con6venta']);
  $objp1con6->setpenalizacion($_POST['p3con6penal']);
  $objp1con6->setcondicion(6);
  $objp1con6->modificarmatrizprioridadM();

  echo "<script > setTimeout(function(){  }, 2000); swal('Exelente','Se Modifico La Tabla Matriz Con Exito','success'); </script>";

}
?>