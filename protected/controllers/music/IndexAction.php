<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Music',array('criteria'=>array('limit'=>100),'pagination'=>array('pageSize'=>25)));
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}
