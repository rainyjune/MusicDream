<?php
$this->breadcrumbs=array(
	'Vars'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'列出变量', 'url'=>array('index')),
	array('label'=>'添加变量', 'url'=>array('create')),
	array('label'=>'更新变量', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除变量', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除此项数据?')),
	array('label'=>'管理变量', 'url'=>array('admin')),
);
?>

<h1>View Vars #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'varname',
		'varvalue',
	),
)); ?>
