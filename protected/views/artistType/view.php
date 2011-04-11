<?php
$this->breadcrumbs=array(
	'艺术家类型'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'列出艺术家类型', 'url'=>array('index')),
	array('label'=>'添加艺术家类型', 'url'=>array('create')),
	array('label'=>'更新艺术家类型', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除艺术家类型', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除此项数据?')),
	array('label'=>'管理艺术家类型', 'url'=>array('admin')),
);
?>

<h1>查看艺术家类型 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'intro',
	),
)); ?>
