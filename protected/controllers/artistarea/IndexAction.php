<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $dataProvider=new CActiveDataProvider('ArtistArea');
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
        ));
    }
}