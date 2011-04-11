<?php
$this->breadcrumbs=array(
	'Tagdirs',
);

$this->menu=array(
	array('label'=>'Create Tagdir', 'url'=>array('create')),
	array('label'=>'Manage Tagdir', 'url'=>array('admin')),
);
?>

<h1>Tagdirs</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
