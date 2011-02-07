<?php
if (Playlist::model()->find('uid='.Yii::app()->user->id))
{
?>
<h3>请选择要添加歌曲的播放列表</h3>
<p>立即移动这些歌曲到：</p>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'playlist-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php
echo '<pre>';
var_dump($_POST);
echo '</pre>';

    echo $form->dropDownList($model,'playlist_id',Playlist::getAllofCurrentUser());

?>
<input type="hidden" name="id" value="<?php echo $id;?>" />
	<div class="row buttons">
		<?php echo CHtml::submitButton('保存'); ?>
	</div>
	
<?php $this->endWidget(); ?>
</div>
<?php
}else{
    echo '你还没有播放列表，请先<a href="index.php?r=playlist/create">创建</a>。';
}
?>