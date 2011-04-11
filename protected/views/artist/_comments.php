<?php foreach($comments as $comment): ?>
<div class="comment" id="c<?php echo $comment->id; ?>">

	<?php 
	/*
	echo CHtml::link("#{$comment->id}", $comment->getUrl($post), array(
		'class'=>'cid',
		'title'=>'Permalink to this comment',
	));
	*/
	 ?>

	<div class="author">
		<?php 
		if($comment->uid){
			echo $comment->user->username;
		}
		else
		{
			echo $comment->username;
		}
		//echo $comment->authorLink; ?> says:
	</div>

	<div class="time">
		<?php echo $comment->create_time; ?>
	</div>

	<div class="content">
		<?php echo nl2br(CHtml::encode($comment->comment_body)); ?>
	</div>
	
	<div class="time">
	<?php echo CHtml::link(
					'delete','#',
					array('submit'=>array('/comment/delete','id'=>$comment->id,'src'=>urlencode(Yii::app()->request->getQuery('r')),'srcid'=>urlencode(Yii::app()->request->getQuery('id'))),'confirm'=>'Are you sure you want to delete this item?')
					
				);
					//'linkOptions' => array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')); 
	?>
	</div>

</div><!-- comment -->
<?php endforeach; ?>