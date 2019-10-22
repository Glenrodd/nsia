<head>
	<style type="text/css">
		
	</style>
</head>
<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Administracion',
);

/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
);*/
?>

<head>
	<!--<script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery-1.12.4.js"></script>
    <script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/dataTables.colReorder.min.js"></script>
    <script type="text/javascript" language="javascript" src="<?php //echo Yii::app()->request->baseUrl; ?>/js/jquery.dataTables.min.js"></script>
    <link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link type="text/css" href="<?php //echo Yii::app()->request->baseUrl; ?>/css/colReorder.dataTables.min.css" rel="stylesheet" /> -->

	<script type="text/javascript">
				    /*$(document).ready(function() {
				    // Setup - add a text input to each footer cell
				    $('#example thead th').each( function () {
				        var title = $('#example thead th').eq( $(this).index() ).text();
				        $(this).html( '<input type="text" placeholder="Buscar..." />' );
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
				    } );    */



					function destinatario(valor1, valor2){	

						$("#user_destino").html(valor1);
						$("#derivado_a").val(valor2);
						//$("#usuario_destino").val(valor3);
					}
					</script>
</head>

<h3><strong>Administrar Lista de Derivaci&oacute;n</strong></h3>

<section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Retornar',array('site/menuDerivaciones'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                  </tr>
                </table>
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section>  

 <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de usuarios habilitados en el Sistema.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">


					<?php $this->widget('zii.widgets.grid.CGridView', array(
						'id'=>'usuarios-grid',
						'dataProvider'=>$model->searchActivo(),
						'filter'=>$model,
						'columns'=>array(
							//'nombre',
							array(
								'header' =>'Nombres' , 
								'name' =>'nombre', 
								'value' =>'$data->nombre' , 
								'htmlOptions'=>array('style'=>'text-align:left; font-size:13px;',),
							),
							array(
								'header'=>'Gerencia Regional',
								'name'=>'fk_regional',
								'value'=>'$data->fkRegional->regional',
								'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),

					      	'filter'=> CHtml::listData(Regionales::model()->findAll(array('order'=>'id_regional')), 'id_regional', 'regional')

							),
							array(
									'name'=>'fk_area',
									'header'=>'Área/Unidad',
									'value'=>'$data->fkArea->area',
									'htmlOptions'=>array('style'=>'text-align:center; font-size:13px;',),
									//'filter'=>false,
									'filter' => CHtml::activeTextField($model, 'fkArea_area'),
							),
							array(
						        'class'=>'CButtonColumn',
						        'template' => '{addUsuario}',
						        'htmlOptions'=>array('width'=>'90px','style'=>'text-align:center',),
						        //'template' => '{solicitudPdf}',
						        'buttons'=>array(
						          'addUsuario' => array(
						            'label'=>'Añadir a la Lista',
						            'url'=>"CHtml::normalizeUrl(array('addUsuarioDerivacion', 'id'=>\$data->id_usuario
						              ))",
						                'imageUrl'=>Yii::app()->request->baseUrl.'/images/add_user.png',
						              'options' => array('class'=>'addUsuario'),
						            ),
						          ),
						        ), // fin buttons
						),
					));  ?>


					<!--<div class="card-body pad table-responsive">
						        <table id="example" class="display" style="width:100%">
						         <thead>
						            <tr>
						               <td align="center"><b>Nombres</b></td>
						               <td align="center"><b>Gerencia Regional</b></td>
						               <td align="center"><b>&Aacute;rea/Unidad</b></td>
						               <td align="center"><b></b></td>
						               
						            </tr>
						            <tr>
						               <th align="center"><b>Nombres</b></th>
						               <th align="center"><b>Gerencia Regional</b></th>
						               <th align="center"><b>&Aacute;rea/Unidad</b></th>
						               <td align="center"><b></b></td>
						               
						            </tr>
						         </thead>
						       	 <tbody>
						         <?php 

						         $regional=Yii::app()->user->regional;

						         if ($regional==1) {
						         	$dataReader=Usuarios::getListaDerivacionArea(); 
						         }
						         else{
						         	$dataReader=Usuarios::getListaDerivacionRegional(); 
						         }

						         ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left"><?=$row['nombre_funcionario']?></td>
						            <td align="left"><?=$row['nombre_regional']?></td>
						            <td align="left"><?=$row['nombre_area']?></td>
						            <td>
						            	<?php 
											  echo CHtml::link(
								          CHtml::image(Yii::app()->baseUrl.'/images/add_user.png'), 
								               array('usuarios/addUsuarioDerivacion', 'id'=>$row['id_funcionario']));
								         
											?>
						            </td>
						            
						           </tr>
						         <?php } 

						         $dataReader=Usuarios::getListaDerivacionNacional(); ?>	
						         <?php foreach ($dataReader as $row) { ?>	
						           <tr>
						            <td align="left"><?=$row['nombre_funcionario']?></td>
						            <td align="left"><?=$row['nombre_regional']?></td>
						            <td align="left"><?=$row['nombre_area']?></td>

						            <td>
						            	<?php 
											  echo CHtml::link(
								          CHtml::image(Yii::app()->baseUrl.'/images/add_user.png'), 
								               array('usuarios/addUsuarioDerivacion', 'id'=>$row['id_funcionario']));
								         
											?>
						            </td>
						            
						           </tr>
						         <?php } ?>    	 
						         </tbody>
						    	</table>
						    </div> -->


              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-6">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Detalle de usuarios almacenados para derivar.</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">

				<div class="row">
		          <div class="col-md-12">
		            <div class="card-body pad table-responsive">
		              
		             
		                <table class="table table-bordered table-striped">
		                  <tr style="font-size: 16px;">
		              			<th align="center">Nombres</th>
		              			<th align="center">Gerencia Regional</th>
		              			<th align="center">&Aacute;rea/Unidad</th>
		              			<th></th>
		              	  </tr>
		              	  <?php foreach ($hojas as $hoja) { ?>
							   
							    <tr  style="font-size: 13px;">
							        <td><?=$hoja["nombre_destino"]?></td>
							        <td><?=$hoja["nombre_regional"]?></td>
							        <td><?=$hoja["nombre_area"]?></td>
							        <td>
									<?php echo CHtml::link('Eliminar',array('usuarios/deleteUsuarioDerivacion',
                                         		'id'=>$hoja["id_lista_derivacion"]), array('class'=>'btn btn-danger')); ?>
							        </td>
							    </tr>
							    
							<?php } ?>
		                </table>
		                
		                <?php 
							if(!isset($_GET["page"])){
							    $_GET["page"]=1;
							}
							//Pinta los enlaces del paginador
							$this->widget(
							    'CLinkPager', 
							    array(
							        'pages' => $pages,
							        'maxButtonCount'=>"5:5", //Rango de links de paginas a mostrar 
							        'header' =>"<div class='pagination pagination-sm m-0 float-right'>",
							        'footer' =>"</div>",
							        'nextPageLabel'=>"Siguiente",
							        'prevPageLabel'=>"Anterior",
							        "firstPageLabel"=>"Primero",
							        "lastPageLabel"=>"Último",

							        // css class        
							       /* 'firstPageCssClass'=>'pager_first',//default "first"
							        'lastPageCssClass'=>'pager_last',//default "last"
							        'previousPageCssClass'=>'pager_previous',//default "previours"
							        'nextPageCssClass'=>'pager_next',//default "next"
							        'internalPageCssClass'=>'pager_li',//default "page"
							        'selectedPageCssClass'=>'pager_selected_li',//default "selected"
							        'hiddenPageCssClass'=>'pager_hidden_li',//default */


							        "selectedPageCssClass"=>"active",
							        "hiddenPageCssClass"=>"disable",
							        "htmlOptions"=>array("class"=>"pagination"),
							    )
							);
							?>
							</div> 
		          </div>
		          <!-- /.col -->

		        </div>
		        <!-- /.row -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



