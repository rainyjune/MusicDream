<?php
/**
 * This is the model class for table "user".
 */
class User extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'user':
	 * @var integer $id
	 * @var string $username
	 * @var string $password
	 * @var string $email
	 * @var string $created_time
	 * @var string $lastlogin_time
	 */
	
	public $password_repeat;
	public $verifyCode;

	/**
	 * Returns the static model of the specified AR class.
	 * @return User the static model class
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
		return 'user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('username, password, email', 'required'),
			array('username', 'length', 'max'=>30),
			array('username','unique'),
			array('email','unique'),
			array('password', 'length', 'max'=>40),
			array('email', 'length', 'max'=>100),
			array('email','email'),
			array('verifyCode','captcha','allowEmpty'=>!extension_loaded('gd'),'on'=>'register'),
			array('password_repeat','required','on'=>'register'),
			array('password','compare','compareAttribute'=>'password_repeat','on'=>'register'),
//			array('lastlogin_time', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, password, email, created_time, lastlogin_time', 'safe', 'on'=>'search'),
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
			'albums' => array(self::HAS_MANY, 'Album', 'add_uid','condition'=>'albums.proved='.Album::STATUS_PROVED,'order'=>'albums.pub_time DESC'),
			'artists' => array(self::HAS_MANY, 'Artist', 'add_uid','condition'=>'artists.proved='.Artist::STATUS_PROVED,'order'=>'artists.add_time'),
			'musics' => array(self::HAS_MANY, 'Music', 'add_uid','condition'=>'musics.proved='.Music::STATUS_PROVED,'order'=>'musics.add_time'),
			'albumsCount'=>array(self::STAT,'Album','add_uid','condition'=>'albums.proved='.Album::STATUS_PROVED),
			'artistsCount'=>array(self::STAT,'Artist','add_uid','condition'=>'artists.proved='.Artist::STATUS_PROVED),
			'musicsCount'=>array(self::STAT,'Music','add_uid','condition'=>'musics.proved='.Music::STATUS_PROVED),
			'playLists'=>array(self::HAS_MANY,'Playlist','uid','order'=>'playLists.add_time DESC'),
                        'profile'=>array(self::HAS_ONE,'UserProfile','id'),
			'comments'=>array(self::HAS_MANY,'Comment','uid'),
		);
	}
	
	public function getUrl()
	{
		return Yii::app()->createUrl('user/view',array('id'=>$this->id,'username'=>$this->username));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => '用户名',
			'password' => '密码',
			'email' => 'Email',
			'created_time' => '创建日期',
			'lastlogin_time' => '最新登陆日期',
			'password_repeat'=>'再次输入密码',
			'verifyCode'=>'验证码'
		);
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

		$criteria->compare('username',$this->username,true);

		$criteria->compare('password',$this->password,true);

		$criteria->compare('email',$this->email,true);

		$criteria->compare('created_time',$this->created_time,true);

		$criteria->compare('lastlogin_time',$this->lastlogin_time,true);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
	
	public function validatePassword($password)
	{
		return md5($password)===$this->password;
	}
	
	protected function beforeSave()
	{
		if (parent::beforeSave())
		{
			if ($this->isNewRecord)
			{
				$this->created_time=time();
				$this->password=md5($this->password);
			}
			return true;
			
		}
		else 
		{
			return false;
		}
			
	}
}