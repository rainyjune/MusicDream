<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	'管理',
);

$this->menu=array(
	array('label'=>'列出用户', 'url'=>array('index')),
	array('label'=>'创建用户', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>管理用户</h1>

<p>
你可以在搜索值之前使用对比符 (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) 以指定如何完成对比。
</p>

<?php echo CHtml::link('高级搜索','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'summaryText'=>'这是 {start} 到 {end} 共 {count} 条记录',
	'columns'=>array(
		'id',
		'username',
		//'password',
		'email',
                array(           
                    'name'=>'created_time',
                    'value'=>'date("M j, Y", $data->created_time)',
                ),
                array(            
                    'name'=>'lastlogin_time',
                    'value'=>'date("M j, Y", $data->lastlogin_time)',
                ),
		array(
			'class'=>'CButtonColumn',
                        'updateButtonUrl'=>'CHtml::normalizeUrl(array("/user/update","id"=>$data->id,"from"=>"dashboard"))',
                        'viewButtonUrl'=>'CHtml::normalizeUrl(array("/user/view","id"=>$data->id,"from"=>"dashboard"))',
		),
	),
)); ?>
