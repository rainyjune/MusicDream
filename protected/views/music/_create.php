<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-form',
	'enableAjaxValidation'=>false,
	'htmlOptions'=>array('enctype'=>'multipart/form-data')
)); ?>

	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>


	<div class="row">
		<?php echo $form->labelEx($model,'artist_id'); ?>
		<?php 
			echo $form->dropDownList($model,'artist_id',Artist::getAll(),array('prompt'=>'请选择'));
			//echo $form->dropDownList($model,'artist_id',Artist::getAll(),array('ajax'=>array('type'=>'GET','url'=>Yii::app()->createUrl('album/dynamicalbums'),'update'=>'#Music_album_id','data'=>'js:jQuery(this).clone().appendTo(this);jQuery(this).parents("form").serialize()')));
			
		?>
		<?php echo $form->error($model,'artist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'album_id'); ?>
		<?php 
			$albums=Album::getAll();
			echo $form->dropDownList($model,'album_id',$albums,array('prompt'=>'单曲'));
			//echo $form->dropDownList($model,'album_id',array('请选择'));
		?>
		<?php echo $form->error($model,'album_id'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lyric'); ?>
		<?php echo $form->textArea($model,'lyric',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lyric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php //echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); 
			echo $form->textField($model,'url',array('size'=>50,'maxlength'=>255));
		?>
		<?php echo $form->error($model,'url'); ?>
		<br />
		<?php echo $form->labelEx($model,'musicfile'); ?>
		<?php
			echo $form->fileField($model,'musicfile');
		?>
		<?php echo $form->error($model,'musicfile'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php //echo $form->textField($model,'recommend',array('size'=>1,'maxlength'=>1)); 
			$data=array('0'=>'否',1=>'是');
			echo $form->radioButtonList($model,'recommend',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'top'); ?>
		<?php //echo $form->textField($model,'top',array('size'=>1,'maxlength'=>1)); 
			echo $form->radioButtonList($model,'top',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'top'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proved'); ?>
		<?php //echo $form->textField($model,'proved',array('size'=>1,'maxlength'=>1)); 
			echo $form->radioButtonList($model,'proved',$data,array('separator'=>'','labelOptions'=>array('style'=>'display:inline')));
		?>
		<?php echo $form->error($model,'proved'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'_tags'); ?>
		<?php $this->widget('CAutoComplete', array(
			'model'=>$model,
			'attribute'=>'_tags',
			'url'=>array('artist/suggestTags'),
			'minChars'=>1, 
			'multiple'=>true,
			'htmlOptions'=>array('size'=>30,'maxlength'=>60),
		)); ?>
		<?php echo $form->error($model,'_tags'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
