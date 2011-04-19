<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
	</div>


	<div class="row">
		<?php echo $form->label($model,'album_id'); ?>
		<?php echo $form->textField($model,'album_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'artist_id'); ?>
		<?php echo $form->textField($model,'artist_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_uid'); ?>
		<?php echo $form->textField($model,'add_uid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'order'); ?>
		<?php echo $form->textField($model,'order'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'click'); ?>
		<?php echo $form->textField($model,'click'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'add_time'); ?>
		<?php echo $form->textField($model,'add_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'lyric'); ?>
		<?php echo $form->textArea($model,'lyric',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'url'); ?>
		<?php echo $form->textArea($model,'url',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'recommend'); ?>
		<?php echo $form->textField($model,'recommend',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'top'); ?>
		<?php echo $form->textField($model,'top',array('size'=>1,'maxlength'=>1)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'proved'); ?>
		<?php echo $form->textField($model,'proved',array('size'=>1,'maxlength'=>1)); ?>
	</div>
<!--
	<div class="row">
		<?php //echo $form->label($model,'tag'); ?>
		<?php //echo $form->textArea($model,'tag',array('rows'=>6, 'cols'=>50)); ?>
	</div>
-->
	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->
