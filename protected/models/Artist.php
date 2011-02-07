<?php

/**
 * This is the model class for table "artist".
 */
class Artist extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'artist':
     * @var integer $id
     * @var integer $type_id
     * @var integer $area_id
     * @var integer $menu_id
     * @var string $sort
     * @var string $name
     * @var string $picture
     * @var string $birthday
     * @var string $native_place
     * @var integer $click
     * @var string $intro
     * @var integer $add_uid
     * @var string $add_time
     * @var string $proved
     */
    
    public $_tags="";
    private $_oldTags="";
    public $image;
    private static $_items=array();
    const STATUS_PROVED=1;
    const STATUS_PENDING=0;

    public $proved=self::STATUS_PENDING;
    /**
     * Returns the static model of the specified AR class.
     * @return Artist the static model class
     */
    public static function model($className=__CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'artist';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('sort, name, type_id, area_id, menu_id, proved', 'required'),
            array('type_id, area_id, menu_id', 'numerical', 'integerOnly'=>true),
            array('sort', 'length', 'max'=>8),
            array('name, birthday, native_place', 'length', 'max'=>255),
            array('proved', 'in', 'range'=>array(0,1)),
            //array('picture','url','on'=>'create'),
            array('picture,intro,_tags', 'safe'),
            //array('_tags','normalizeTags','on'=>'create,update'),
            array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
            array('type_id,area_id,menu_id,name,proved','safe','on'=>'search'),
        );
    }
	

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
                'albums' => array(self::HAS_MANY, 'Album', 'artist_id','condition'=>'albums.proved='.Album::STATUS_PROVED,'order'=>'albums.pub_time DESC'),
                'type' => array(self::BELONGS_TO, 'ArtistType', 'type_id'),
                'area' => array(self::BELONGS_TO, 'ArtistArea', 'area_id'),
                'addUser' => array(self::BELONGS_TO, 'User', 'add_uid'),
                'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
                'musics' => array(self::HAS_MANY, 'Music', 'artist_id','condition'=>'musics.proved='.Music::STATUS_PROVED,'order'=>'musics.add_time'),
                'comments'=>array(self::HAS_MANY,'Comment','item_id','condition'=>'comments.type_id='.Comment::ARTIST_TYPE,'order'=>'comments.create_time DESC'),
                'commentCount' => array(self::STAT, 'Comment', 'item_id', 'condition'=>'type_id='.Comment::ARTIST_TYPE),
                //'tags'=>array(self::MANY_MANY,'ItemsTags','items_tags(item_id,tag_id)','condition'=>'items_tags.item_type='.ItemsTags::ARTIST_TYPE)
        );
    }
    /**
    * Adds a new comment to this post.
    * This method will set status and post_id of the comment accordingly.
    * @param Comment the comment to be added
    * @return boolean whether the comment is saved successfully
    */
    public function addComment($comment)
    {
        $comment->item_id=$this->id;
        $comment->type_id=Comment::ARTIST_TYPE;
        return $comment->save();
    }
	
    //SEO 需要
    public function getUrl()
    {
        return Yii::app()->createUrl('artist/view', array(
            'id'=>$this->id,
            'artist'=>$this->name,
        ));
    }
    public function attributeLabels()
    {
        return array(
                'id' => 'ID',
                'type_id' => '类型',
                'area_id' => '地区',
                'menu_id' => '栏目',
                'sort' => '排序',
                'name' => '名字',
                'picture' => '图像',
                'birthday' => '生日',
                'native_place' => '出生地',
                'click' => '点击',
                'intro' => '简介',
                'add_uid' => '添加者ID',
                'add_time' => '添加时间',
                'proved' => '是否发布',
                //'tag' => '标签',
                'image'=>'上传图像',
                '_tags'=>'标签'
        );
    }
	
    //得到所有艺术家
    public static function getAll()
    {
        self::$_items=array();
        $models=self::model()->findAll();
        foreach($models as $model)
            self::$_items[$model->id]=$model->name;
        return self::$_items;
    }
	
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if($this->isNewRecord)
            {
                $this->click=0;
                $this->add_uid=Yii::app()->user->id;
                $this->add_time=time();
                if($this->picture=="")
                {
                    if($this->image)
                    {
                        $name=$this->image->name;
                        $this->picture=$name;
                    }
                }
            }
            //更新记录保存之前
            else
            {
                if($this->image)
                {
                    $name=$this->image->name;
                    $this->picture=$name;
                }
            }
            return true;
        }
        else
            return false;
    }
	
    protected function afterSave()
    {
        parent::afterSave();
        if(is_object($this->image))
        {
            if($this->picture==$this->image->name)
            {
                $this->image->saveAs('protected/data/'.$this->picture);
            }
        }
        ItemsTags::model()->updateTags(ItemsTags::ARTIST_TYPE,$this->id,$this->_oldTags, $this->_tags);
    }
	
	
    protected function afterFind()
    {
        parent::afterFind();
        $this->_tags=$this->_oldTags=ItemsTags::returnTagsString(ItemsTags::ARTIST_TYPE,$this->id);
        Artist::model()->updateCounters(array('click'=>1), 'id=:id', array(':id'=>  $this->id));
    }
    protected function afterDelete()
    {
        parent::afterDelete();
        ItemsTags::model()->deleteAll('item_type='.ItemsTags::ARTIST_TYPE.' and item_id='.(int)$this->id);
    }
	
    public static function getArtistNavData()
    {
        $data=array();
        $artistAreas=ArtistArea::model()->findAll();
        $c=count($artistAreas);
        for($i=0;$i<$c;$i++)
        {
            $data[$i]['text']=$artistAreas[$i]->name;
            $data[$i]['expanded']=true;
            $data[$i]['hasChildren']=true;
            $data[$i]['children']=array(
                        array('text'=>CHtml::link('女歌手',array('artist/index','region'=>$artistAreas[$i]->id,'type'=>2))),
                        array('text'=>CHtml::link('男歌手',array('artist/index','region'=>$artistAreas[$i]->id,'type'=>1))),
                        array('text'=>CHtml::link('乐队组合',array('artist/index','region'=>$artistAreas[$i]->id,'type'=>3)))
                                );
        }
        return $data;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        $criteria=new CDbCriteria;
        //$criteria->compare('id',$this->id);
        $criteria->compare('proved',$this->proved);
        $criteria->compare('name',$this->name,true);
        $criteria->compare('type_id',$this->type_id);
        $criteria->compare('area_id',$this->area_id);
        $criteria->compare('menu_id',$this->menu_id);
        return new CActiveDataProvider(get_class($this), array(
                'criteria'=>$criteria,
                'sort'=>array(
                                'defaultOrder'=>'add_time DESC'
                        )
        ));
    }
    public function scopes()
    {
        return array(
            'published'=>array(
                'condition'=>'proved=:proved',
                'params'=>array(':proved'=>Artist::STATUS_PROVED),
            )
        );
    }
    public function recently($limit=10)
    {
        $this->getDbCriteria()->mergeWith(array('order'=>'add_time DESC','limit'=>$limit));
        return $this;
    }
}