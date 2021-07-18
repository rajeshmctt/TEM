<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "program".
 *
 * @property int $id
 * @property string|null $name
* @property int|null $tentative_date 
* @property int|null $hours 
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Batch[] $batches
 * @property Enquiry[] $enquiries
 */
class Program extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tentative_date', 'hours', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['name','tentative_date'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Program',
            'tentative_date' => 'Tentative Date',
            'hours' => 'Hours',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Batches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatches()
    {
        return $this->hasMany(Batch::className(), ['program_id' => 'id']);
    }

    /**
     * Gets query for [[Enquiries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['program_id' => 'id']);
    }
	
	public static function getPrograms()
    {
        $data=  static::find()->all();
        $value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','name');
        return $value;
    }
}
