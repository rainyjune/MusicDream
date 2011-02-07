<?php
class DynamicalbumsAction extends XRenderAction
{
    public function run()
    {
        $st='Music[artist_id]';
        echo "<option>".$_GET[$st]."</option>";exit;
        $data=Album::model()->findAll('artist_id=:artist_id',array(':artist_id'=>(int)$_GET['Music[artist_id]']));
        $data=CHtml::listData($data,'id','name');
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',array('value'=>$value),CHtml::encode($name),true);
        }
    }
}