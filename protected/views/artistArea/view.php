<?php
$this->breadcrumbs=array(
	'Artist Areas'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'列出艺术家地区', 'url'=>array('index')),
	array('label'=>'添加艺术家地区', 'url'=>array('create')),
	array('label'=>'更新艺术家地区', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除艺术家地区', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理艺术家地区', 'url'=>array('admin')),
);
?>

<h1>查看艺术家地区 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'intro',
	),
)); ?>
