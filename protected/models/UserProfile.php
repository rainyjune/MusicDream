<?php
/**
 * This is the model class for table "profile".
 *
 * The followings are the available columns in table 'profile':
 * @property string $id
 * @property string $blog
 * @property integer $qq
 * @property string $msn
 * @property string $signature
 * @property string $birthday
 * @property string $gender
 * @property string $avatar
 *
 * The followings are the available model relations:
 * @property User $u
 */
class UserProfile extends CActiveRecord
{
    /**
    * Returns the static model of the specified AR class.
    * @return UserProfile the static model class
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
        return 'profile';
    }

    /**
    * @return array validation rules for model attributes.
    */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
                array('qq', 'numerical', 'integerOnly'=>true),
                array('signature, avatar', 'length', 'max'=>255),
                array('msn', 'length', 'max'=>100),
                array('blog','url'),
                array('gender','in','range'=>array('M','F','U')),
                array('birthday', 'safe'),
                // The following rule is used by search().
                // Please remove those attributes that should not be searched.
                array('id,blog, qq, msn, signature, birthday, gender, avatar', 'safe', 'on'=>'search'),
        );
    }
    public function getGenderOptions()
    {
        return array(
            'M' => '男',
            'F' => '女',
            'U' =>  '保密',
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
                'user' => array(self::BELONGS_TO, 'User', 'id'),
        );
    }

    /**
    * @return array customized attribute labels (name=>label)
    */
    public function attributeLabels()
    {
        return array(
                'id' => 'ID',
                'blog' => 'Blog',
                'qq' => 'QQ',
                'msn' => 'MSN',
                'signature' => '签名',
                'birthday' => '生日',
                'gender' => '性别',
                'avatar' => '头像',
        );
    }

    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            if(isset ($_GET['id']))
                $this->id=(int)$_GET['id'];
            return true;
        }
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
        $criteria->compare('blog',$this->blog,true);
        $criteria->compare('qq',$this->qq);
        $criteria->compare('msn',$this->msn,true);
        $criteria->compare('signature',$this->signature,true);
        $criteria->compare('birthday',$this->birthday,true);
        $criteria->compare('gender',$this->gender,true);
        $criteria->compare('avatar',$this->avatar,true);

        return new CActiveDataProvider(get_class($this), array(
                'criteria'=>$criteria,
        ));
    }
}