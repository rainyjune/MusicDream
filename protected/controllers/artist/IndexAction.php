<?php
class IndexAction extends XRenderAction
{
    public function run()
    {
        $criteria=new CDbCriteria();
        $criteria->condition='proved=:proved';
        $criteria->params=array(':proved'=>Artist::STATUS_PROVED);
        $criteria->order="sort ASC,add_time DESC";
        $criteria->group='sort,id';
        $region=1;
        $type=2;
        if(isset($_GET['region']))
            $region=(int)$_GET['region'];
        $criteria->addSearchCondition('area_id',$region);
        if(isset($_GET['type']))
            $type=(int)$_GET['type'];
        $criteria->addSearchCondition('type_id',$type);
        $rawData=Artist::model()->findAll($criteria);
        $dataProvider=new CArrayDataProvider($rawData,
                        array('id'=>'artist',
                              'pagination'=>array('pageSize'=>500,),
        ));
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'region'=>$region,
                'type'=>$type,
        ));
    }
}