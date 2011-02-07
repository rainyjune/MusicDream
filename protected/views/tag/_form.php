<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tag-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">字段 <span class="required">*</span> 是必需的。</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->