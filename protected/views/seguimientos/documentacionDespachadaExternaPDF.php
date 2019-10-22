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


	.tabla_agrupacion tr td, tr th{
        	border: .3px solid #1C1C1C;   
        	border-collapse: collapse;
        }

	.fila{
        	border-bottom: 5px solid #1C1C1C;
        }
</style>

	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6" >
		<thead>
		<tr style="font-size: 10px; background-color: #BDBDBD; padding:6px; ">
			<th align="center" style="font-size: 10px;">NUR/NURI</th>
			<th align="center" style="font-size: 10px;">REFERENCIA | PROVE&Iacute;DO</th>
			<th align="center" style="font-size: 10px;">PROCEDENCIA | REMITENTE</th>
			<th align="center" style="font-size: 10px;">DERIVADO A</th>
			<th align="center" style="font-size: 10px;">FECHA/HORA DERIVACI&Oacute;N</th>
			<th align="center" style="font-size: 10px;">FIRMA</th>
			
		</tr>
		</thead>
		<tbody>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidosExterno($usuarios->id_usuario);
        ?>	

		<?php foreach ($dataReader as $row) { 

        	$fila=Seguimientos::getObtenerReferenciaRemitente($row['nuri']);

			?>	
		  <tr  style="font-size: 9px; border: .3px solid #1C1C1C;">
		    <td align="center" style="font-size: 10px;">
		    	<?php if ($row['tipo_documento']=='ORIGINAL') { 	 ?>
		    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/manito.jpg" width="20px" height="20px" ><br>
		    	<?php } ?>
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 9px;">
		      <?=$fila['referencia']?><br>		
		      <b>PROVE&Iacute;DO: </b><?=$row['proveido']?>
		    </td>

		    <td style="font-size: 9px;">
		      <?=$fila['remitente_nombres']?><br>		
		      <b><i><?=$fila['remitente_cargo']?></i></b>
		    </td>
		    <td style="font-size: 9px;" align="left"><?=$row['usuario_destino']?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))."<br> ".$row['h_derivacion']?></td>
		    <td style="width:20%;">
		    	<br><br><br><br><br>
		    </td>

		    
		    
		 </tr>
		<?php } ?>
		</tbody>
	   
	</table>
	



		


