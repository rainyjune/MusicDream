<?php
$this->breadcrumbs=array(
	'标签'=>array('index'),
	$model->name,
);

Yii::app()->clientScript->registerScript('addToPlayList', "

    /* 点击 id 为 SubmitButton 元素（'试听所选'），检查是否选中至少一首歌曲 */
    $('#SubmitButton').click(function(){
        if ($(\"[name='id[]']:checked\").length < 1){
            alert('请选择歌曲');return false;
        }
    });
    /* 点击 id 为 addButton 的元素（'添加到播放列表'）,检查是否选中至少一个歌曲  */
    $(\"#addButton\").click(function(){
        if ($(\"[name='id[]']:checked\").length < 1){
                alert(\"请选择歌曲\");
                return false;
        }
        $.ajax({
            type    : 'POST',
            cache   : false,
            url     : 'index.php?r=Playlist/addToPlayList',
            data    : $('#albumForm').serializeArray(),
            success: function(data){ $.fancybox(data);}
        });
        return false;
    });
    /* 点击 id 为 checkAll 的元素（'全选'）,选中所有歌曲 */
    $('#checkAll').click(function(){
        $(\"[name='id[]']\").attr('checked','true');//全选
    });

");
$this->menu=array(
	array('label'=>'列出标签', 'url'=>array('index')),
	array('label'=>'创建标签', 'url'=>array('create')),
	array('label'=>'更新标签', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除标签', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定删除此项吗？')),
	array('label'=>'管理标签', 'url'=>array('admin')),
);
?>

<h1>标签 <?php echo $model->name; ?></h1>

<form id="albumForm" action="index.php" method="get">
<input type="hidden" name="r" value='music/view' />
<table>
<?php
$this->widget('zii.widgets.CListView',array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_music',
)
);
?>
<tr>
	<td colspan="4"><input id="checkAll" type="checkbox" />全选&nbsp;<input id="SubmitButton" type="submit" value="试听选中的音乐" />&nbsp;<input id="addButton" type="button" value="加入播放列表" /></td>
</tr>
</table>
</form>
