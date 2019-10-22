<?php
/* @var $this ActiveRecordLogController */
/* @var $model ActiveRecordLog */

$this->breadcrumbs=array(
	'Active Record Logs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ActiveRecordLog', 'url'=>array('index')),
	array('label'=>'Manage ActiveRecordLog', 'url'=>array('admin')),
);
?>

<h1>Create ActiveRecordLog</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>