<?php
/* @var $this SeguimientosController */
/* @var $model Seguimientos */

$this->breadcrumbs=array(
	'Seguimientoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Seguimientos', 'url'=>array('index')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);

//print_r($documentos);
$tipo=TipoDocumento::model()->findByPk($documentos->fk_tipo_documento);
?>
<br>
<!-- codigo para mostrar la cabereca -->
<table width="40%" align="center" >
	<tr align="center">
		<td><h3><b><?=$tipo->tipo_documento?></b></h3></td>
	</tr>
	<tr align="center">
		<td><b><?=$documentos->codigo?></b></td>
	</tr>
</table>
<hr>
<table width="70%" align="center" border="0" id="viewCabecera">
<!-- codigo para mostrar al destinatario y via -->
<?php if ($documentos->fk_tipo_documento==5) { ?>
	
		<tr>
			<td><b>A: </b></td><td><strong><?=$documentos->nombre_grupo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>De: </b></td><td><?=$documentos->remitente_nombres?><br><strong><?=$documentos->remitente_cargo?></strong></td>
		</tr>
		<tr><td><br></td></tr>
		

<?php } ?>
		<tr>
			<td><b>Fecha: </b></td><td><?=date('d/m/Y',strtotime($documentos->fecha));?></td>
		</tr>
		<tr><td><br></td></tr>
		<tr>
			<td><b>Referencia: </b></td><td><?=$documentos->referencia?></td>
		</tr>
	</table>	
	<hr>
	<table  width="90%" align="center" border="0" id="viewContenido">
		<tr>
			<td>
				<?php if ($documentos->fk_estado_documento==6) {
					echo "&nbsp;&nbsp;&nbsp;&nbsp;";
				} else { ?>
				<?=$documentos->contenido?>
				<?php } ?>
			</td>
		</tr>
	</table>




