<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "batch".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $program_id
 * @property int|null $start_date
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Program $program
 */
class Batch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_id', 'start_date', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['program_id', 'name'], 'required'],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'program_id' => 'Program ID',
            'start_date' => 'Start Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Program]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
    }

    /**
    * Gets query for [[EnquiryBatches]].
     *
     * @return \yii\db\ActiveQuery
     */
   public function getEnquiryBatches()
    {
        return $this->hasMany(EnquiryBatch::className(), ['batch_id' => 'id']);
    }
	
	public static function getProgBatches($prog)
    {
        $data=  static::find()->where([ 'program_id'=>$prog ])->all();
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'name','name');
        $value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','name');
		/*$value = [];
		foreach($data as $dt){
			$value[] = $dt->id;
		}*/
        return $value;
    } 
	
	public static function getBatchPrograms($batch)
    {
        $data=  static::find()->where([ 'id'=>$batch ])->all();
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'name','name');
        $value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','program_id');
        return $value;
    }
}
