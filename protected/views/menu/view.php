<?php
$this->breadcrumbs=array(
	'栏目'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'列出栏目', 'url'=>array('index')),
	array('label'=>'添加栏目', 'url'=>array('create')),
	array('label'=>'更新栏目', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除栏目', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除此项数据?')),
	array('label'=>'管理栏目', 'url'=>array('admin')),
);
?>

<h1>查看栏目 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'menu_name',
		'description',
		'sort',
	),
)); ?>
