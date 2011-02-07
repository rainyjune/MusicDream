<?php
$this->breadcrumbs=array(
	'标签'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'列出标签', 'url'=>array('index')),
	array('label'=>'创建标签', 'url'=>array('create')),
	array('label'=>'更新标签', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除标签', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定删除此项吗？')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>查看标签 <?php echo $model->name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
	),
)); ?>
