<?php
class IndexAction extends XRenderAction
{
    public function run($region=1,$type=2)
    {
        $criteria=new CDbCriteria();
        $criteria->condition='proved=:proved';
        $criteria->params=array(':proved'=>Artist::STATUS_PROVED);
        $criteria->order="sort ASC,add_time DESC";
        $criteria->group='sort,id';
        $region=(int)$region;
        $type=(int)$type;
        $criteria->addSearchCondition('area_id',$region);
        $criteria->addSearchCondition('type_id',$type);
        $rawData=Artist::model()->findAll($criteria);
        $value = is_null(Yii::app()->cache) ? false : Yii::app()->cache->get('ARTISTS_'.$region.'_'.$type);
        if ($value === false) {
            $dataProvider=new CArrayDataProvider($rawData,
                        array('id'=>'artist',
                              'pagination'=>array('pageSize'=>500,),
            ));
            if (is_null(Yii::app()->cache) === false) {
                Yii::app()->cache->set('ARTISTS_'.$region.'_'.$type,$dataProvider,10);
            }
        }
        else
        {
            $dataProvider=$value;
        }
        $regionData=ArtistArea::model()->findByPk($region);
        $typeData=ArtistType::model()->findByPk($type);
        $this->render('index',array(
                'dataProvider'=>$dataProvider,
                'region'=>$region,
                'type'=>$type,
                'regionData'=>$regionData,
                'typeData'=>$typeData,
        ));
    }
}
