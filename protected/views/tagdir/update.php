<?php
$this->breadcrumbs=array(
	'Tagdirs'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Tagdir', 'url'=>array('index')),
	array('label'=>'Create Tagdir', 'url'=>array('create')),
	array('label'=>'View Tagdir', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Tagdir', 'url'=>array('admin')),
);
?>

<h1>Update Tagdir <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>