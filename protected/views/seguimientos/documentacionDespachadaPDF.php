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
        	border: 0.3pt solid #1C1C1C;   
        	border-collapse: collapse;
        }

	.fila{
        	border-bottom: 5px solid #1C1C1C;
        }
</style>

	
	<table align="center" border="1px" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6" >
		<thead>
		<tr style="font-size: 12pt; padding-top: 16px; padding-bottom: 16px; background-color: #086A87; color: white;  ">
			<td align="center" style="font-size: 12pt;">TIPO</td>
			<td align="center" style="font-size: 12pt;">NUR/NURI</td>
			<td align="center" style="font-size: 12pt;">REFERENCIA | PROVE&Iacute;DO</td>
			<td align="center" style="font-size: 12pt;">PROCEDENCIA | REMITENTE</td>
			<td align="center" style="font-size: 12pt;">DERIVADO A</td>
			<td align="center" style="font-size: 12pt;">FECHA/HORA DERIVACI&Oacute;N</td>
			<td align="center" style="font-size: 12pt;">FIRMA</td>
			
		</tr>
		</thead>
		<tbody>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos($usuarios->id_usuario);
        ?>	

		<?php foreach ($dataReader as $row) { 

        	$fila=Seguimientos::getObtenerReferenciaRemitente($row['nuri']);

			?>	
		  <tr  style="font-size: 10pt; border: .3px solid #1C1C1C;">
		    <td align="center" style="font-size: 10pt;" valign="top">
		   		<i style="font-size: 10pt; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		    </td>

		    <td align="center" style="font-size: 10pt;" valign="top">
		   		<?=$row['nuri']?>
		    </td>

		    <td style="font-size: 10pt;" valign="top">
		      <p><?=htmlentities($fila['referencia'])?> 
		      <b>PROVE&Iacute;DO: </b><?=htmlentities($row['proveido'])?></p>
		    </td>

		    <td style="font-size: 10pt;" valign="top">
		      <p>
		      <?=htmlentities($fila['remitente_nombres'])?> - <b><?=htmlentities($fila['remitente_cargo'])?></b></p>
		    </td>
		    <td style="font-size: 10pt;" align="left" valign="top"><?=htmlentities($row['usuario_destino'])?></td>

		    <td style="font-size: 10pt;" align="center"  valign="top"><?=date("d/m/Y", strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
		    <td style="width:20%;">
		    	
		    </td>

		    
		    
		 </tr>
		<?php } ?>
		</tbody>
	   
	</table>
	



		


