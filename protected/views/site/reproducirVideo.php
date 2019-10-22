<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>


<center>

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


              	 

              		<?php  

            //$ruta=Yii::app()->request->baseUrl."/tutorial/".$nombre.".mp4";
            /*
           
            $this->widget('ext.Yiippod.Yiippod', array(
            'video'=>$ruta, //if you don't use playlist
            //'video'=>"http://www.youtube.com/watch?v=qD2olIdUGd8", //if you use playlist
            'id' => 'yiippodplayer',
              'autoplay'=>true,
            'width'=>640,
            'view'=>6, 
            'height'=>480,
            'bgcolor'=>'#000'
            )); */

            $ruta=Yii::app()->request->baseUrl."/tutorial/login.mp4";
            $this->widget ( 'ext.mediaElement.MediaElementPortlet',
                array ( 
                //'url' => 'http://www.toxsl.com/test/bunny.mp4',
                'url' => $ruta,
              // or you can set the model and attributes
                //'model' => $model,
                //'attribute' => 'url'
              // its required and so you have to set correctly
                // 'mimeType' =>'audio/mp3',
                'mimeType' =>'video/mp4',
            ));

					?>

              	
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


</center>

