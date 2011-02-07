<?php
$this->breadcrumbs=array(
	'播放列表'=>array('index'),
	'添加',
);

$this->menu=array(
	array('label'=>'列出播放列表', 'url'=>array('index')),
	array('label'=>'管理播放列表', 'url'=>array('admin')),
);
?>

<h1>添加播放列表</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>