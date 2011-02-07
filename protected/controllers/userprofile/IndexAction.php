<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('UserProfile');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}