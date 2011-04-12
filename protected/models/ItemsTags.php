<?php

/**
 * This is the model class for table "items_tags".
 */
class ItemsTags extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'items_tags':
	 * @var integer $id
	 * @var integer $item_type
	 * @var integer $item_id
	 * @var integer $tag_id
	 */

	const ARTIST_TYPE=1;
	const ALBUM_TYPE=2;
	const MUSIC_TYPE=3;
	/**
	 * Returns the static model of the specified AR class.
	 * @return ItemsTags the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	public function primaryKey()
	{
		return array('item_type','tag_id');
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'items_tags';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('item_type, item_id, tag_id', 'required'),
			array('item_type, item_id, tag_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, item_type, item_id, tag_id', 'safe', 'on'=>'search'),
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
			'tag' => array(self::BELONGS_TO, 'Tags', 'tag_id'),
			'music'=>array(self::BELONGS_TO,'Music','item_id','condition'=>'item_type='.self::MUSIC_TYPE),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'item_type' => 'Item Type',
			'item_id' => 'Item',
			'tag_id' => 'Tag',
		);
	}
	
	public static function returnTags($type,$itemid)
	{
		$sql="select * from tags where id in(select tag_id from items_tags where item_type=$type and item_id=$itemid)";
		$command=Yii::app()->db->createCommand($sql);
		$rows=$command->queryAll();
		return $rows;
	}
	
	public static function returnTagsString($type,$itemid)
	{
		$str=self::returnTags($type,$itemid);
		$rstringArray=array();
		foreach($str as $tmp)
		{
			$rstringArray[]=$tmp['name'];
		}
		return implode(',',$rstringArray);
	}
	
	public function updateTags($itemtype,$itemid,$oldTags,$newTags)
	{
		$oldTags=self::string2array($oldTags);
		$newTags=self::string2array($newTags);
/*		echo '<pre>';
		var_dump(array_values(array_diff($oldTags,$newTags)));
//		var_dump($newTags);
		
		exit;*/
		$this->addTags(array_values(array_diff($newTags,$oldTags)),$itemtype,$itemid);
		$this->removeTags(array_values(array_diff($oldTags,$newTags)),$itemtype,$itemid);
	}
	public static function string2array($tags)
	{
		return preg_split('/\s*,\s*/',trim($tags),-1,PREG_SPLIT_NO_EMPTY);
	}
	
	public function addTags($tags,$itemtype,$itemid)
	{
		if(empty($tags))
			return;
		foreach($tags as $name)
		{
			$tag=NULL;
			//echo $name;
			$tag=Tag::model()->find("name='$name'");
			if(!$tag)
			{
				//未存在，添加
				$tag=new Tag;
				$tag->name=$name;
				$tag->save();
			}
			//var_dump($tag->id);
			//exit;
			$newItemTag=new ItemsTags();
			$newItemTag->item_type=$itemtype;
			$newItemTag->item_id=(int)$itemid;
			$newItemTag->tag_id=(int)$tag->id;
			$newItemTag->save();		
		}
	}

	public function removeTags($tags,$itemtype,$itemid)
	{
		if(empty($tags))
			return;
//		echo 'removetag';exit;
		foreach($tags as $name)
		{
			//$tag=Tag::model()->find(array("name"=>$name));
			//var_dump($tag->id);exit;
			$sql="select id from tags where name='".$name."'";
			$command=Yii::app()->db->createCommand($sql);
			$result=$command->queryAll();
			//var_dump($result[0]['id']);exit;
			$criteria=new CDbCriteria;
			$criteria->condition='item_type='.$itemtype.' and item_id='.(int)$itemid.' and tag_id='.(int)$result[0]['id'];
			self::model()->deleteAll($criteria);
		}

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

		$criteria->compare('id',$this->id);

		$criteria->compare('item_type',$this->item_type);

		$criteria->compare('item_id',$this->item_id);

		$criteria->compare('tag_id',$this->tag_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}
