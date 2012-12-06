<?php

/**
 * This is the model class for table "problem".
 *
 * The followings are the available columns in table 'problem':
 * @property integer $id
 * @property integer $kid
 * @property string $title
 * @property integer $num
 * @property string $nickname
 * @property string $email
 * @property integer $createdat
 * @property string $audit
 * @property integer $audittime
 * @property integer $status
 */
class Problem extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Problem the static model class
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
		return 'problem';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('kid, num, createdat, audittime, status', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>255),
			array('nickname', 'length', 'max'=>15),
			array('email', 'length', 'max'=>100),
			array('audit', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, kid, title, num, nickname, email, createdat, audit, audittime, status', 'safe', 'on'=>'search'),
		);
	}
	
	public function scopes() {
		return array(
				'myJoin' => array(
						'select' => 't.*',
						'join' => 'LEFT JOIN tbl_quanzi_member q ON (t.qid = q.qid and t.owner <> q.uid)',
						'condition' => 'uid = :owner AND t.state = 1',
						'order' => 'q.time DESC',
						'group' => 'q.qid',
						'params' => array(
								':owner' => Yii::app()->user->id
						)),
			'idDesc'=>array(
					'alias'=>'t',
					'select'=>'t.*,count(a.pid) as num',
					'join' => 'LEFT JOIN answer a ON (t.id=a.pid)',
					'group'=>'a.pid',
					'condition'=>'t.status=1',
					'order'=>'num DESC,id DESC',
					'limit'=>'12'
			),
			'limit'=>array(
					'alias'=>'t',
					'select'=>'t.*,count(a.pid) as num',
					'join' => 'LEFT JOIN answer a ON (t.id=a.pid)',
					'group'=>'a.pid',
					'condition'=>'t.status=1',
					'order'=>'num DESC,id DESC',
					'limit'=>'20'
			),
	);
	}
	
	

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array_merge(parent::relations(), array(
			// 反馈信息
			'answer' => array(self::HAS_MANY, 'Answer', 'pid'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'kid' => '关键词',
			'title' => '问题',
			'num' => '同问数',
			'nickname' => '发起人昵称',
			'email' => '发起人邮箱',
			'createdat' => '发起时间	',
			'audit' => '审核人',
			'audittime' => '审核时间',
			'status' => '状态',
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
		$criteria->compare('kid',$this->kid);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('num',$this->num);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('createdat',$this->createdat);
		$criteria->compare('audit',$this->audit,true);
		$criteria->compare('audittime',$this->audittime);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}