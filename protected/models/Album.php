<?php

/**
 * This is the model class for table "album".
 */
class Album extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'album':
	 * @var integer $id
	 * @var integer $menu_id
	 * @var integer $add_uid
	 * @var string $sort
	 * @var string $name
	 * @var integer $artist_id
	 * @var string $company
	 * @var string $language
	 * @var string $introduction
	 * @var string $picture
	 * @var string $pub_time
	 * @var string $top
	 * @var string $recommend
	 * @var integer $click
	 * @var string $add_time
	 * @var string $proved
	 */
	public $_tags="";
	private $_oldTags="";
	public $image;
	private static $_items=array();
	const STATUS_PROVED=1;
	const STATUS_PENDING=0;
	
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return Album the static model class
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
		return 'album';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_id,sort, name, artist_id,company, language, introduction, pub_time,top,recommend,proved', 'required'),
			array('menu_id, artist_id', 'numerical', 'integerOnly'=>true),
			array('sort', 'length', 'max'=>8),
			array('name, company', 'length', 'max'=>255),
			array('language', 'length', 'max'=>15),
			array('top, recommend, proved', 'in', 'range'=>array(0,1)),
			array('picture,_tags', 'safe'),
			array('image', 'file', 'types'=>'jpg, gif, png','allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			//array('id, menu_id, add_uid, sort, name, artist_id, company, language, introduction, picture, pub_time, top, recommend, click, add_time, proved, tag', 'safe', 'on'=>'search'),
			array('name,menu_id,proved','safe','on'=>'search')
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'menu' => array(self::BELONGS_TO, 'Menu', 'menu_id'),
			'addUser' => array(self::BELONGS_TO, 'User', 'add_uid'),
			'artist' => array(self::BELONGS_TO, 'Artist', 'artist_id'),
			'musics' => array(self::HAS_MANY, 'Music', 'album_id','condition'=>'musics.proved='.Music::STATUS_PROVED,'order'=>'musics.add_time'),
			'comments'=>array(self::HAS_MANY,'Comment','item_id','condition'=>'comments.type_id='.Comment::ALBUM_TYPE,'order'=>'comments.create_time DESC'),
			'commentCount' => array(self::STAT, 'Comment', 'item_id', 'condition'=>'type_id='.Comment::ALBUM_TYPE),
		
		);
	}
	public function addComment($comment)
	{
		$comment->item_id=$this->id;
		$comment->type_id=Comment::ALBUM_TYPE;
		return $comment->save();
	}

		//SEO 需要
	public function getUrl()
    {
        return Yii::app()->createUrl('album/view', array(
            'id'=>$this->id,
            'album'=>$this->name,
        ));
    }
	
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_id' => '栏目',
			'add_uid' => '添加者',
			'sort' => '排序',
			'name' => '名字',
			'artist_id' => '艺术家',
			'company' => '公司',
			'language' => '语言',
			'introduction' => '简介',
			'picture' => '封面',
			'pub_time' => '发布时间',
			'top' => '置顶',
			'recommend' => '推荐',
			'click' => '点击量',
			'add_time' => '添加时间',
			'proved' => '已验证',
			//'tag' => '标签',
			'image'=>'上传图像',
			'_tags'=>'标签'
		);
	}
	
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
		ItemsTags::model()->updateTags(ItemsTags::ALBUM_TYPE,$this->id,$this->_oldTags, $this->_tags);
	}
	
	protected function afterFind()
	{
		parent::afterFind();
		$this->_tags=$this->_oldTags=ItemsTags::returnTagsString(ItemsTags::ALBUM_TYPE,$this->id);
                Album::model()->updateCounters(array('click'=>1), 'id=:id', array(':id'=>  $this->id));
	}
	
	protected function afterDelete()
	{
		parent::afterDelete();
		ItemsTags::model()->deleteAll('item_type='.ItemsTags::ALBUM_TYPE.' and item_id='.(int)$this->id);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('name',$this->name,true);
		$criteria->compare('menu_id',$this->menu_id);
		$criteria->compare('proved',$this->proved);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}