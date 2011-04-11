<?php
$this->breadcrumbs=array(
	'Vars'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'列出变量', 'url'=>array('index')),
	array('label'=>'添加变量', 'url'=>array('create')),
	array('label'=>'查看变量', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'管理变量', 'url'=>array('admin')),
);
?>

<h1>Update Vars <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>