<?php
/* @var $this UsuariosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Usuarioses',
);

/*$this->menu=array(
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>

<br>
<h2>Proceso para migrar usuarios</h2>
<br>

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">

      	
      </div>    
    </div>
        <!-- ./row -->
  </div>
 </section>  


<!-- ########################################################################## -->
<!-- ########################################################################## -->
<!-- EN CASO DE QUE LOS CONTADORES SEAN CERO SE PROCEDE CON LA MIGRACION DE LA TABLÑA SEGUIMIENTO -->

<br><br>
<center>
<h4><b> 
EN CASO DE QUE LOS DOS CONTADORES SEAN CERO SE 
PROCEDE CON LA MIGRACION DEL SEGUIMIENTO
</b></h4>
</center>

<table width="80%" border="1">
	<thead>
		<tr>
			<td>codigo</td>
			<td>derivado_por</td>
			<td>derivado_a</td>
			<td>derivado_por</td>
			<td>fecha_derivacion</td>
			<td>hora_derivacion</td>
			<td>fecha_recepcion</td>
			<td>hora_recepcion</td>
			<td>estado</td>
			<td>accion</td>
			<td>proveido</td>
			<td>padre</td>
			<td>oficial</td>
			<td>hijo</td>
			
		</tr>
	</thead>

 <?php 
 $j=0;
//  codigo para obtener todos los datos de la tabla usuario MySQL 
//  del servidor 192.168.4.52
$dataReader=Usuarios::getSeguimientoSiaco(); 
//print_r($dataReader);
foreach ($dataReader as $row) { 
	$j++;
	$codigo=$row['codigo'];
	$derivado_por=trim($row['derivado_por']);

	//codigo para obtener el usuario a partir de la columna alias o usuario 
	// en la base de datos MySql
	$usuario_por=Usuarios::getUsuarioMysql($derivado_por);
	$der_por=Usuarios::getUsuarioPostgres($usuario_por);

	$derivado_a=trim($row['derivado_a']);
	$usuario_a=Usuarios::getUsuarioMysql($derivado_a);
	$der_a=Usuarios::getUsuarioPostgres($usuario_a);


		
	$f_derivacion=explode(' ', $row['f_derivacion']);
	$fecha_derivacion=$f_derivacion[0];
	$hora_derivacion=$f_derivacion[1];

	$f_recepcion=explode(' ', $row['f_recepcion']);
	$fecha_recepcion=$f_recepcion[0];
	$hora_recepcion=$f_recepcion[1];

	if ($fecha_recepcion=='0000-00-00') {
		$fecha_recepcion='1000-01-01';
	}

	$estado=trim($row['estado']);
	$accion=trim($row['accion']);
	$proveido=trim($row['observaciones']);
	$padre=trim($row['padre']);
	$oficial=trim($row['oficial']);
	$hijo=trim($row['hijo']);

	if ($estado==3) {	$estado=1;	}

	if ($estado==2) {	$estado=3;	}

	if ($estado==50) {	$estado=2;	}
	
	
		//codigo para almacenar en la base de datos postgres los usuarios
		//almacenados en la base MySQL
		$seguimientos= new Seguimientos();
		$seguimientos->codigo=$codigo;
		$seguimientos->derivado_por=$der_por;
		$seguimientos->derivado_a=$der_a;
		$seguimientos->proveido=$proveido;
		$seguimientos->fecha_derivacion=$fecha_derivacion;
		$seguimientos->hora_derivacion=$hora_derivacion;
		$seguimientos->fecha_recepcion=$fecha_recepcion;
		$seguimientos->hora_recepcion=$hora_recepcion;
		$seguimientos->fk_accion=1;
		$seguimientos->fk_estado=$estado;
		$seguimientos->padre=0;
		$seguimientos->oficial=$oficial;
		$seguimientos->hijo=0;
		$seguimientos->fecha_registro=date('Y-m-d');
		$seguimientos->hora_registro=date('H:i:s');
		$seguimientos->gestion=2018;
		$seguimientos->confirmado=1;
		$seguimientos->activo=1;
		$seguimientos->fk_grupo_derivacion=0;
		$seguimientos->fk_principal_agrupacion=0;
		$seguimientos->observado=0;
		$seguimientos->insert();

	// codigo para obtener los cites asociados al nuri
	// tambien se obtendran el tipo documento y usuario	
?>

<tr>
	<td><?=$j?></td>
	<td><?=$codigo?></td>
	<td ><?=$derivado_por?> <b><?=$der_por?></b></td>
	<td ><?=$derivado_a?> <b><?=$der_a?></b></td>
	<td><?=$fecha_derivacion?></td>
	<td><?=$hora_derivacion?></td>
	<td><?=$fecha_recepcion?></td>
	<td><?=$hora_recepcion?></td>
	<td><?=$estado?></td>
	<td><?=$accion?></td>
	<td><?=$proveido?></td>
	<td><?=$padre?></td>
	<td><?=$oficial?></td>
	<td><?=$hijo?></td>
	
</tr>


<?php 
} //foreach ($dataReader as $row) { 
?>
</table>






