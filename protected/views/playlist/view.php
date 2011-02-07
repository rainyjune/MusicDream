<?php
$this->breadcrumbs=array(
	'播放列表'=>array('index'),
	$model->name,
);

Yii::app()->clientScript->registerScript('addToPlayList', "

$(document).ready(function(){

	$(\"#SubmitButton\").click(function(){
				if ($(\"[name='id[]']:checked\").length < 1){
					alert(\"请选择歌曲\");
					return false;
				}
	});
			
	$('#checkAll').click(function(){
           
          $(\"[name='id[]']\").attr(\"checked\",'true');//全选
        
       })
	$('#checkXor').click(function(){
           
          $(\"[name='id[]']\").each(function(){
              
            
              if($(this).attr('checked'))
            {
                $(this).removeAttr('checked');
                
            }
            else
            {
                $(this).attr('checked','true');
                
            }
            
          })
        
       })

});
");
$this->menu=array(
	array('label'=>'列出播放列表', 'url'=>array('index')),
	array('label'=>'添加播放列表', 'url'=>array('create')),
	array('label'=>'更新播放列表', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除播放列表', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除此项?')),
	array('label'=>'管理播放列表', 'url'=>array('admin')),
);
?>

<h1>查看播放列表 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'intro',
		'uid',
		'add_time',
	),
)); ?>
<form id="albumForm" action="index.php" method="get">
<input type="hidden" name="r" value='music/view' />
<table>
<tr>
<td>&nbsp;</td><td>歌曲</td><td>歌手</td>
</tr>
<?php
echo '<pre>';
//var_dump($model->playlistMusics);
foreach($model->playlistMusics as $musicObject)
{
echo '<tr>';
echo '<td>';
//	var_dump($musicObject->music->name);
echo CHtml::checkBox("id[]",false,array("value"=>"{$musicObject->music->id}"));
echo '</td>';
echo '<td>';
echo CHtml::encode($musicObject->music->name);
echo '</td>';
echo '<td>';
echo CHtml::encode($musicObject->music->artist->name);
echo '</td>';
echo '</tr>';
}


?>
</table>
<input id="checkAll" type="button"  value="全选" /><input type="button" id="checkXor"  value="反选" />
<input id="SubmitButton" type="submit"  value="试听所选" />
</form>