<div class="view">
    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->name), array('music/view', 'id'=>$data->id)); ?>

    <b><?php echo CHtml::encode($data->getAttributeLabel('album_id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->album->name), array('album/view', 'id'=>$data->album_id)); ?>
    <br />

</div>