<?php
$this->breadcrumbs=array(
	'标签'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出标签', 'url'=>array('index')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>添加标签</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>