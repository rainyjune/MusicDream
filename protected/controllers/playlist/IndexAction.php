<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Playlist',array(
            'criteria'=>array(
                'condition'=>'uid=:uid',
                'params'=>array(':uid'=>Yii::app()->user->id),
                'with'=>array('playlistMusics','playlistMusics.music'),)));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}