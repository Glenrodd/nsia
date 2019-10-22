<?php
/* @var $this DocumentosController */
/* @var $model Documentos */

$this->breadcrumbs=array(
	'Documentoses'=>array('index'),
	'Manage',
);
?>
<head>
	<!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>-->
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>-->
    <!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>-->
    <!--<link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />-->
    <!--<link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" />-->

	<script type="text/javascript">
/*
				    $(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." style="width:100%;" />' );
				        //$(this).html( '<input type="text" placeholder="Buscar '+title+'" />' );
				    } );
				    // DataTable
				    var table = $('#example').DataTable( {
				        colReorder: true
				    } );
				      
				    // Apply the filter
				    $("#example thead input").on( 'keyup change', function () {
				        table
				            .column( $(this).parent().index()+':visible' )
				            .search( this.value )
				            .draw();
				    } );
				    } );  */  



					function destinatario(valor1, valor2){	

						$("#user_destino").html(valor1);
						$("#derivado_a").val(valor2);
						//$("#usuario_destino").val(valor3);
					}
					</script>
</head>



<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">

          	<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Documentos sin Derivar</h3>
              </div>

          	
          	<div class="card-body pad table-responsive">
								<center><h4><u>Detalle de <b>NUR/NURI(s)</b> disponibles</u></h4>
								  <i style="color: #0B4C5F;">Documentaci&oacute;n generada por el usuario sin derivar <br>
								  <b>La siguiente informaci&oacute;n a&uacute;n puede ser actualizada.</b>
								  </i>
								</center>		
						        <!--<table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>NUR</b></td>
						               <td align="center"><b>CITE</b></td>
						               <td align="center"><b>DESTINATARIO</b></td>
						               <td align="center"><b>REFERENCIA</b></td>
						               <td align="center"><b>FECHA</b></td>
						               <td align="center"><b></b></td>
						            </tr>
						            <tr>
						               <th align="center"><b>NUR</b></th>
						               <th align="center"><b>CITE</b></th>
						               <th align="center"><b>DESTINATARIO</b></th>
						               <th align="center"><b>REFERENCIA</b></th>
						               <th align="center"><b>FECHA</b></th>
						               <td align="center"><b></b></td>
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php $dataReader=Documentos::getNurisSinDerivar(); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="center"><?=$row['nur']?></td>
						            <td align="center"><?=$row['codigo']?></td>
						            <td align="center">
						            	<?=$row['destinatario']?><br>
						            </td>
						            <td align="left"><?=$row['referencia']?></td>
						            <td align="center"><?=date("d/m/Y", strtotime($row['fecha']));?></td>
						            <td align="center">
						            	<a class="btn btn-app" href="index.php?r=documentos/updateDocument&id_documento=<?=$row['id_documento']?>&tipo_documento=<?=$row['id_tipo_documento']?>" style="color: black;">
                  						<i class="fa fa-edit"></i>Editar
                						</a>
						            </td>
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table> -->
			<!-- ################################################################################################# -->	


			<?php

		//if (Yii::app()->user->id_nivel!=2) {
			
		$rawdata=Documentos::getNurisSinDerivar();				    		

        $data = new CArrayDataProvider($rawdata, array(
            'keyField' => 'id_documento',
            'sort' => array(//optional and sortring
                'attributes' => array(
                    'id_documento','nur','codigo','destinatario','referencia','fecha','id_tipo_documento'),
            ),
            'pagination' => array('pageSize' => 20))
        );


		/*Yii::import('zii.widgets.grid.CGridView');
		class SpecialGridView extends CGridView {
		    public $id_hoja_ruta;
		    public $nuri;
		} */       

		$this->widget('zii.widgets.grid.CGridView', array(
		//$this->widget('SpecialGridView', array(
		    'dataProvider'=>$data,
		    //'id_hoja_ruta'=>Yii::app()->user->id_nivel,

		    'selectableRows' => 2,
		    'columns' => array(        
		        /*array(
		            'header' => 'No',
		            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
		            'htmlOptions'=>array('style'=>'text-align:center'),
		        ),*/
		       		array(
			            'header' => 'NUR/NURI',           
			            'name' => 'nur',
			            'htmlOptions'=>array('style'=>'text-align: center; font-size:14px;'),
			            //'cssClassExpression' => '$data["oficial"] == 1 ? "registro_oficial" : "registro_copia"',
			        ),
			        array(
			            'header' => 'CITE',           
			            'name' => 'codigo',
			            'htmlOptions'=>array('style'=>'text-align: left; font-size:14px;'),
			            //'cssClassExpression' => '$data["oficial"] == 1 ? "registro_oficial" : "registro_copia"',
			        ),
			        array(
			        		'header'=>'DESTINATARIO',
			        		'name'=>'destinatario',
							'htmlOptions'=>array('style'=>'text-align:left; padding-left:15px; font-size:14px;'),
							//'cssClassExpression' => '$data["oficial"] == 1 ? "registro_oficial" : "registro_copia"',
						),
			        array(
			        		'header'=>'REFERENCIA',
			        		'name'=>'referencia',
							'htmlOptions'=>array('style'=>'text-align:left; padding-left:15px; font-size:14px;'),
							//'cssClassExpression' => '$data["oficial"] == 1 ? "registro_oficial" : "registro_copia"',
						),
			        array(
			            'header' => 'FECHA',           
			            'name' => 'fecha',
			            'value'=>'Yii::app()->dateFormatter->format("dd/MM/y",strtotime($row["fecha"]))',
			            'htmlOptions'=>array('style'=>'text-align: left; font-size:14px;'),
			            //'cssClassExpression' => '$data["oficial"] == 1 ? "registro_oficial" : "registro_copia"',
			        ),

			        array( //we have to change the default url of the button(s)(Yii by default use $data->id.. but $data in our case is an array...)
			            'class' => 'CButtonColumn',
			            'template' => '{editar}{derivar}',
			            'header' => 'Opciones',
			            'htmlOptions'=>array('style'=>'width:190px; text-align:center;'),
			            //'value'=>'valor',
			            'buttons' => array(

			                'editar'=>array(
						    	'label'=>'<i class="fa fa-edit"></i> Editar',

			              		'url'=>'Yii::app()->createUrl("documentos/updateDocument",array("id_documento"=>$data["id_documento"],"tipo_documento"=>$data["id_tipo_documento"],))',

			  		            'options' => array(
			              					'class'=>'editar btn btn-default btn-sm',
			              					'title'=>'Editar Documento',
			              					'style'=>'font-size:15px; color: white; background-color: #0489B1;'
			              						), 	
							),// fin editar

							'derivar'=>array(
						    	'label'=>'<i class="fa fa-share-square-o"></i> Derivar',

			              		'url'=>'Yii::app()->createUrl("seguimientos/derivarDocumento",array("id_documento"=>$data["id_documento"],"id_hoja_ruta"=>$data["id_hoja_ruta"],))',

			  		            'options' => array(
			              					'class'=>'derivar btn btn-default btn-sm',
			              					'title'=>'Derivar Documento',
			              					'style'=>'font-size:15px; color: white; background-color: #0489B1;'
			              						), 	
							),// fin editar


			                 
			           ),// fin buttons 
			        ), // fin array



		        
			    ),
			 ));


			 ?>

						    	
			<!-- ################################################################################################# -->						    	



			</div>      
			</div>
      	  </div>
        </div>
        <!-- ./row -->
    </div>
 </section>




