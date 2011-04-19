<?php

/**
 * This is the model class for table "music".
 */
class Music extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'music':
	 * @var integer $id
	 * @var string $name
	 * @var integer $album_id
	 * @var integer $artist_id
	 * @var integer $add_uid
	 * @var integer $order
	 * @var integer $click
	 * @var string $add_time
	 * @var string $lyric
	 * @var string $url
	 * @var string $recommend
	 * @var string $top
	 * @var string $proved
	 */
	public $_tags="";
	private $_oldTags="";
	public $musicfile;
	const STATUS_PROVED=1;
	const STATUS_PENDING=0;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Music the static model class
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
		return 'music';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name,artist_id,order,recommend,top,proved', 'required'),
			array('artist_id, order', 'numerical', 'integerOnly'=>true),
			array('album_id','numerical','integerOnly'=>true,'allowEmpty'=>true),
			array('name', 'length', 'max'=>255),
			array('recommend, top, proved', 'in', 'range'=>array(0,1)),
			array('lyric, url,_tags', 'safe'),
			array('musicfile', 'file', 'types'=>'mp3,wma','maxSize'=>1024*1024*10,'allowEmpty'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('name,proved','safe','on'=>'search')
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
			'album' => array(self::BELONGS_TO, 'Album', 'album_id'),
			'addUser' => array(self::BELONGS_TO, 'User', 'add_uid'),
			'artist' => array(self::BELONGS_TO, 'Artist', 'artist_id'),
			'comments'=>array(self::HAS_MANY,'Comment','item_id','condition'=>'comments.type_id='.Comment::MUSIC_TYPE,'order'=>'comments.create_time DESC'),
			'tags'=>array(self::MANY_MANY,'ItemsTags','items_tags(item_id,tag_id)','condition'=>'item_type='.ItemsTags::MUSIC_TYPE),
			'commentCount' => array(self::STAT, 'Comment', 'item_id', 'condition'=>'type_id='.Comment::MUSIC_TYPE),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '名字',
			'album_id' => '专辑',
			'artist_id' => '艺术家ID',
			'add_uid' => '添加者ID',
			'order' => '顺序',
			'click' => '点击量',
			'add_time' => '添加时间',
			'lyric' => '歌词',
			'url' => '文件地址',
			'recommend' => '推荐',
			'top' => '置顶',
			'proved' => '发布',
			'_tags' => '标签',
			'musicfile'=>'上传文件'
		);
	}
	public function addComment($comment)
	{
		$comment->item_id=$this->id;
		$comment->type_id=Comment::MUSIC_TYPE;
		return $comment->save();
	}
	public function getUrls()
    {
        return Yii::app()->createUrl('music/view', array(
            'id'=>$this->id,
            'music'=>$this->name,
        ));
    }
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
		{
			if($this->album_id==0)
			{
				$this->album_id=null;
			}
			if($this->isNewRecord)
			{
				$this->click=0;
				$this->add_uid=Yii::app()->user->id;
				$this->add_time=time();
				if($this->url=="")
				{
					if($this->musicfile)
					{
						$name=$this->musicfile->name;
						$this->url=$name;
					}
				}
			}
			else
			{
				if($this->musicfile)
				{
					$name=$this->musicfile->name;
					$this->url=$name;
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
		if(is_object($this->musicfile))
		{
			if($this->url==$this->musicfile->name)
			{
				$this->musicfile->saveAs('protected/data/music/'.$this->url);
			}
		}
		ItemsTags::model()->updateTags(ItemsTags::MUSIC_TYPE,$this->id,$this->_oldTags, $this->_tags);
	}
	
	protected function afterFind()
	{
		parent::afterFind();
		$this->_tags=$this->_oldTags=ItemsTags::returnTagsString(ItemsTags::MUSIC_TYPE,$this->id);
                Music::model()->updateCounters(array('click'=>1), 'id=:id', array(':id'=>  $this->id));
	}
	
	protected function afterDelete()
	{
		parent::afterDelete();
		ItemsTags::model()->deleteAll('item_type='.ItemsTags::MUSIC_TYPE.' and item_id='.(int)$this->id);
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

		//$criteria->compare('id',$this->id);

		$criteria->compare('name',$this->name,true);


		//$criteria->compare('album_id',$this->album_id);

		//$criteria->compare('artist_id',$this->artist_id);

		//$criteria->compare('add_uid',$this->add_uid);

		//$criteria->compare('order',$this->order);

		//$criteria->compare('click',$this->click);

		//$criteria->compare('add_time',$this->add_time,true);

		//$criteria->compare('lyric',$this->lyric,true);

		//$criteria->compare('url',$this->url,true);

		//$criteria->compare('recommend',$this->recommend,true);

		//$criteria->compare('top',$this->top,true);

		$criteria->compare('proved',$this->proved,true);

		//$criteria->compare('tag',$this->tag,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
