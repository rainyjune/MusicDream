<?php

/**
 * This is the model class for table "menu".
 */
class Menu extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'menu':
	 * @var integer $id
	 * @var string $menu_name
	 * @var string $description
	 * @var integer $sort
	 */

	private static $_items=array();
	private static $_itemsLookup;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Menu the static model class
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
		return 'menu';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('menu_name', 'required'),
			array('sort', 'numerical', 'integerOnly'=>true),
			array('menu_name', 'length', 'max'=>255),
			array('description', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, menu_name, description', 'safe', 'on'=>'search'),
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
			'albums' => array(self::HAS_MANY, 'Album', 'menu_id','condition'=>'albums.proved='.Album::STATUS_PROVED,'order'=>'albums.pub_time DESC'),
			'artists' => array(self::HAS_MANY, 'Artist', 'menu_id','condition'=>'artists.proved='.Artist::STATUS_PROVED,'order'=>'artists.add_time'),
			'musics' => array(self::HAS_MANY, 'Music', 'menu_id','condition'=>'musics.proved='.Music::STATUS_PROVED,'order'=>'musics.add_time'),
			'albumsCount'=>array(self::STAT,'Album','menu_id','condition'=>'albums.proved='.Album::STATUS_PROVED),
			'artistsCount'=>array(self::STAT,'Artist','menu_id','condition'=>'artists.proved='.Artist::STATUS_PROVED),
			'musicsCount'=>array(self::STAT,'Music','menu_id','condition'=>'musics.proved='.Music::STATUS_PROVED)
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'menu_name' => '栏目名字',
			'description' => '描述',
			'sort' => '排序',
		);
	}

	public static function getAll()
	{
		self::$_items=array();
		$models=self::model()->findAll();
		foreach($models as $model)
			self::$_items[$model->id]=$model->menu_name;
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

		$criteria->compare('menu_name',$this->menu_name,true);

		$criteria->compare('description',$this->description,true);

		//$criteria->compare('sort',$this->sort);

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
			self::$_itemsLookup[$model->id]=$model->menu_name;
	}
}