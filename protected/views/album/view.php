<?php
$this->breadcrumbs=array(
	'专辑'=>array('index'),
	$model->name,
);

Yii::app()->clientScript->registerScriptFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js");
Yii::app()->clientScript->registerCssFile("https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css");
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
            success: function(data){ $.fancybox.open(data);}
        });
        return false;
    });
    /* 点击 id 为 checkAll 的元素（'全选'）,选中所有歌曲 */
    $('#checkAll').click(function(){
        $(\"[name='id[]']\").attr('checked','true');//全选
    });
    $('#checkXor').click(function(){
        $(\"[name='id[]']\").each(function(){
            if($(this).attr('checked')){
                $(this).removeAttr('checked');
            }
            else{
                $(this).attr('checked','true');
            }
        });
    });

");

$this->menu=array(
	array('label'=>'添加歌曲','url'=>array('music/create','album_id'=>$model->id)),
	array('label'=>'列出专辑', 'url'=>array('index')),
	array('label'=>'添加专辑', 'url'=>array('create')),
	array('label'=>'更新专辑', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除专辑', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理专辑', 'url'=>array('admin')),
);
?>

<!--<h1>View Album #<?php echo $model->id; ?></h1>-->

<table border="1">
  <tr>
    <td rowspan="5"><?php echo CHtml::image($model->picture,CHtml::encode($model->name));?>&nbsp;</td>
    <td>专辑</td>
    <td><?php echo CHtml::encode($model->name);?>&nbsp;</td>
  </tr>
  <tr>
    <td>歌手</td>
    <td><?php echo CHtml::link(CHtml::encode($model->artist->name),array('artist/view','id'=>$model->artist->id));?>&nbsp;</td>
  </tr>
  <tr>
    <td>发行时间</td>
    <td><?php echo CHtml::encode($model->pub_time);?>&nbsp;</td>
  </tr>
  <tr>
    <td>唱片公司</td>
    <td><?php echo CHtml::encode($model->company);?>&nbsp;</td>
  </tr>
  <tr>
    <td>标签</td>
    <td><?php 
            $rows=ItemsTags::returnTags(ItemsTags::ALBUM_TYPE,$model->id);
            echo '<pre>';
            foreach($rows as $row)
            {
                echo CHtml::link(CHtml::encode($row['name']),array('tag/view','id'=>$row['id']),array('target'=>'_blank'))."&nbsp;";
            }
	?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3"><p>专辑介绍：</p><?php echo $model->introduction;?>&nbsp;</td>
  </tr>
</table>
<h2>所有歌曲</h2>
<form id="albumForm" action="index.php" method="get">
<input type="hidden" name="r" value='music/view' />
<?php

$criteria=new CDbCriteria(array(
			'condition'=>'proved='.Music::STATUS_PROVED.' AND album_id='.$model->id,
		));
$dataProvider=new CActiveDataProvider('Music', array(
	'criteria'=>$criteria,
));

$this->widget('zii.widgets.grid.CGridView', array(
    'dataProvider'=>$dataProvider,
	'summaryText'=>'',
    'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::checkBox("id[]",false,array("value"=>"$data->id"))'
		),
		'order',
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), $data->urls)'
		),
		array(
			'name'=>'下载',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), $data->url)'
		),
    ),
));
?>
<?php
$ids=array();
foreach($model->musics as $music)
{
	$ids[]=$music->id;
}
$ids=implode('_',$ids);
?>
<input id="checkAll" type="button"  value="全选" /><input type="button" id="checkXor"  value="反选" />
<input id="SubmitButton" type="submit"  value="试听所选" />
<?php
if(!Yii::app()->user->isGuest)
{
	echo '<input id="addButton" type="button"  value="添加到播放列表" />';
}
?>
</form>
<div id="comments">
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount; ?> 条评论
		</h3>

		<?php 
                Yii::app()->clientScript->registerScript('comment-album', "
                    $('form#comment-form').submit(function(){
                        //return false;
                        //alert($(this).serialize());return false;
                            $.ajax({
                                type: 'POST',
                                url: 'index.php?r=album/newComment&id=".$model->id."',
                                data: $(this).serialize(),
                                success:function(){
                                    //alert('您的评论已经提交');
                                    $.fn.yiiGridView.update('album-comment-grid');
                                    document.getElementBy('comment-form').reset();
                                }
                            });
                            return false;
                    });
                ");
		$commentDataProvider=new CActiveDataProvider('Comment', array(
		    'criteria'=>array(
		        'condition'=>'type_id='.Comment::ALBUM_TYPE.' AND item_id='.$model->id,
		        'order'=>'create_time DESC',
		        'with'=>array('user'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'album-comment-grid',
                        'dataProvider'=>$commentDataProvider,
                        'columns'=>array(
                            'comment_body',          // display the 'title' attribute
                            'create_time',  // display the 'name' attribute of the 'category' relation
                            'ip',

                        ),
		));
		 ?>
	<?php endif; ?>

	<h3>Leave a Comment</h3>

	<?php if(Yii::app()->user->hasFlash('commentSubmitted')): ?>
		<div class="flash-success">
			<?php echo Yii::app()->user->getFlash('commentSubmitted'); ?>
		</div>
	<?php else: ?>
		<?php $this->renderPartial('/comment/_form',array(
			'model'=>$comment,
		)); ?>
	<?php endif; ?>

</div><!-- comments -->