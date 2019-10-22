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
        	border-bottom: .1px solid #1C1C1C;
        }
</style>

<br>
<center>
<p align="center" style="font-size: 20px;">PENDIENTES OFICIALES Y DIGITALES <br></p>
</center>	

	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6" border="1">
		<tr style="font-size: 14px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 14px;">&Aacute;rea/Unidad</th>
			<th align="center" style="font-size: 14px;"><br>NUR/NURI<br><br></th>
			<th align="center" style="font-size: 14px;">Derivado a</th>
			<th align="center" style="font-size: 14px;">Usuario</th>
			<th align="center" style="font-size: 14px;">Referencia</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Derivaci&oacute;n</th>
			<th align="center" style="font-size: 14px;">Fecha/Hora Recepci&oacute;n</th>
			<th align="center" style="font-size: 14px;"><br>Tipo<br><br></th>
			<th align="center" style="font-size: 14px;">Estado Usuario</th>
		</tr>
        <?php $dataReader=Areas::getPendientesGeneral(); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 13px;" class="fila">
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['unidad'])?></td>
		    <td align="center" style="font-size: 13px;"><?=$row['nuri']?></td>
		    <td style="font-size: 13px;" align="center"><?=htmlentities($row['usuario_destino'])?></td>
		    <td style="font-size: 13px;" align="center"><?=$row['usuario']?></td>
		    <td style="font-size: 13px;"><?=htmlentities($row['referencia'])?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 13px;" align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		    <td align="center" style="font-size: 13px;"><i style="font-size: 11px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i></td>
		    <td style="font-size: 13px;" align="center"><?=$row['estado_usuario']?></td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>


