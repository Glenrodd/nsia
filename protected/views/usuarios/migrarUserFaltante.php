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




<!-- ############################################################################# -->
<!-- #############################  MIGRAR SEGUIMIENTO ########################### -->
<!-- ############################################################################# -->


<!-- ################################################################## -->
<!-- 
	codigo para encontrar usuarios no registrados en la base de datos postgres 
	eso quiere decir que los usuarios estan dados de baja en la base de datos mysql
-->

<!-- columna derivado_por -->
<b>DERIVADO POR</b>
<table width="80%" border="1">
	<thead>
		<tr>
			<td>ID</td>
			<td>codigo</td>
			<td>derivado_por</td>
			<td>derivado_a</td>
			<td>proveido</td>
		</tr>
	</thead>

 <?php 
 //  codigo para obtener todos los datos de la tabla usuario MySQL 
//  del servidor 192.168.4.152
$dataReader=Usuarios::getSeguimientoSiaco(); 
//print_r($dataReader);

$contador_por=0;
foreach ($dataReader as $row) { 

	$codigo=$row['codigo'];
	$proveido=trim($row['observaciones']);
	$derivado_por=trim($row['derivado_por']);
	$derivado_a=trim($row['derivado_a']);
	//codigo para obtener el usuario a partir de la columna alias o usuario 
	// en la base de datos MySql
	$usuario_por=Usuarios::getUsuarioMysql($derivado_por);
	$der_por=Usuarios::getUsuarioPostgres($usuario_por);

	if ($der_por=='') {
		$color1='style="background:red;"';
		$contador_por++;

		// codigo para importar a la base postgres los usuarios dados de baja
		$row_user=Usuarios::getUserMySQL($usuario_por);
		
		$usuarios= new Usuarios();
		$usuarios->nombre=strtoupper(trim($row_user['nombre']));
		$usuarios->cargo=strtoupper(trim($row_user['cargo']));
		$usuarios->usuario=trim($row_user['id_usuario']);
		$usuarios->password='00000';
		$usuarios->correo=trim($row_user['email']);
		$usuarios->mosca=trim($row_user['mosca']);
		$usuarios->fk_perfil=4;
		$usuarios->fk_regional=1;
		$usuarios->fk_area=1;
		$usuarios->fk_nivel=2;
		$usuarios->fecha_registro=date('Y-m-d');
		$usuarios->hora_registro=date('H:i:s');
		$usuarios->update_password=date('Y-m-d H:i:s');
		$usuarios->activo=0;
		$usuarios->area_sad=0;
		$usuarios->insert();

	}
	else{ $color1=''; }
?>

<?php
if ($der_por=='') { ?>
<tr>
	<td><?=$contador_por?></td>
	<td><?=$codigo?></td>
	<td <?=$color1?> ><?=$derivado_por?> <b><?=$der_por?></b></td>
	<td><?=$derivado_a?></td>
	<td style="font-size: 8px;"><?=$proveido?></td>	
</tr>
<?php
	 }?>
<?php 
}
?>
</table>
<?php echo "<br> contador derivado por ->".$contador_por; ?>


<!-- ########################################################################### -->
<!-- columna derivado_a -->
<br><br>
<b>DERIVADO A</b>
<table width="80%" border="1">
	<thead>
		<tr>
			<td>ID</td>
			<td>codigo</td>
			<td>derivado_por</td>
			<td>derivado_a</td>
			<td>proveido</td>
		</tr>
	</thead>

 <?php 
//  codigo para obtener todos los datos de la tabla usuario MySQL 
//  del servidor 192.168.4.152
$dataReader=Usuarios::getSeguimientoSiaco(); 
//print_r($dataReader);

$contador_a=0;
foreach ($dataReader as $row) { 

	$codigo=$row['codigo'];
	$proveido=trim($row['observaciones']);
	$derivado_por=trim($row['derivado_por']);
	$derivado_a=trim($row['derivado_a']);

	$usuario_a=Usuarios::getUsuarioMysql($derivado_a);
	$der_a=Usuarios::getUsuarioPostgres($usuario_a);

	if ($der_a=='') {
		$color2='style="background:blue;"'; $contador_a++;

		// codigo para importar a la base postgres los usuarios dados de baja
		$row_user=Usuarios::getUserMySQL($usuario_por);
		
		$usuarios= new Usuarios();
		$usuarios->nombre=strtoupper(trim($row_user['nombre']));
		$usuarios->cargo=strtoupper(trim($row_user['cargo']));
		$usuarios->usuario=trim($row_user['id_usuario']);
		$usuarios->password='00000';
		$usuarios->correo=trim($row_user['email']);
		$usuarios->mosca=trim($row_user['mosca']);
		$usuarios->fk_perfil=4;
		$usuarios->fk_regional=1;
		$usuarios->fk_area=1;
		$usuarios->fk_nivel=2;
		$usuarios->fecha_registro=date('Y-m-d');
		$usuarios->hora_registro=date('H:i:s');
		$usuarios->update_password=date('Y-m-d H:i:s');
		$usuarios->activo=0;
		$usuarios->area_sad=0;
		$usuarios->insert();
	}
	else{ $color2=''; }

?>

<?php
if ($der_a=='') { ?>
<tr>
	<td><?=$contador_a?></td>
	<td><?=$codigo?></td>
	<td><?=$derivado_por?></td>
	<td <?=$color2?> ><?=$derivado_a?> <b><?=$der_a?></b></td>
	<td style="font-size: 8px;"><?=$proveido?></td>	
</tr>
<?php
	 }?>
<?php 
}
?>
</table>


<?php echo "<br> contador derivado a ->".$contador_a; ?>


<!-- ############################################################## -->
<!-- ############################################################## -->
<!-- ############################################################## -->
<!-- 
	CODIGO PARA VERIFICAR QUE SE IMPORTRARON TODOS LOS USUARIOS NECESARIOS
	A LA BASE DE DATOS POSTGRES
 -->

 <!-- columna derivado_por -->
<br><br>
<center>
<h4><b> 
BLOQUE PARA COMPROBAR QUE TODOS LOS USUARIOS FALTANTES FUERON 
IMPORTADOS CORRECTAMENTE EN LA BASE DE DATOS POSTGRES
</b></h4>
</center>
<b>DERIVADO POR</b>
<?php 
 
$dataReader=Usuarios::getSeguimientoSiaco(); 

$contador_por=0;
foreach ($dataReader as $row) { 

	$codigo=$row['codigo'];
	$proveido=trim($row['observaciones']);
	$derivado_por=trim($row['derivado_por']);
	$derivado_a=trim($row['derivado_a']);
	//codigo para obtener el usuario a partir de la columna alias o usuario 
	// en la base de datos MySql
	$usuario_por=Usuarios::getUsuarioMysql($derivado_por);
	$der_por=Usuarios::getUsuarioPostgres($usuario_por);

	if ($der_por=='') {	$contador_por++; }
}
?>
</table>
<?php echo "<br> contador derivado por ->".$contador_por; ?>


<!-- ########################################################################### -->
<!-- columna derivado_a -->
<br><br>
<b>DERIVADO A</b>
 <?php 
//  codigo para obtener todos los datos de la tabla usuario MySQL 
//  del servidor 192.168.4.152
$dataReader=Usuarios::getSeguimientoSiaco(); 
//print_r($dataReader);

$contador_a=0;
foreach ($dataReader as $row) { 

	$codigo=$row['codigo'];
	$proveido=trim($row['observaciones']);
	$derivado_por=trim($row['derivado_por']);
	$derivado_a=trim($row['derivado_a']);

	$usuario_a=Usuarios::getUsuarioMysql($derivado_a);
	$der_a=Usuarios::getUsuarioPostgres($usuario_a);

	if ($der_a=='') { $contador_a++; }
}
?>
<?php echo "<br> contador derivado a ->".$contador_a; ?>


<?php 

if($contador_a==0 && $contador_por==0)
{
 ?>
 	<br>
 	<center>
	<a class="btn btn-app" href="index.php?r=usuarios/migrarSeguimiento" style="color: black;">
		<i class="fa fa-share"></i>MIGRAR SEGUIMIENTO
	</a>
	</center>
<?php	
}
else{

	echo "<br> <b>no se pudieron migrar todos los usuarios</b> ";
}
?>

