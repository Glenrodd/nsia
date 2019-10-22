<?php
/* @var $this HojasRutaController */
/* @var $model HojasRuta */

$this->breadcrumbs=array(
	'Hojas Rutas'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List HojasRuta', 'url'=>array('index')),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);
?>
<?php 

//echo "<br> ---> ".$fecha_inicio; 
//echo "<br> ---> ".$fecha_fin; 
//echo "<br> ---> ".$usuario; 

?>


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

<table align="center" align="center" width="90%">
	<tr>
		<td style="text-align: center; padding: 7px; font-size: 16pt;" colspan="8">
			<b><u><?=$usuarios->fkRegional->regional?></u></b>
		</td>
	</tr>
	
</table>
<table align="center" align="center" width="95%" style="font-size: 15pt; " border="0">	
	<tr>
		<td style="text-align: center; padding: 7px;" colspan="8">
			<b><u>VENTANILLA DE RECEPCION</u></b>
			<p><br>		
			Desde: <?=date("d/m/Y", strtotime($fecha_inicio))?> al <?=date("d/m/Y", strtotime($fecha_fin))?>
		</td>
	</tr>
	
</table>


	
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6" >
		<thead>
		<tr style="font-size: 12pt; background-color: #086A87; padding:6px; color: white; border: 1px solid darkgray;">
			<th align="center" style="font-size: 12pt;">NUR</th>
			<th align="center" style="font-size: 12pt;">CITE</th>
			<th align="center" style="font-size: 12pt;">Destinatario</th>
			<th align="center" style="font-size: 12pt;">Remitente</th>
			<th align="center" style="font-size: 12pt;">Instituci&oacute;n Remitente</th>
			<th align="center" style="font-size: 12pt;">Fecha</th>
			<th align="center" style="font-size: 12pt;">Referencia</th>
			<th align="center" style="font-size: 12pt;">S&iacute;ntesis</th>
		</tr>
		</thead>
		<tbody>
        <?php $dataReader=HojasRuta::nurFechaExterno($usuarios->id_usuario,$fecha_inicio,$fecha_fin);
        ?>	

		<?php foreach ($dataReader as $row) { ?>	

		  <tr  style="font-size: 10pt;">
		    <td align="center" style="font-size: 10px;  border:.1pt solid #2E2E2E;" valign="top">
		    	
		    	<!--<img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/manito.jpg" width="20px" height="20px" ><br>-->
		   		<!--<i style="font-size: 7px; font-weight: bold; text-align: center;" >ORIGINAL</i>-->
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top"><?=$row['cite']?></td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top">
		    	<?=$row['destinatario']?> -
		    	<b><?=$row['cargo_destinatario']?></b>
		    </td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top">
		      <?=$row['remitente']?> - 		
		      <b><?=$row['cargo_remitente']?></b>
		    </td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top"><?=$row['remitente_institucion']?></td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top"><?=date("d/m/Y", strtotime($row['fecha']))?></td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top"><?=$row['referencia']?></td>
		    <td style="font-size: 10pt; border:.1pt solid #2E2E2E;" valign="top"><?=$row['sintesis']?></td>

		    
		    
		 </tr>
		<?php } ?>
		</tbody>
	   
	</table>