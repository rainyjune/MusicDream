<?php
$this->breadcrumbs=array(
	'艺术家'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'更新艺术家资料', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'添加艺术家专辑', 'url'=>array('album/create', 'artist_id'=>$model->id)),
	array('label'=>'添加艺术家单曲', 'url'=>array('music/create', 'artist_id'=>$model->id)),
	array('label'=>'列出艺术家', 'url'=>array('index')),
	array('label'=>'添加艺术家', 'url'=>array('create')),
	array('label'=>'删除艺术家', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'管理艺术家', 'url'=>array('admin')),
);
?>

<table border="1">
  <tr>
    <td rowspan="5"><?php echo CHtml::image($model->picture,CHtml::encode($model->name),array('height'=>'115px','width'=>'96px'));?>&nbsp;</td>
    <td colspan="2"><b><?php echo CHtml::encode($model->name);?></b>&nbsp;</td>
  </tr>
  <tr>
    <td>生日</td>
    <td><?php echo CHtml::encode($model->birthday);?>&nbsp;</td>
  </tr>
  <tr>
    <td>出生地</td>
    <td><?php echo CHtml::encode($model->native_place);?>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><?php echo $model->intro;?>&nbsp;</td>
  </tr>
  <tr>
    <td>标签&nbsp;</td>
    <td><?php 
	$rows=ItemsTags::returnTags(ItemsTags::ARTIST_TYPE,$model->id);	
	foreach($rows as $row)
        {
            echo CHtml::link(CHtml::encode($row['name']),array('tag/view','id'=>$row['id']),array('target'=>'_blank'))."&nbsp;";
        }
	?>&nbsp;
    </td>
  </tr>
</table>
<h2>热门歌曲</h2>
<?php
$dataProvider=new CActiveDataProvider('Music', array(
    'criteria'=>array(
        'condition'=>'t.proved='.Music::STATUS_PROVED.' AND t.artist_id='.$model->id,
        //'order'=>'create_time DESC',
        'with'=>array('album'),
    ),
    'pagination'=>array(
        'pageSize'=>8,
    ),
));

$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_music',
    'summaryText'=>'',
));
?>
<h2>所有专辑</h2>
<?php
$criteria=new CDbCriteria(array('condition'=>'proved='.Album::STATUS_PROVED.' AND artist_id='.$model->id,));
$dataProvider=new CActiveDataProvider('Album', array('criteria'=>$criteria,));
$this->widget('zii.widgets.CListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_album',
    'summaryText'=>'',
));
?>
<div id="comments">
<?php if($model->commentCount>=1): ?>
        <h3>
                <?php echo $model->commentCount; ?> 条评论
        </h3>

        <?php
            Yii::app()->clientScript->registerScript('comment-artist', "
                    $('form').submit(function(){
                        //return false;
                        //alert($(this).serialize());return false;
                            $.ajax({
                                type: 'POST',
                                url: 'index.php?r=artist/newComment&id=".$model->id."',
                                data: $(this).serialize(),
                                success:function(){
                                    //alert('您的评论已经提交');
                                    $.fn.yiiGridView.update('artist-comment-grid');
                                    document.getElementBy('comment-form').reset();
                                }
                            });
                            return false;
                    });
            ");
        $commentDataProvider=new CActiveDataProvider('Comment', array(
            'criteria'=>array(
                'condition'=>'type_id='.Comment::ARTIST_TYPE.' AND item_id='.$model->id,
                'order'=>'create_time DESC',
                'with'=>array('user'),
            ),
            'pagination'=>array(
                'pageSize'=>10,
            ),
        ));
        $this->widget('zii.widgets.grid.CGridView', array(
                'id'=>'artist-comment-grid',
                'dataProvider'=>$commentDataProvider,
                'columns'=>array(
                    'comment_body',          // display the 'title' attribute
                    'create_time',  // display the 'name' attribute of the 'category' relation
                    'ip',

                ),
        ));

        ?>
<?php endif; ?>

    <h3>留言</h3>

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