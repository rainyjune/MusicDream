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

<table border="1">
  <tr>
    <td>
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,124,0" width="600" height="400" id="cmp">
                <param name="movie" value="cmp4b100603/cmp.swf?lists=<?php echo $playerVars;?>" />
                <param name="quality" value="high" />
                <param name="allowFullScreen" value="true" />
                <param name="allowScriptAccess" value="always" />
                <param name="wmode" value="opaque" />
                <embed pluginspage="http://www.adobe.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash" wmode="opaque" type="application/x-shockwave-flash" width="600" height="400" name="cmp" src="cmp4b100603/cmp.swf?lists=<?php echo $playerVars;?>" quality="high"  allowfullscreen="true" allowscriptaccess="always" ></embed>
                </object> &nbsp;</td>
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