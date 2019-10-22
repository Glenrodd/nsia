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



<table align="center" align="center" width="100%">
	<tr>
		<td style="text-align: center; background-color: #D8D8D8; padding: 7px;">
			<b><u>NUR/NURI de AGRUPACI&Oacute;N</u></b>
		</td>
	</tr>
	<tr><td></td></tr>
	<tr>
		<td style="text-align: center;">
			<img src="<?=Yii::app()->request->baseUrl;?>/images/hojas_apiladas.jpg" style="width:150px; height:100px;" >
		</td>
	</tr>
	<tr>
		<td style="text-align: center;">
			<b style="font-size:20.0pt; "><?=$model->codigo?></b><br>

			<!--
				Esta extensión genera una matriz de código QR con la API de Google. Genera una imagen de qrcode y también la almacena (en una ruta determinada).

				Puede cambiar todos los parámetros de qrcode como 'contenido', 'altura', 'ancho', 'corrección de errores', 'enconding', etc.

				Para guardar la imagen de qrcode en la carpeta especificada, puede cambiar la ruta cambiando el valor de $ filePath y $ fileUrl en el archivo QRCode.php	
			-->


			<?php 


			// codigo para almacenar todos los nuris en una variable y mostrarlo en el codigo qr
			$nuris='';

			$dataReader3=Seguimientos::getListaNurisAgrupadosCompleto($model->codigo); 
		 	foreach ($dataReader3 as $row2) { 
  	     			if ($nuris=='') {	$nuris=$row2['nuri'];			}
  	     			else{	$nuris=$nuris.'; '.$row2['nuri'];  			}
  	     		}
  	     	?>	


			<?php 

			$datos_qr="NURI PRINCIPAL ".$model->codigo." NURIS AGRUPADOS: ".$nuris." Usuario: ".Yii::app()->user->usuario.", SAC";

			/*$this->widget('application.extensions.qrcode.QRCode', array(
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
					    'filename' => $codigo.".png",
					    'subfolderVar' => true,
					    'matrixPointSize' => 5,
					    'displayImage'=>true, // default to true, if set to false display a URL path
					    'errorCorrectionLevel'=>'L', // available parameter is L,M,Q,H
					    'matrixPointSize'=>3, // 1 to 10 only
						));
		?>	

			
		</td>
	</tr>
</table>
<style type="text/css">
	.tabla_agrupacion->tr{
		 /*border-bottom-color:#FF0000; border-bottom-style:dashed; border-bottom-width:2px; */
		 border-top-color:#999BA0; border-top-style:solid; border-top-width:0.1px;
	}

	.tabla_agrupacion th{

		
	}
</style>

<br>
<table  align="center" width="50%"><tr><td align="center">NUR/NURI(s) AGRUPADOS</td></tr></table>
<center>
	
</center>	
	<table align="center" class="tabla_agrupacion" width="98%" cellspacing="0" cellpadding="2">
		<tr style="font-size:12px; background-color: #0B4C5F; padding:6px;">
			<td align="center" style=" color:#F2F2F2; padding:6px; font-size:12pt; ">NUR/NURI</td>
			<td align="center" style="color:#F2F2F2; font-size:12pt; ">Usuario</td>
			<td align="center" style="color:#F2F2F2; font-size:12pt;  width: 150px;  ">Tipo<br> Documento</td> 
			<td align="center" style="color:#F2F2F2; font-size:12pt; width: 150px; ">Fecha<br> Agrupaci&oacute;n</td>
		</tr>

		<!-- CODIGO PARA OBTENER LOS NURIS AGRUPADOS EN EL SIACO-->

		<?php 

		if (Seguimientos::getListaNurisAgrupadossSIACOCount($model->codigo)) {
			# code...
		

		$dataReader2=Seguimientos::getListaNurisAgrupadossSIACO($model->codigo); 
		 	$i=1;
		 ?>	
		 <?php foreach ($dataReader2 as $row3) { 
  	     		if (($i%2)==0) { $color='white';	}
  	     		else{ $color='#D8D8D8'; }
  	     		$i++; 

  	     		if ($row3['oficial']==1) {
  	     			$tipo='ORIGINAL';
  	     		}
  	     		else{ $tipo='COPIA DIGITAL'; }

  	     	?>

  	     <tr  style="background-color:<?=$color?>;  ">
		    <td style="font-size: 10pt; text-align: left;" ><?=$row3['nur_s']?></td>
		    <td style="font-size: 10pt; text-align: left;"></td>
		    <td style="font-size: 10pt; text-align: center;"><?=$tipo?></td>
		    <td style="font-size: 10pt; text-align: center;"></td>
        </tr>
	   <?php } 

	   	}

	   ?>
	   		


		 <?php $dataReader2=Seguimientos::getListaNurisAgrupadosCompleto($model->codigo); 
		 	$i=1;
		 ?>	
  	     <?php foreach ($dataReader2 as $row2) { 
  	     		if (($i%2)==0) { $color='white';	}
  	     		else{ $color='#D8D8D8'; }
  	     		$i++; 
  	     	?>	
		<tr  style="background-color:<?=$color?>;  ">

		    <td style="font-size: 10pt; text-align: left;" ><?=$row2['nuri']?></td>
		    <td style="font-size: 10pt; text-align: left;"><?=$row2['usuario_agrupacion']?></td>
		    <td style="font-size: 10pt; text-align: center;"><?=$row2['tipo_documento']?></td>
		    <td style="font-size: 10pt; text-align: center;"><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row2['fecha_agrupacion']))?></td>
        </tr>
	   <?php } ?>
	</table>
<br>
<center>
<i style="width:70%; font-size: 9px; text-align: center;"><b>Nota:</b> Señor usuario, verifique al momento de recibir este documento, que todos los NUR/NURI(s) adjuntos se encuentran f&iacute;sicamente, de lo contrario no lo reciba.</i>	
</center>

