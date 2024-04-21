<?php

/**
 * This is the model class for table "playlist".
 */
class Playlist extends CActiveRecord
{
    /**
     * The followings are the available columns in table 'playlist':
     * @var integer $id
     * @var string $name
     * @var string $intro
     * @var integer $uid
     * @var integer $add_time
     */

    private static $_items = array();

    /**
     * Returns the static model of the specified AR class.
     * @return Playlist the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return 'playlist';
    }

    public static function getAll()
    {
        self::$_items = array();
        $models = self::model()->findAll();
        foreach ($models as $model)
            self::$_items[$model->id] = $model->name;
        return self::$_items;
    }

    public static function getAllofCurrentUser()
    {
        self::$_items = array();
        $models = self::model()->findAll('uid=' . Yii::app()->user->id);
        foreach ($models as $model)
            self::$_items[$model->id] = $model->name;
        return self::$_items;
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
            //array('uid, add_time', 'numerical', 'integerOnly'=>true),
            array('name', 'length', 'max' => 30),
            array('intro', 'safe'),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('id, name', 'safe', 'on' => 'search'),
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
            'user' => array(self::BELONGS_TO, 'User', 'uid'),
            'playlistMusics' => array(self::HAS_MANY, 'PlaylistMusic', 'playlist_id'),
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
            'intro' => '简介',
            'uid' => 'Uid',
            'add_time' => '添加时间',
        );
    }

    protected function beforeSave()
    {
        if (parent::beforeSave()) {
            if ($this->isNewRecord) {
                $this->uid = Yii::app()->user->id;
                $this->add_time = time();
            }
            return true;
        } else
            return false;
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
     */
    public function search()
    {
        // Warning: Please modify the following code to remove attributes that
        // should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);

        $criteria->compare('name', $this->name, true);

        // Authenticate users can only see their own playlists
        if (Yii::app()->user->name !== "admin") {
            $criteria->compare('uid', Yii::app()->user->id);
        }

        //$criteria->compare('intro',$this->intro,true);
        //$criteria->compare('uid',$this->uid);
        //$criteria->compare('add_time',$this->add_time);

        return new CActiveDataProvider(get_class($this), array(
            'criteria' => $criteria,
        ));
    }
}