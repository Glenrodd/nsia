<?php
/* @var $this HojasRutaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Hojas Rutas',
);

/*$this->menu=array(
	array('label'=>'Create HojasRuta', 'url'=>array('create')),
	array('label'=>'Manage HojasRuta', 'url'=>array('admin')),
);*/
?>


<h3><strong>Reporte de NURI(s) creado por mi usuario</strong></h3>

<section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <!--/.col (right) -->
          <!-- right column -->
          <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="card card-info">
              <!-- /.card-header -->
              <div class="card-body">

				<div class="row">
		          <div class="col-md-8">

		          	 <div class="card-body table-responsive pad">


		        <table class="table table-bordered">
                  <tr>
                    <th>Seleccione Gesti&oacute;n</th>
                    
                  </tr>
                  <!-- Default -->
                   <?php 

			            $dataReader=HojasRuta::getGestion();


						foreach($dataReader as $row) {
		              	?>
		              	   <tr>
			                    <td>
			                      <div class="btn-group-vertical">

			                        <a class="btn btn-info" href="index.php?r=HojasRuta/adminGestion&gestion=<?=$row['gestion']?>" style="color:white;">
			                        	<i class="fa fa-list"></i>&nbsp;&nbsp;&nbsp;
			                        	<?=$row['gestion']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			                        </a>

			                      </div>
			                    </td>
			                  </tr>
		              	<?php } ?>

                 
                  <!-- ./default -->
                </table>
              </div>
              <!-- /.card-body -->	



		            
		          </div>	
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

