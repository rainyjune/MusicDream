<?php
$this->breadcrumbs=array(
	'专辑',
);

$this->menu=array(
	array('label'=>'增加专辑', 'url'=>array('create')),
	array('label'=>'管理专辑', 'url'=>array('admin')),
);
?>

<h1>专辑列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录'
)); ?>
