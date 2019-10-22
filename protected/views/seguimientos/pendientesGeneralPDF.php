<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);

/*$this->menu=array(
	array('label'=>'Create Seguimientos', 'url'=>array('create')),
	array('label'=>'Manage Seguimientos', 'url'=>array('admin')),
);*/
?>

<?php /*$this->widget('application.extensions.qrcode.QRCodeGenerator',array(
    'data' => 'http://www.abc.gob.bo',
    'subfolderVar' => false,
    'matrixPointSize' => 5,
    'displayImage'=>true, // default to true, if set to false display a URL path
    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
    'matrixPointSize'=>4, // 1 to 10 only
))*/ ?>






<style type="text/css">
	.tabla_agrupacion->tr{
		 /*border-bottom-color:#FF0000; border-bottom-style:dashed; border-bottom-width:2px; */

		 border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
	}

	.tabla_agrupacion th{

		
	}

	.fila{
        	border-bottom: 5px solid #1C1C1C;
        }
</style>

<br>
<center>
<p align="center" style="font-size: 11px;">PENDIENTES OFICIALES Y DIGITALES</p>
</center>	

	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
		</tr>
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitales(); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px;" class="fila">

		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
<center>
<p align="center" style="font-size: 11px;">DOCUMENTOS DERIVADOS POR EL USUARIO:  NO RECIBIDOS</p>
</center>	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
		</tr>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos(); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px; border: .3px solid #1C1C1C;">
		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
		 </tr>
		<?php } ?>
	   
	</table>
	


<br><br>
<center>
<p align="center" style="font-size: 11px;">DOCUMENTOS NO RECIBIDOS POR EL USUARIO: </p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">Derivado por</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Derivado a</th>
			<th align="center" style="font-size: 10px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 10px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 10px;">Estado</th>
		</tr>
        <?php $dataReader=Seguimientos::getNoRecibidosUsuario(); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px; border: .3px solid #1C1C1C;">
		    <td align="center" style="font-size: 9px;">
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_origen']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 9px;"><?=$row['proveido']?></td>
		    <td style="font-size: 9px;" align="center"><?=$row['estado']?></td>
		 </tr>
		<?php } ?>
	   
	</table>	

		


