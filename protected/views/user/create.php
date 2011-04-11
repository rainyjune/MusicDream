<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出用户', 'url'=>array('index')),
	array('label'=>'管理用户', 'url'=>array('admin')),
);
?>

<h1>添加用户</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>