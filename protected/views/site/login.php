

<center>
<img src="<?php echo Yii::app()->request->baseUrl; ?>/images/SAC.png" alt="ABC"
           style="opacity:.8; width:32%"  >

<!--<img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/SIACO3.jpg" alt="ABC"
           style="opacity:.8; width:40%"  >-->

</center>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>


<?php
//echo date('Y-m-d H:i:s')

//$modelo='admin';

//echo "--> ".hash('sha512', $modelo);

?>
<p class="note"></p>
	<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!-- right column -->
          <div class="col-md-12">
            
            <!-- general form elements disabled -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title"><i class="fa fa-address-card-o"></i> Por favor complete todos los campos</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                
                  <!-- text input -->
                  <div class="form-group">
          					 <label>
          					<?php echo $form->labelEx($model,'Usuario *'); ?>
          					</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-user"></i>
                          
                        </span>
                      </div>
          					   <?php echo $form->textField($model,'username', array('class'=>'form-control','autofocus'=>true)); ?>
                    </div>
          					<?php echo $form->error($model,'username'); ?>
                  </div>
                  <div class="form-group">

                    

                  </div>  
                  <div class="form-group">
        					 <label>
        					<?php echo $form->labelEx($model,'Contraseña *'); ?>
        					</label>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fa fa-key"></i>
                        </span>
                      </div>
        						  <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
                    </div>
        						<?php echo $form->error($model,'password'); ?>
					
                  </div>

                  
              </div>
              <!-- /.card-body -->

              <div class="card-footer">
            <?php echo CHtml::submitButton('Ingresar', array('class' => 'btn btn-info')); ?>


              </div>
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>



	

	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>

	

<?php $this->endWidget(); ?>



