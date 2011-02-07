<?php
$this->breadcrumbs=array(
	'栏目'=>array('index'),
	'创建',
);

$this->menu=array(
	array('label'=>'列出栏目', 'url'=>array('index')),
	array('label'=>'管理栏目', 'url'=>array('admin')),
);
?>

<h1>添加栏目</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>