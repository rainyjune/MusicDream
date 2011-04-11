<?php
$this->breadcrumbs=array(
	'Vars'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'列出变量', 'url'=>array('index')),
	array('label'=>'管理变量', 'url'=>array('admin')),
);
?>

<h1>Create Vars</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>