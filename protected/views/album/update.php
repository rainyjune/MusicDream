<?php
$this->breadcrumbs=array(
	'Albums'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Album', 'url'=>array('index')),
	array('label'=>'Create Album', 'url'=>array('create')),
	array('label'=>'View Album', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Album', 'url'=>array('admin')),
);
?>

<h1>更新专辑 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_update', array('model'=>$model)); ?>