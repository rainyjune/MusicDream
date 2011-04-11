<?php
$this->breadcrumbs=array(
	'Menus'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'列出栏目', 'url'=>array('index')),
	array('label'=>'添加栏目', 'url'=>array('create')),
	array('label'=>'查看栏目', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理栏目', 'url'=>array('admin')),
);
?>

<h1>更新栏目 <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>