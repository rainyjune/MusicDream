<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('Music');
        $this->render('index',array(
            'dataProvider'=>$dataProvider,
        ));
    }
}