<?php
$this->breadcrumbs=array(
	'标签'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'列出标签', 'url'=>array('index')),
	array('label'=>'添加标签', 'url'=>array('create')),
	array('label'=>'查看标签', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>更新标签 <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>