<?php
/* @var $this SeguimientosController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Seguimientoses',
);

?>
<style type="text/css">
.fila{
      	border-bottom: .5px solid #1C1C1C;
     }
</style>


<br>
<center>
<p align="center" style="font-size: 14px;"><b>DOCUMENTOS NO RECIBIDOS</b></p>
</center>
	<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="3">
		<tr style="font-size: 12px; background-color: #086A87; padding:6px; color: white;  text-align: center;">
			<th style="font-size:12px;">NUR/NURI</th>
			<th style="font-size:12px;">Derivado por</th>
			<th style="font-size:12px;">Fecha/Hora Derivaci&oacute;n</th>
			<!--<th style="font-size:12px;">Prove&iacute;do</th>-->
			<th style="font-size:12px;">Estado</th>
			<th style="font-size:12px;"></th>
			<th style="font-size:12px;"></th>
		</tr>
        <?php $dataReader=Seguimientos::getNoRecibidosUsuario(Yii::app()->user->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px;" class="fila">

		    <td align="center" style="font-size: 12px;">
		    	<table width="100%">
		    		<tr>
		    			<?php if ($row['tipo_documento']=='ORIGINAL') { 	 ?>
				    	<td>
				    		<i class="fa fa-hand-peace-o" style="font-size: 18px; color: #0B4C5F;"></i>
				    	</td>
				    	<?php } else { echo "<td> </td>"; } ?>
		    			<td>
		    				<i style="font-size: 10px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   					<?=$row['nuri']?>
		    			</td>
		    		</tr>
		    	</table>
		    </td>
		    <td style="font-size: 12px; text-align: left;" >
		    	<?=$row['usuario_origen']?><br>
		    <span style="font-size:10px;" ><i><b>PROVE&Iacute;DO: </b><?=$row['proveido']?></i></span>		
			</td>
		    <td style="font-size: 12px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <!--<td style="font-size: 12px;"><? //=$row['proveido']?></td>-->
		    <td style="font-size: 12px;" align="center"><?=$row['estado']?></td>
		    <td style="font-size: 12px;" align="center">
		    	<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/recibirNuri&nuri=<?=$row['nuri']?>">
                  <i class="fa fa-download"></i> Recibir
                </a>
		    </td>
		    <td style="font-size: 12px;" align="center">
		    	<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>">
                  <i class="fa fa-paw"></i> Seguimiento
                </a>
		    </td>
		 </tr>
		<?php } ?>
	   
	</table>

<br><br>
<center>
<p align="center" style="font-size: 14px;"><b>DOCUMENTOS NO RECIBIDOS POR EL DESTINATARIO</b></p>
</center>	
<table align="center" class="tabla_agrupacion" width="95%" cellspacing="0" cellpadding="6">
		<tr style="font-size: 12px; background-color: #086A87; padding:6px; color: white;  text-align: center;">
			<th style="font-size:12px;">NUR/NURI</th>
			
			<th style="font-size:12px;">Fecha/Hora Derivaci&oacute;n</th>
			<th style="font-size:12px;">Derivado a</th>
			
			<!--<th style="font-size:12px;">Prove&iacute;do</th>-->
			<th style="font-size:12px;">Estado</th>
			<th style="font-size:12px;"></th>
		</tr>
        <?php $dataReader=Seguimientos::getDerivadosNoRecibidos(Yii::app()->user->id_usuario); ?>	

		<?php foreach ($dataReader as $row) { ?>	
		  <tr  style="font-size: 9px;" class="fila">

		    <td align="center" style="font-size: 12px;">
		    	<?php if ($row['tipo_documento']=='ORIGINAL') { 	 ?>
		    	<i  class="fa fa-hand-peace-o" style="font-size: 18px; color: darkblue;"></i><br>
		    	<?php } ?>
		   		<i style="font-size: 10px; font-weight: bold; text-align: center;" ><?=$row['tipo_documento']?></i><br>
		   		<?=$row['nuri']?>
		    </td>
		    <td style="font-size: 12px;" align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>
		    <td style="font-size: 12px; text-align: left;" align="center">
		    	<?=$row['usuario_destino']?><br>
		    	<span style="font-size:10px;" ><i><b>PROVE&Iacute;DO: </b><?=$row['proveido']?></i></span>
		    </td>
		    <!--<td style="font-size: 12px;"><? //=$row['proveido']?></td>-->
		    <td style="font-size: 12px;" align="center"><?=$row['estado']?></td>
		    <td style="font-size: 12px;" align="center">
		    	<a class="btn btn-default btn-sm" href="index.php?r=seguimientos/busquedaIndex&nuri=<?=$row['nuri']?>">
                  <i class="fa fa-paw"></i> Seguimiento
                </a>
		    </td>
		 </tr>
		<?php } ?>
	   
	</table>
<br><br>
	

		


