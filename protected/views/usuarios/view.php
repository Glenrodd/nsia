<?php
/* @var $this UsuariosController */
/* @var $model Usuarios */

$this->breadcrumbs=array(
	'Usuarioses'=>array('index'),
	$model->id_usuario,
);

/*$this->menu=array(
	array('label'=>'List Usuarios', 'url'=>array('index')),
	array('label'=>'Create Usuarios', 'url'=>array('create')),
	array('label'=>'Update Usuarios', 'url'=>array('update', 'id'=>$model->id_usuario)),
	array('label'=>'Delete Usuarios', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id_usuario),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Usuarios', 'url'=>array('admin')),
);*/
?>


<h3><strong>Ver Usuario #<?php echo $model->id_usuario; ?></strong></h3>

<!-- Main content -->
 <section class="content">
    <div class="container-fluid">
        <div class="row">
          <div class="col-md-8">
          	<div class="card-body pad table-responsive">	
                <table class="table table-bordered text-center">
                  <tr>
                    <td>
                      <?php echo CHtml::link('Nuevo Registro',array('usuarios/create'), array('class'=>'btn btn-block btn-success')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Actualizar Registro',array('usuarios/update','id'=>$model->id_usuario), array('class'=>'btn btn-block btn-info')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Eliminar Registro',"#", array("submit"=>array('delete', 'id'=>$model->id_usuario), 'confirm' => 'Realmente desea eliminar este registro','class'=>'btn btn-block btn-danger')); ?>
                    </td>
                    <td>
                      <?php echo CHtml::link('Administración',array('usuarios/admin'), array('class'=>'btn btn-block btn-warning')); ?>
                    </td>

                    <td>
                      <?php 

                        if ($model->fk_nivel==1 || $model->fk_nivel==3) {
                          
                      ?>
                      <?php //echo CHtml::link('Adicionar Alias',array('usuarios/admin'), array('class'=>'btn btn-block btn-primary')); ?>

                      <?php echo CHtml::link('Adicionar Reponsable', "",  
                      // the link for open the dialog
                        array('class'=>'btn btn-block btn-primary',
                        'style'=>'cursor: pointer; text-decoration: none; color:white;',
                        'onclick'=>"{addClassroom(); $('#dialogClassroom').dialog('open');}"));?>



                       <?php 
                            }
                        ?>
                    </td>
                  </tr>

                </table>
            </div>    
      	 </div>
        </div>
        <!-- ./row -->
    </div>
 </section> 


 <?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array( // the dialog
    'id'=>'dialogClassroom',
    'options'=>array(
        'title'=>'Adicionar usuario a Gerencia o Regional',
        'autoOpen'=>false,
        'modal'=>true,
        'width'=>'60%',
        'height'=>470,
    ),
));?>
<div class="divForForm"></div>

<?php $this->endWidget();?>

<script type="text/javascript">
// here is the magic
function addClassroom()
{
  <?php echo CHtml::ajax(array(
      'url'=>array('alias/create', 'id'=>$model->id_usuario),
      'data'=> "js:$(this).serialize()",
      'type'=>'post',
      'dataType'=>'json',
      'success'=>"function(data)
      {
        if (data.status == 'failure')
        {
          $('#dialogClassroom div.divForForm').html(data.div);
                          // Here is the trick: on submit-> once again this function!
          $('#dialogClassroom div.divForForm form').submit(addClassroom);
        }
        else
        {
          $('#dialogClassroom div.divForForm').html(data.div);
          setTimeout(\"$('#dialogClassroom').dialog('close') \",3000);
          location.reload();
        }
        
      } ",
      ))?>;
  return false; 
  
}

</script>





<section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                  <!-- text input -->

					<?php $this->widget('zii.widgets.CDetailView', array(
						'data'=>$model,
						'attributes'=>array(
							//'id_usuario',
							'nombre',
							'cargo',
							'usuario',
							//'password',
							'correo',
							'mosca',
							//'fk_perfil',
							array(
								'name'=>'Perfil de Usuario',
								'value'=>$model->fkPerfil->perfil,
							),
							//'fk_regional',
							array(
								'name'=>'Gerencia Regional',
								'value'=>$model->fkRegional->regional,
							),
							//'fk_area',
							array(
								'name'=>'Área/Unidad',
								'value'=>$model->fkArea->area,
							),
							//'fk_nivel',
							array(
								'name'=>'Nivel de usuario',
								'value'=>$model->fkNivel->nivel,
							),
							//'fecha_registro',
							//'hora_registro',
							//'update_password',
							//'activo',
							array(
								'name'=>'Estado',
								'value'=>$model->activo==1?'Habilitado':'Deshabilitado',
							),
						),
					)); ?>
                  
              </div>
              <!-- /.card-body -->
              <div class="card-footer">
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
</section>


<?php 

  if ($model->fk_nivel==1 || $model->fk_nivel==3) {
      
      $id_alias=Usuarios::getAlias($model->id_usuario);

      if ($id_alias==0) { 
        

        ?>

              <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <!-- right column -->
                        <div class="col-md-12">
                          <!-- general form elements disabled -->
                          <div class="card card-info">
                            <div class="card-header">
                              <h3 class="card-title">Personal Responsable</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                

                              <div style="color: darkblue;" >
                                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                  <h5><i class="icon fa fa-warning"></i> Alert!</h5><hr><i>
                                 Es necesario registrar el nombre y cargo del personal responsable del Área/Unidad, Subgerencia, Gerencia Nacional o Gerencia Regional<br>
                                 Seleccione la opci&oacute;n  <strong>"Adicionar Reponsable"</strong>
                                 </i>
                               </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            </div>
                          </div>
                          <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
              </section>

      <?php }
      else{ 
        $alias=Alias::model()->findByPk($id_alias);
        ?>
              <section class="content">
                    <div class="container-fluid">
                      <div class="row">
                        <!-- right column -->
                        <div class="col-md-12">
                          <!-- general form elements disabled -->
                          <div class="card card-info">
                            <div class="card-header">
                              <h3 class="card-title">Personal Responsable</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                               <?php $this->widget('zii.widgets.CDetailView', array(
                                'data'=>$alias,
                                'attributes'=>array(
                                  
                                  //'nombre',
                                  array(
                                    'name'=>'Encargado/Responsable',
                                    'value'=>$alias->nombre,
                                  ),
                                  //'cargo',
                                  array(
                                    'name'=>'Cargo',
                                    'value'=>$alias->cargo,
                                  ),
                                  
                                  
                                 
                                ),
                              )); ?> 
                              
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                            </div>
                          </div>
                          <!-- /.card -->
                        </div>
                        <!--/.col (right) -->
                      </div>
                      <!-- /.row -->
                    </div><!-- /.container-fluid -->
              </section>

            



      <?php }
    
  }



    //$model=Alias::model()->findByPk($id);
?>


