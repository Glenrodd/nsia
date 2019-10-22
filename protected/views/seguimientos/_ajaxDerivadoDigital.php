
<center>
<!--<h3><b>Copias digitales enviadas</b></h3>-->
</center>

<div class="card-body pad table-responsive">
		              
		             
	<table class="table table-bordered table-striped">
	  <tr style="font-size: 16px; background-color: #0489B1; color: white;">
		<th align="center">Derivado a:</th>
		<th align="center">Derivado a:</th>
		<th align="center">Prove&iacute;do</th>
		<th align="center">Fecha/Hora</th>
		<th align="center">Acci&oacute;n Seguimiento</th>
		<th align="center">Estado Seguimiento</th>
		<th align="center">Tipo</th>
		<th>Hoja de Seguimiento</th>
		<th>Eliminar</th>
	  </tr>
	  <?php $dataReader=Seguimientos::getDerivacionesDigitales($seguimientos->codigo,$seguimientos->id_seguimiento); ?>	
	  <?php foreach ($dataReader as $row) { 
	  	$id_seg=$row['id_seg'];
	  	if ($row['tipo_documento']=='ORIGINAL') {
	  		$color="background-color:#F5D0A9;";
	  	}
	  	else{
	  		$color="";
	  	}
	  	?>	
	  <tr  style="font-size: 13px; <?=$color?> ">
	    <td><?=$row['id_seg']?></td>
	    <td><?=$row['usuario_destino']?></td>
	    <td><?=$row['proveido']?></td>
	    <td><?=Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row['f_derivacion']))." - ".$row['h_derivacion']?></td>
	    <td><?=$row['accion']?></td>
	    <td><?=$row['estado']?></td>
	    <td><?=$row['tipo_documento']?></td>
	    <td align="center">
	    	<?php 
	    		/*echo CHtml::link('Imprimir H.S.',array('Seguimientos/ajaxDeleteCopyDigital',
                                         'id'=>$id_seg),array('class'=>'btn btn-success'));*/
	    	?>
	    </td>
	    <td align="center">
	    	<?php echo CHtml::ajaxSubmitButton ("Eliminar",
								array('Seguimientos/ajaxDeleteCopyDigital','id'=>$id_seg),
	                        	array('update' => '#data'),
	                        	array('class'=>'btn btn-danger', 'id' => 'send-link-'.$id_seg)

	                        ); 

	    	 //echo CHtml::ajaxSubmitButton('Delete ', array('Seguimientos/ajaxDeleteCopyDigital', 'id' => $id_seg, 'class'=>'btn btn-danger'));

	    	 //echo CHtml::link('Link Text',array('Seguimientos/ajaxDeleteCopyDigital', 'id' => $id_seg)); 

	            /*echo CHtml::ajaxButton(
				        'Submit requestDDD',
				        array('Seguimientos/ajaxDeleteCopyDigital'),
				        array('data'=>array('id'=>$id_seg)),
				        array('update'=>'#data')
				        //this is the update selector of yours $('#update_selector').load(url);
				    );*/


				/*echo CHtml::ajaxButton(
			        // Lable of ajax button
			        'Ajax Button Request',
			        // Request function in controller of yii
			        array('Seguimientos/ajaxDeleteCopyDigital'),
			        //Parameter with ajax request
			        array(
			            'data'=>array('id'=>$id_seg),  
			            //update field after ajax response content 
			            'update'=>'#data',
			        )
			    );  */


			   

			    /*echo CHtml::link('Link Text',array('Seguimientos/ajaxDeleteCopyDigital',
                                         'id'=>$id_seg),array('class'=>'btn btn-danger')); */

               /* echo CHtml::ajaxLink('send a message', Yii::app()->createUrl('Seguimientos/ajaxDeleteCopyDigital'), 
				    array(
				    	'replace' => '#data',
				    	'data' => array('id'=>$id_seg),
    					//'update'=>'#data'
						), 
				    array('id' => 'send-link-'.uniqid())
				);      */


				/*echo CHtml::ajaxLink('Comment(3)',$this->createUrl('Seguimientos/ajaxDeleteCopyDigital'),array(
			    'data' => array('id'=>$id_seg),
			    'update'=>'#data'
			));   */               






	        ?>

	        <?php /*
echo CHtml::ajaxLink('X',Yii::app()->createUrl('admin/deleteimg'),
 array(
    'type'=>'POST',
    'data'=> 'js:{"data":'.$id_seg.'}',       
    'success'=>'js:function(string){ document.getElementById("'.$id_seg.'").remove(); }'           
),array(
    'class'=>'btn btn-danger small-btn',
    'confirm'=>'Are you sure?' //Confirmation
    ));*/ ?>

	    </td>
	  </tr>
	 <?php } ?>
	</table>
	                
</div> 