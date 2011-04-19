<?php
$this->breadcrumbs=array(
	'艺术家'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'列出艺术家', 'url'=>array('index')),
	array('label'=>'增加艺术家', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('artist-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理艺术家</h1>

<p>
你可以在每个搜索值之前输入一个对比符 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
或 <b>=</b>) ，以指定对比如何完成。
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'artist-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录',
	'columns'=>array(
		//'id',
		//'type_id',
		
		//'area_id',
		//'menu_id',
		array(
			'name'=>'type_id',
			'value'=>'ArtistType::item($data->type_id)',
			'filter'=>ArtistType::items(),
		),
		array(
			'name'=>'area_id',
			'value'=>'ArtistArea::item($data->area_id)',
			'filter'=>ArtistArea::items(),
		),
		//'sort',
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), $data->url)'
		),
		
		/*
		'picture',
		'birthday',
		'native_place',
		'click',
		'intro',
		'add_uid',
		'add_time',
		'tag',
		*/
		array(
			'name'=>'proved',
			'value'=>'Lookup::item("PROVED",$data->proved)',
			'filter'=>Lookup::items('PROVED'),
		),
		array(
			'name'=>'add_time',
			'type'=>'datetime',
			'filter'=>false,
		),
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
