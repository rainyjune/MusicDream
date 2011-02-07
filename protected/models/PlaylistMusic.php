<?php

/**
 * This is the model class for table "playlist_music".
 */
class PlaylistMusic extends CActiveRecord
{
	/**
	 * The followings are the available columns in table 'playlist_music':
	 * @var integer $id
	 * @var integer $playlist_id
	 * @var integer $music_id
	 */
	 //保存用户提交的歌曲id
	public $ids;

	/**
	 * Returns the static model of the specified AR class.
	 * @return PlaylistMusic the static model class
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
		return 'playlist_music';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('playlist_id, music_id', 'required'),
			array('playlist_id, music_id', 'numerical', 'integerOnly'=>true),
			array('ids', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, playlist_id, music_id', 'safe', 'on'=>'search'),
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
			'music' => array(self::BELONGS_TO, 'Music', 'music_id'),
			'playlist' => array(self::BELONGS_TO, 'Playlist', 'playlist_id'),
		);
	}
	
	
	public function addMusic()
	{
/*		echo "$this->playlist_id"."<br />";
		echo $this->ids;
		exit;*/
		$this->ids=explode('_',$this->ids);
		if(empty($this->playlist_id) || empty($this->ids))
		{
			return false;
		}
		$playlistid=$this->playlist_id;
		$musicids=$this->ids;
		$status=TRUE;
		foreach($musicids as $musicId)
		{
			if(self::model()->exists("playlist_id=$playlistid AND music_id=$musicId"))
			{
				continue;
			}
			$newItem=new PlaylistMusic;
			$newItem->playlist_id=$this->playlist_id;
			$newItem->music_id=$musicId;
			if($newItem->save())
			{
				$newStatus=TRUE;
			}
			else
			{
				$newStatus=FALSE;
			}
			$status=$newStatus && $status;		
		}
		return $status;
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'playlist_id' => '播放列表',
			'music_id' => '音乐',
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

		$criteria->compare('playlist_id',$this->playlist_id);

		$criteria->compare('music_id',$this->music_id);

		return new CActiveDataProvider(get_class($this), array(
			'criteria'=>$criteria,
		));
	}
}