<?php
$this->breadcrumbs=array(
	'标签',
);

$this->menu=array(
	array('label'=>'增加标签', 'url'=>array('create')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>Tags</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
