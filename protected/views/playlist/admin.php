<?php
$this->breadcrumbs=array(
	'Playlists'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'列出播放列表', 'url'=>array('index')),
	array('label'=>'添加播放列表', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('playlist-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理播放列表</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'playlist-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'intro',
		'uid',
                array(
                    'name'=>'add_time',
                    'value'=>'date("Y-m-d",$data->add_time)'
                ),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
