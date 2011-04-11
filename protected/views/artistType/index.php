<?php
$this->breadcrumbs=array(
	'艺术家类型',
);

$this->menu=array(
	array('label'=>'增加艺术家类型', 'url'=>array('create')),
	array('label'=>'管理艺术家类型', 'url'=>array('admin')),
);
?>

<h1>艺术家类型</h1>
<?php
$this->widget('zii.widgets.grid.CGridView',array(
    'dataProvider'=>$dataProvider,
    'columns'=>array(
        'id',
        'name',
        'intro'
    )
))
?>
