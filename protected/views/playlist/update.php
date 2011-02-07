<?php
$this->breadcrumbs=array(
	'播放列表'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'列出管理列表', 'url'=>array('index')),
	array('label'=>'添加播放列表', 'url'=>array('create')),
	array('label'=>'查看播放列表', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理播放列表', 'url'=>array('admin')),
);
?>

<h1>更新播放列表 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>