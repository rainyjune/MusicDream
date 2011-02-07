<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Tag');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}