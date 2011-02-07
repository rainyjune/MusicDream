<?php
$this->breadcrumbs=array(
	'音乐'=>array('index'),
	'增加',
);

$this->menu=array(
	array('label'=>'列出音乐', 'url'=>array('index')),
	array('label'=>'管理音乐', 'url'=>array('admin')),
);
?>

<h1>添加音乐</h1>

<?php echo $this->renderPartial('_create', array('model'=>$model)); ?>