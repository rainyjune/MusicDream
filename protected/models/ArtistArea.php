<?php

/**
 * This is the model class for table "artist_area".
 */
class ArtistArea extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'artist_area':
	 * @var integer $id
	 * @var string $name
	 * @var string $intro
	 */

	private static $_items=array();
	private static $_itemsLookup;
	
	/**
	 * Returns the static model of the specified AR class.
	 * @return ArtistArea the static model class
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
		return 'artist_area';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name', 'required'),
			array('name', 'length', 'max'=>255),
			array('intro', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, intro', 'safe', 'on'=>'search'),
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
			'artists' => array(self::HAS_MANY, 'Artist', 'area_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => '地区',
			'intro' => '简介',
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

		$criteria->compare('name',$this->name,true);

		$criteria->compare('intro',$this->intro,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	
	public static function items()
	{
		if(!isset(self::$_itemsLookup))
			self::loadItems();
		return self::$_itemsLookup;
	}

	/**
	 * Returns the item name for the specified type and code.
	 * @param string the item type (e.g. 'PostStatus').
	 * @param integer the item code (corresponding to the 'code' column value)
	 * @return string the item name for the specified the code. False is returned if the item type or code does not exist.
	 */
	public static function item($id)
	{
		if(!isset(self::$_itemsLookup))
			self::loadItems();
		return isset(self::$_itemsLookup[$id]) ? self::$_itemsLookup[$id] : false;
	}

	/**
	 * Loads the lookup items for the specified type from the database.
	 * @param string the item type
	 */
	private static function loadItems()
	{
		self::$_itemsLookup=array();
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_itemsLookup[$model->id]=$model->name;
	}
}