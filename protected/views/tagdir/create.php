<?php
$this->breadcrumbs=array(
	'Tagdirs'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Tagdir', 'url'=>array('index')),
	array('label'=>'Manage Tagdir', 'url'=>array('admin')),
);
?>

<h1>Create Tagdir</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>