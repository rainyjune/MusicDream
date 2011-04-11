<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'music-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu_id'); ?>
		<?php echo $form->textField($model,'menu_id'); ?>
		<?php echo $form->error($model,'menu_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'album_id'); ?>
		<?php echo $form->textField($model,'album_id'); ?>
		<?php echo $form->error($model,'album_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'artist_id'); ?>
		<?php echo $form->textField($model,'artist_id'); ?>
		<?php echo $form->error($model,'artist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_uid'); ?>
		<?php echo $form->textField($model,'add_uid'); ?>
		<?php echo $form->error($model,'add_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo $form->error($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'click'); ?>
		<?php echo $form->textField($model,'click'); ?>
		<?php echo $form->error($model,'click'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time'); ?>
		<?php echo $form->error($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lyric'); ?>
		<?php echo $form->textArea($model,'lyric',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'lyric'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recommend'); ?>
		<?php echo $form->textField($model,'recommend',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'recommend'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'top'); ?>
		<?php echo $form->textField($model,'top',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'top'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'proved'); ?>
		<?php echo $form->textField($model,'proved',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'proved'); ?>
	</div>

<!--	<div class="row">
		<?php //echo $form->labelEx($model,'tag'); ?>
		<?php //echo $form->textArea($model,'tag',array('rows'=>6, 'cols'=>50)); ?>
		<?php //echo $form->error($model,'tag'); ?>
	</div>-->

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->