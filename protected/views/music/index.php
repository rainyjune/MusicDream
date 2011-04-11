<?php
$this->breadcrumbs=array(
	'音乐',
);

$this->menu=array(
	array('label'=>'增加音乐', 'url'=>array('create')),
	array('label'=>'管理音乐', 'url'=>array('admin')),
);
?>

<h1>音乐列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录'
)); ?>
