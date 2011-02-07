<?php

/**
 * This is the model class for table "comment".
 *
 * The followings are the available columns in table 'comment':
 * @property string $id
 * @property integer $type_id
 * @property integer $item_id
 * @property integer $uid
 * @property string $username
 * @property string $comment_body
 * @property string $create_time
 * @property string $ip
 *
 * The followings are the available model relations:
 */
class Comment extends CActiveRecord
{
	const ARTIST_TYPE=1;
	const ALBUM_TYPE=2;
	const MUSIC_TYPE=3;
	/**
	 * Returns the static model of the specified AR class.
	 * @return Comment the static model class
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
		return 'comment';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('comment_body', 'required'),
			//array('type_id, item_id, uid', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>100),
			//array('ip', 'length', 'max'=>20),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, type_id, item_id, uid, username, comment_body, create_time, ip', 'safe', 'on'=>'search'),
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
			'artist' => array(self::BELONGS_TO, 'Artist', 'item_id','condition'=>'artist.type_id='.self::ARTIST_TYPE,'order'=>'artist.create_time DESC'),
			'album' => array(self::BELONGS_TO, 'Album', 'item_id','condition'=>'album.type_id='.self::ALBUM_TYPE,'order'=>'album.create_time DESC'),
			'music' => array(self::BELONGS_TO, 'Music', 'item_id','condition'=>'music.type_id='.self::MUSIC_TYPE,'order'=>'music.create_time DESC'),
			'user' => array(self::BELONGS_TO, 'User', 'uid'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'type_id' => 'Type',
			'item_id' => 'Item',
			'uid' => 'Uid',
			'username' => '用户名',
			'comment_body' => '内容',
			'create_time' => '发表时间',
			'ip' => 'IP地址',
		);
	}
	
	protected function beforeSave()
	{
		if(parent::beforeSave())
	    {
	        if($this->isNewRecord)
	        {
	            $this->create_time=date('Y-m-d H:i:s');
	            $this->ip=$_SERVER['REMOTE_ADDR'];
	            if(Yii::app()->user->id){
	            	$this->uid=Yii::app()->user->id;
	            	$this->username='';
	            }
	        }
	        else
	            $this->update_time=time();
	        return true;
	    }
	    else
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

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id,true);
		$criteria->compare('type_id',$this->type_id);
		$criteria->compare('item_id',$this->item_id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('comment_body',$this->comment_body,true);
		$criteria->compare('create_time',$this->create_time,true);
		$criteria->compare('ip',$this->ip,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}