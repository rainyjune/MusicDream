<?php
$this->breadcrumbs=array(
	'栏目',
);

$this->menu=array(
	array('label'=>'创建栏目', 'url'=>array('create')),
	array('label'=>'管理栏目', 'url'=>array('admin')),
);
?>

<h1>栏目列表</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
