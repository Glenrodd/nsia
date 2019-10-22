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


$row=Seguimientos::getInfoArchivo($id_seguimiento);

// codigo para verificar si existe el id de seguimiento
if (Seguimientos::countIdSeguimiento($id_seguimiento)) {
	
	$seguimientos=Seguimientos::model()->findByPk($id_seguimiento);
	$nur=$seguimientos->codigo;
	$estado=$seguimientos->oficial==1?'Original':'Copia Digital';
}
else{
	$nur=$row['fil_nur'];
	$estado=$row['fil_estadoseguimiento']==100?'Original':'Copia Digital';
}
//exit();

?>

<table width="80%" align="center" cellspacing="10px" cellpadding="5" border="0" style="font-size: 14px;" >
	<tr>
		<th colspan="2" style="text-align: center; font-size: 18px;" > <u>DOCUMENTO ARCHIVADO</u></th>
	</tr>
	<tr>
		<td colspan="2">
			<center>
			<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/archivo.png" width="20%" height="20%"; >
	        </center>
		</td>
	</tr>

	
	<tr style="border-bottom: 1px solid white; ">
		<th style="color: white; background:#086A87; text-align:right; font-size:17px;">NUR/NURI:</th>
		<td style="background:#E6E6E6; font-size:17px;"><b><?=$nur?></b></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Tipo:</th>
		<td style="background:#E6E6E6;"><b><?=$estado?><b></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">ID Expediente:</th>
		<td style="background:#E6E6E6;"><?=$row['exp_id']?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">T&iacute;tulo Expediente:</th>
		<td style="background:#E6E6E6;"><?=$row['exp_titulo']?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">ID Documento:</th>
		<td style="background:#E6E6E6;"><?=$row['fil_id']?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">T&iacute;tulo Documento:</th>
		<td style="background:#E6E6E6;"><?=$row['fil_titulo']?></td>
	</tr>

	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Fecha:</th>
		<td style="background:#E6E6E6;"><?=date("d/m/Y", strtotime($row['fil_fecha']));?></td>
	</tr>
	<tr style="border-bottom: 1px solid white;">
		<th style="color: white; background:#086A87; text-align:right;">Observaciones:</th>
		<td style="background:#E6E6E6;"><?=$row['fil_obs']?></td>
	</tr>
</table>






