<?php
$this->breadcrumbs=array(
	'Tagdirs',
);

$this->menu=array(
	array('label'=>'添加音乐分类', 'url'=>array('create')),
	array('label'=>'管理音乐分类', 'url'=>array('admin')),
	array('label'=>'添加标签','url'=>array('tag/create')),
	array('label'=>'管理标签','url'=>array('tag/admin')),
);
?>

<h1>Tagdirs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
