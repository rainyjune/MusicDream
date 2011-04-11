<?php
$this->breadcrumbs=array(
	'音乐'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'列出音乐', 'url'=>array('index')),
	array('label'=>'添加音乐', 'url'=>array('create')),
	array('label'=>'查看音乐', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理音乐', 'url'=>array('admin')),
);
?>

<h1>更新音乐 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_update', array('model'=>$model)); ?>