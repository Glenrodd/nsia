
<table class="table table-bordered table-striped">
	<tr>
		<td colspan="9" align="center">
			<h3>Reporte de NUR/NURIs atendidos por el usuario <b>'<?=strtoupper(Yii::app()->user->usuario)?>'</b></h3>
		</td>
	</tr>
</table>

<table class="table table-bordered table-striped" border="1px">
    <tr style="background-color:#0489B1; color:white;">
	    <!--<th align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>-->
	    <th align="center">N&deg;</th>
	    <th align="center">NUR/NURI</th>
	    <th align="left">Derivado por</th>
	    <th align="left">Fecha/Hora Derivaci&oacute;n</th>

	    <th align="left">Derivado a</th>
	    <th align="left">Fecha/Hora Recepci&oacute;n</th>

	    <th align="left">Prove&iacute;do</th>
	    <th align="left">Estado</th>
	    <th align="left">CITEs Adjuntos</th>
	</tr>


<?php $dataReader=Seguimientos::documentosAtendidos($id_usuario); ?>	
<?php 
	$i=0;
	foreach ($dataReader as $row) { 
	$i++;	
	$id_seguimiento=$row['id_seguimiento'];
	?>	

	<tr  style="font-size:13px; border: .3px solid #1C1C1C;">
		<td align="center"><?=$i?></td>
	    <td align="center">
		 	<?php if($row['tipo_documento']=='ORIGINAL'){ ?>
		   	<i  class="fa fa-hand-peace-o" style="font-size: 20px; color: darkblue;"></i><br>
		   	<?php } ?>
			<b><?=$row['tipo_documento']?></b><br>
			<?=$row['nuri']?>
		</td>
		
		<td align="left"><?=htmlentities($row['usuario_origen'])?></td>
		<td align="center"><?=date("d/m/Y", strtotime($row['f_derivacion']))." ".$row['h_derivacion']?></td>

		<td align="left"><?=htmlentities($row['usuario_destino'])?></td>
		<td align="center"><?=date("d/m/Y", strtotime($row['f_recepcion']))." ".$row['h_recepcion']?></td>
		
		<td><?=htmlentities($row['proveido'])?></td>
		<td align="left"><?=$row['estado']?></td>
		<td align="left"><?=$row['adjuntos']?></td>
	</tr>
  <?php } ?>         	 
</table>