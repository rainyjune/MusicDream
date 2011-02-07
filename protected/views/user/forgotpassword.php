<?php
$this->breadcrumbs=array(
	'用户'=>array('index'),
	'忘记密码',
);
$this->layout="column2";
//$this->menu=array(
//	array('label'=>'列出用户', 'url'=>array('index')),
//	array('label'=>'管理用户', 'url'=>array('admin')),
//);
?>

<h1>找回密码</h1>

<div class="form">
    <?php if(Yii::app()->user->hasFlash('forgotpassword')): ?>
            <div class="flash-success">
                    <?php echo Yii::app()->user->getFlash('forgotpassword'); ?>
            </div>
    <?php else: ?>
    
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'user-forgotpassword-form',
            'enableAjaxValidation'=>false,
    )); ?>

            <p class="note">字段 <span class="required">*</span> 是必需的。</p>

            <?php echo $form->errorSummary($model); ?>

            <div class="row">
                    <?php echo $form->labelEx($model,'email'); ?>
                    <?php
                    $htmlOptions=array('size'=>30,'maxlength'=>30);
                    echo $form->textField($model,'email',$htmlOptions); ?>
                    <?php echo $form->error($model,'email'); ?>
            </div>

            <div class="row buttons">
                    <?php echo CHtml::submitButton('提交'); ?>
            </div>

    <?php $this->endWidget(); ?>
    <?php endif; ?>
</div><!-- form -->