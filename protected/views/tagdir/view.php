<?php
$this->breadcrumbs=array(
	'Tagdirs'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Tagdir', 'url'=>array('index')),
	array('label'=>'Create Tagdir', 'url'=>array('create')),
	array('label'=>'Update Tagdir', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Tagdir', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Tagdir', 'url'=>array('admin')),
);
?>

<h1>View Tagdir #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
	),
)); ?>
