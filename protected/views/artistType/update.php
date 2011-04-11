<?php
$this->breadcrumbs=array(
	'Artist Types'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'列出艺术家类型', 'url'=>array('index')),
	array('label'=>'添加艺术家类型', 'url'=>array('create')),
	array('label'=>'查看艺术家类型', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理艺术家类型', 'url'=>array('admin')),
);
?>

<h1>更新艺术家类型 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>