<?php
$this->breadcrumbs=array(
	'专辑'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出专辑', 'url'=>array('index')),
	array('label'=>'管理专辑', 'url'=>array('admin')),
);
?>

<h1>添加专辑</h1>

<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>