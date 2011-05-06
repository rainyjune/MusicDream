<?php
class NewReleaseAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Album',array(
			'criteria'=>array(
				'condition'=>'t.proved='.Album::STATUS_PROVED,
				'order'=>'pub_time DESC',
				'with'=>array('musics','artist'),
				'limit'=>100,
			),
			'pagination'=>array(
				'pageSize'=>10
			)));
        $this->render('newRelease',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}
