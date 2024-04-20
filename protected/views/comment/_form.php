<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>true,
)); ?>

    <p class="note">标识 <span class="required">*</span> 的字段必填。</p>
<?php 
if(Yii::app()->user->isGuest){
?>
    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',array('size'=>30,'maxlength'=>128)); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>
<?php }?>

    <div class="row">
        <?php echo $form->labelEx($model,'comment_body'); ?>
        <?php $this->widget('ext.cleditor.ECLEditor',array('model'=>$model,'attribute'=>'comment_body','htmlOptions'=>array('rows'=>6, 'cols'=>50)))?>
        <?php echo $form->error($model,'comment_body'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton($model->isNewRecord ? 'Submit' : 'Save'); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->