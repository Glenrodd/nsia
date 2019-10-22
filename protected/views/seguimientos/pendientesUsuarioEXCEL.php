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


<br>
<table align="center" align="center" width="90%">
	<tr>
		<td colspan="8" style="text-align: center; background-color: white; padding: 7px; font-size: 25px; ">
			<br>
			<b><u>REPORTE DE PENDIENTES DE USUARIO</u></b>
			<br><br>
		</td>
	</tr>
</table>
<table align="center" align="center" width="95%" style="font-size: 17px; " border="0">	
	<tr>
		<td style="text-align: center; " rowspan="6" width="25%">

			
			
		</td>
	</tr>
	<tr>
		<th width="15%" align="right">Nombre: </th>
		<td colspan="4"><?=htmlentities($usuarios->nombre)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Cargo: </th>
		<td colspan="4"><?=htmlentities($usuarios->cargo)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">Correo: </th>
		<td colspan="4"><?=htmlentities($usuarios->correo)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">&Aacute;rea/Unidad: </th>
		<td colspan="4"><?=htmlentities($usuarios->fkArea->area)?></td>
	</tr>
	<tr>
		<th width="15%" align="right">CITE: </th>
		<td colspan="4"><?=htmlentities($usuarios->fkArea->cite)?></td>
	</tr>
</table>


<br>
<center>
<p align="center" style="font-size: 17px;">DOCUMENTOS <b><u>NO RECIBIDOS</u></b> POR EL USUARIO: <b><?=$usuarios->usuario?></b></p>
</center>
	<table align="center" border="1" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #086A87; color: white;  padding:6px;">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getNoRecibidosUsuario($usuarios->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 13px; ">
		    <td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 13px;" align="center" valign="top"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>	
<br><br>	
<center>
<p align="center" style="font-size: 17px;">PENDIENTES OFICIALES Y DIGITALES</p>
</center>	

	<table align="center" border="1"  width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #086A87; color: white;  padding:6px; ">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getNurisPendientesOficialesDigitales($usuarios->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 13px;" class="fila">

		    <td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
<center>
<p align="center" style="font-size: 17px;">DOCUMENTOS DERIVADOS POR EL USUARIO: <b><?=$usuarios->usuario?></b> NO RECIBIDOS</p>
</center>	
	<table align="center" border="1"  width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 14px; background-color: #086A87; color: white;  padding:6px; ">
			<th align="center" style="font-size: 14px;">Tipo</th>
			<th align="center" style="font-size: 14px;">NUR/NURI</th>
			<th align="center" style="font-size: 14px;">Derivado por</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Prove&iacute;do</th>
			<th align="center" style="font-size: 14px;">Estado</th>
			<th align="center" style="font-size: 14px;">Justificaci&oacute;n</th>
		</tr>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos($usuarios->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 13px; ">
		  	<td align="center" style="font-size: 13px;">
		   		<i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>
		    <td align="center" style="font-size: 13px;">
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_origen'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['proveido'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado']?></td>
		    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		 </tr>
		<?php } ?>
	   
	</table>


		


