<style>
        .cuerpo {
            
            /*top: 50mm;
            padding-left: 30mm;*/
            width: 100%;
            font-family:Verdana, Geneva, sans-serif;
            	

        }
        .tabla_hs{

        	font-family:Verdana, Geneva, sans-serif;
        }
        .tabla_hs tr td, tr th{
        	border: .3px solid #1C1C1C;   
        	border-collapse: collapse;
        }
</style>
<?php 
switch($documentos->fk_tipo_documento) {
					    case 1:
					        $tipo='INFORME';
					        break;
					    case 2:
					        $tipo='NOTA INTERNA';
					        break;
					    case 3:
					        $tipo='MEMORANDUM';
					        break;
					    case 4:
					        $tipo='CARTA';
					        break;
					    case 5:
					        $tipo='CIRCULAR';
					        break;        
					}

// codigo para obtener todos las copias

$dataReader=Documentos::getCopiasDerivadas($hojasruta->nur);
foreach($dataReader as $row) {

$usuarios=Usuarios::model()->findByPk($row['derivado_a']);	
$area=$usuarios->fkArea->sigla;

?>
<div class="cuerpo">
<!--#####################################################################-->		

	<table border="0" cellpadding="4px" cellspacing="0" width="100%" class="tabla_hs">
		<tr align="center">
			<th style="width:14%;">
				<img src="<?=Yii::app()->request->baseUrl?>/images/LogoVIASBoliviaSiaco.png" width="75px" height="90px" />	
			</th>
			<th style="width:62%;"><span style="font-size: 14pt; text-align: center;">
				HOJA DE SEGUIMIENTO</span><br>
				<span style="font-size: 7pt; text-align: center;">
				Copia N&ordm; <?=$row['numero_copia']?> </span>
			</th>
			
			<th style="width:24%;" colspan="2">
				NUR<br>
				<span style="font-size: 10pt; text-align:center;">
					<?=$hojasruta->nur?><br>

					<?php 

						$datos_qr="NURI: ".$hojasruta->nur." Usuario: ".Yii::app()->user->usuario.", SAC";

					/*	$this->widget('application.extensions.qrcode.QRCode', array(
			            'content' => $datos_qr, // qrcode data content
			            'filename'=> 'qrcode.png', // image name (make sure it should be .png)
			            'width' => '80', // qrcode image height 
			            'height' => '80', // qrcode image width 
			            'encoding' => 'UTF-8', // qrcode encoding method 
			            'correction' => 'H', // error correction level (L,M,Q,H)
			            'watermark' => 'No' // set Yes if you want watermark image in Qrcode else 'No'. for 'Yes', you need to set watermark image $stamp in QRCode.php
			        ));*/

			        $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
					    'data' => $datos_qr,
					    'filename' => "nuri.png",
					    'subfolderVar' => true,
					    'matrixPointSize' => 5,
					    'displayImage'=>true, // default to true, if set to false display a URL path
					    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
					    'matrixPointSize'=>2, // 1 to 10 only
						));

						?>


				</span>
			</th>
		</tr>

		<tr style="font-size: 8pt; ">
			<th style="font-size:8pt; text-align:left; background-color:#BDBDBD; "><span>Procedencia: </span></th>
			<td  style=" text-align:left; font-size:8pt;" align="left" >
				<?=$documentos->remitente_institucion?>
			</td>
			<th style="font-size:8pt; background-color:#BDBDBD;  "><span>Fecha: </span></th>
			<td align="left" style="font-size:8pt;" ><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($hojasruta->fecha))?>&nbsp;&nbsp;<?=$hojasruta->hora?></td>
		</tr>
		<tr>
			<th style="font-size:8pt; text-align:left; background-color:#BDBDBD;"><span>CITE: </span></th>
			<td align="left" style="font-size: 8pt;" colspan="3" ><?=$hojasruta->codigo?></td>
		</tr>
		
		<tr style="font-size: 8pt;">
			<th style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Remitente: </span></th>
			<td style="text-align:left; font-size: 8pt;" colspan="3">
				<?=$documentos->remitente_nombres?>&nbsp;&nbsp;|&nbsp;&nbsp;
				<?=$documentos->remitente_cargo?>
			</td>
			
		</tr>
		<tr style="font-size: 8pt;">
			<th style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Referencia: </span></th>
			<td style="text-align:left; font-size: 7pt; " align="left" colspan="3" valign="top" >
				<?=$documentos->referencia?>
				
			</td>
			
		</tr>
		<tr style="font-size: 8pt;">
			<th  style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Adjuntos: </span></th>
			<td align="left"  style="text-align:left; font-size: 8pt;" >
				<?=$documentos->adjuntos?>
			</td>
			<th style="font-size: 8pt; background-color:#BDBDBD; "><span>Hojas: </span></th>
			<td align="left" style="font-size: 8pt; width: 350px;" ><?=$documentos->nro_hojas?></td>
		</tr>
		<tr style="font-size: 8pt;">
			<th style="font-size: 8pt; text-align:left; background-color:#BDBDBD;"><span>Sintesis: </span></th>
			<td style="text-align:left; font-size: 7pt;" align="left" colspan="3" valign="top" >
				<?=$documentos->contenido?>
				
			</td>
			
		</tr>
		
	</table>



	<!--#########################################################################-->
	<?php $seguimientos=Documentos::getDetalleSeguimiento($hojasruta->nur); ?>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" style="border-top: 1.5mm;"  width="100%">
		
		<tr style="font-size: 8pt;">
			
			<td style="border-bottom: 0mm; width:0mm; width: 40%;" >
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				
			
			</td>
			<th  style="border-bottom: 0mm; width:0; font-size: 8pt; text-align: left;  width: 60%; background-color:#BDBDBD;" >
				PROVE&Iacute;DO:
			</th>
			
		</tr>
		<tr style=" border-top:0mm; ">
			<td style="border-bottom: 0mm; border-top: 0mm; text-align: center; font-size: 8pt; " valign="middle">
				<br><br><span style="color:gray;"><br><br>Sello de Despacho</span><br><br><br><br><br><br><br>
			</td>
			
			<td width="60%" valign="top"  style="font-size: 8pt;">
				<div style="width: 100%;">
					<?=$seguimientos->proveido?> 
				</div>
			</td>
			
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size:7pt;">
			<td  style="width:65%; font-size:7pt; background-color:#BDBDBD;"  align="left" colspan="2" >
				<b>Copias:</b>&nbsp;&nbsp;
				<?=Documentos::getNameCopias($hojasruta->nur)?>
			</td>
			<td style="width:35%; font-size:7pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width: 10%; font-size:7pt; background-color:#BDBDBD;" ><div style="width:100%;">Destinatario: </div></th>
			<td style="width: 60%; text-align: left; font-size:7pt;">
				<?=$usuarios->nombre.' ('.$area.')';?>
			</td>
			<td style="width:15%; font-size:7pt;  text-align: left; background-color:#BDBDBD;">
				<b>Fecha: </b>
					<?=date("d/m/Y", strtotime($seguimientos->fecha_derivacion));?>
				<div style="width:0px; text-align:left; ">
				</div>
			</td>
			<td style="width:15%; font-size:7pt; text-align: left; background-color:#BDBDBD;">
				<div style="width:100%;">
					<b>Hora: </b>
					<?=$seguimientos->hora_derivacion?>
				</div>
			</td>
		</tr>
	</table>
	<br>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>

	<!-- ######################################################################### -->
	<br>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>
	<div style="page-break-after: always"></div>

	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->
	<!-- ######################################################################### -->

	<!-- SEGUNDA PAGINA -->
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>

	<!-- ######################################################################### -->
	<br>	
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>

	<!-- ######################################################################### -->
	<br>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>

	<!-- ######################################################################### -->
	<br>
	<!-- ######################################################################### -->
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			<td style="border-bottom: 0mm; width: 40%; font-size: 8pt;"></td>
			<th style="width: 25%; font-size: 8pt; text-align: left; background-color:#BDBDBD;" ><b>Firma de Recepci&oacute;n: </b></th>
			<th style="width: 15%;  text-align: left; text-align: left; font-size: 8pt;  background-color:#BDBDBD;"><b>Hora: </b></th>
			<th style="width: 20%; text-align: left; font-size: 8pt; background-color:#BDBDBD;"><b>Fecha: </b></th>
		</tr>
	</table>
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr>
			
			<td align="center"  style="border-bottom: 0mm; border-top: 0mm; width:40%;font-size:8pt;" >
				<br><br><br><br><br><span style="color:gray;">Sello de Recepci&oacute;n</span><br><br><br><br><br><br>
			</td>
			<td style="border-bottom: 0mm; border-top: 0mm; width:60%;font-size:8pt;" > &nbsp;</td>
			
		</tr>
		<tr style="font-size: 7pt;">
			<td style="border-top: 0mm; border-bottom: 0mm; width: 40%;"></td>
			
			<th width="60%" style="font-size:8pt; text-align: left; width: 60%; border-bottom:0mm; background-color:#BDBDBD;" >
					Adjuntos:			
			</th>
		</tr>
	</table>

	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		
		<tr style="font-size: 9pt;">
			<td style="width:40%; border-top:0mm;"></td>
			<td  style="width:25%; font-size: 8pt; background-color:#BDBDBD;"  align="left">
				<b>Copias :</b>
			</td>
			<td style="width:35%; font-size: 8pt; background-color:#BDBDBD;" align="left">
				<b>Firma Despacho :</b>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
		</tr>
	</table>	
	<table class="tabla_hs" cellpadding="4px" cellspacing="0" width="100%">
		<tr style="border-top:0mm;">
			<th style="width:443px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
				<b>Destinatario: </b>
			</th>
			
			<td style="width: 135px; font-size: 8pt;text-align: left; background-color:#BDBDBD;"  align="left">
				<b>Fecha: </b>
			</td>
			<td align="20"  align="left" style="width: 116px; font-size: 8pt;text-align: left; background-color:#BDBDBD;">
					<b>Hora: </b>
			</td>
			
		</tr>
	</table>

	<!-- ######################################################################### -->
<!--#####################################################################-->	
</div><!--<div class="cuerpo">-->
<div style="page-break-after: always"></div>

<?php 
} //foreach($dataReader as $row) {
?>	
  

