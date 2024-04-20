<?php
$this->breadcrumbs=array(
	'音乐'=>array('index'),
);

$this->menu=array(
	array('label'=>'列出音乐', 'url'=>array('index')),
	array('label'=>'添加音乐', 'url'=>array('create')),
	array('label'=>'管理音乐', 'url'=>array('admin')),
);
?>
<?php 
$siteUrl='http://'.$_SERVER['HTTP_HOST'].Yii::app()->urlManager->baseUrl;
$playerVars = rawurlencode("{$siteUrl}?r=music/play&id=".$ids);
?>
<script src='https://cdn.jsdelivr.net/npm/yuanplayer-core@latest/lib/umd/YuanPlayer.min.js'></script>
<script src='https://cdn.jsdelivr.net/npm/yuanplayer-theme-bluemonday@latest/lib/umd/YuanPlayerThemeBlueMonday.min.js'></script>
<table border="1">
  <tr>
    <td><div id="playerContainer1"></div></td>
  </tr>
</table>

<?php
if(isset($model)){
    Yii::app()->clientScript->registerScript('comment-music', "
        $('form').submit(function(){
            //return false;
            //alert($(this).serialize());return false;
                $.ajax({
                    type: 'POST',
                    url: 'index.php?r=music/newComment&id=".$model->id."',
                    data: $(this).serialize(),
                    success:function(){
                        //alert('您的评论已经提交');
                        $.fn.yiiGridView.update('music-comment-grid');
                        document.getElementBy('comment-form').reset();
                    }
                });
                return false;
        });
    ");
?>
<div id="comments">
	<?php if($model->commentCount>=1): ?>
		<h3>
			<?php echo $model->commentCount>1 ? $model->commentCount . ' comments' : 'One comment'; ?>
		</h3>

		<?php
		$commentDataProvider=new CActiveDataProvider('Comment', array(
		    'criteria'=>array(
		        'condition'=>'type_id='.Comment::MUSIC_TYPE.' AND item_id='.$model->id,
		        'order'=>'create_time DESC',
		        'with'=>array('user'),
		    ),
		    'pagination'=>array(
		        'pageSize'=>10,
		    ),
		));
		$this->widget('zii.widgets.grid.CGridView', array(
			'id'=>'music-comment-grid',
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
<?php
}
?>

<script>
const BMPlayer = YuanPlayer.use(YuanPlayerThemeBlueMonday);
const bmplayer = new BMPlayer({
  media: <?php echo json_encode($playlist); ?>,
  container: document.querySelector('#playerContainer1')
});
</script>