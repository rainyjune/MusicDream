<?php
$this->breadcrumbs=array(
	'播放列表',
);

$this->menu=array(
	array('label'=>'添加播放列表', 'url'=>array('create')),
	array('label'=>'管理播放列表', 'url'=>array('admin')),
);
?>

<h1>播放列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
