<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Album',array('criteria'=>array('with'=>array('addUser','artist'))));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}
