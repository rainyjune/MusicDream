<?php
$this->breadcrumbs=array(
	'系统变量',
);

$this->menu=array(
	array('label'=>'添加变量', 'url'=>array('create')),
	array('label'=>'管理变量', 'url'=>array('admin')),
);
?>

<h1>Vars</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
