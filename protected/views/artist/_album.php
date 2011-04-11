<div class="view">
    <?php echo CHtml::image(CHtml::encode($data->picture), CHtml::encode($data->name),array('height'=>'75','width'=>'75')); ?>
    <?php echo CHtml::link(CHtml::encode($data->name), array('album/view','id'=>$data->id)); ?>
    <br />
</div>