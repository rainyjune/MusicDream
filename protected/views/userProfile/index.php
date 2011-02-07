<?php
$this->breadcrumbs=array(
	'User Profiles',
);

$this->menu=array(
	array('label'=>'Create UserProfile', 'url'=>array('create')),
	array('label'=>'Manage UserProfile', 'url'=>array('admin')),
);
?>

<h1>User Profiles</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
