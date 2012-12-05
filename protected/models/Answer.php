<?php

/**
 * This is the model class for table "answer".
 *
 * The followings are the available columns in table 'answer':
 * @property integer $id
 * @property integer $pid
 * @property string $answer
 * @property integer $createdat
 * @property string $nickname
 * @property string $email
 * @property integer $top
 * @property integer $tread
 * @property string $audit
 * @property integer $audittime
 * @property integer $status
 */
class Answer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Answer the static model class
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
		return 'answer';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid, createdat, top, tread, audittime, status', 'numerical', 'integerOnly'=>true),
			array('nickname, audit', 'length', 'max'=>50),
			array('email', 'length', 'max'=>100),
			array('answer', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, pid, answer, createdat, nickname, email, top, tread, audit, audittime, status', 'safe', 'on'=>'search'),
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
			'problem' => array(self::BELONGS_TO, 'Problem', 'pid'),
		));
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'pid' => '问题',
			'answer' => '回答',
			'createdat' => '回答时间',
			'nickname' => '回答人昵称',
			'email' => '回答人邮箱',
			'top' => '顶',
			'tread' => '踩',
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
		$criteria->compare('pid',$this->pid);
		$criteria->compare('answer',$this->answer,true);
		$criteria->compare('createdat',$this->createdat);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('top',$this->top);
		$criteria->compare('tread',$this->tread);
		$criteria->compare('audit',$this->audit,true);
		$criteria->compare('audittime',$this->audittime);
		$criteria->compare('status',$this->status);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}