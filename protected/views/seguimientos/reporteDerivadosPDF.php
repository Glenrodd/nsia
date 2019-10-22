
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
<?php 

foreach($seguimientos['id_seguimiento'] as $key => $val) {
$seguimientos=Seguimientos::model()->findByPk($val);
$fila=Seguimientos::getObtenerReferenciaRemitente($seguimientos->codigo);
?>

	<tr  style="font-size: 9px; border: .3px solid #1C1C1C;">
		    <td align="center" style="font-size: 10px;">
		    	<?php if ($seguimientos->oficial==1) { 	 
		    		$tipo_documento='ORIGINAL';
		    	?>
		    	<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/manito.jpg" width="20px" height="20px" ><br>
		    	<?php } 
		    	else{ $tipo_documento='COPIA DIGITAL'; }
		    	?>
		   		<i style="font-size: 7px; font-weight: bold; text-align: center;" ><?=$tipo_documento?></i><br>
		   		<?=$seguimientos->codigo?>
		    </td>
		    <td style="font-size: 9px;">
		      <?=$fila['referencia']?><br>		
		      <b>PROVE&Iacute;DO: </b><?=$seguimientos->proveido?>
		    </td>

		    <td style="font-size: 9px;">
		      <?=$fila['remitente_nombres']?><br>		
		      <b><i><?=$fila['remitente_cargo']?></i></b>
		    </td>
		    <td style="font-size: 9px;" align="left"><?=$seguimientos->derivadoA->fkArea->sigla?>: <?=$seguimientos->derivadoA->nombre?></td>
		    <td style="font-size: 9px;" align="center"><?=date("d/m/Y", strtotime($seguimientos->fecha_derivacion))."<br> ".$seguimientos->hora_derivacion?></td>
		    <td style="width:20%;">
		    	<br><br><br><br><br>
		    </td>

		    
		    
		 </tr>



<?php
} //foreach($seguimientos['id_seguimiento'] as $key => $val) {

?>

</tbody>
	</table>