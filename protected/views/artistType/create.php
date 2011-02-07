<?php
$this->breadcrumbs=array(
	'艺术家类型'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出艺术家类型', 'url'=>array('index')),
	array('label'=>'管理艺术家类型', 'url'=>array('admin')),
);
?>

<h1>添加艺术家类型</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>