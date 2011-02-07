<?php
$this->breadcrumbs=array(
	'艺术家'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'更新',
);

$this->menu=array(
	array('label'=>'列出艺术家', 'url'=>array('index')),
	array('label'=>'添加艺术家', 'url'=>array('create')),
	array('label'=>'查看艺术家', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理艺术家', 'url'=>array('admin')),
);
?>

<h1>更新艺术家 <?php echo $model->name; ?></h1>

<?php echo $this->renderPartial('_update', array('model'=>$model)); ?>