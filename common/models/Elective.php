<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "elective".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $hours
 * @property int|null $tentative_date
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property EnquiryBatchElectives[] $enquiryBatchElectives
 */
class Elective extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'elective';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['hours', 'tentative_date', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
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
            'hours' => 'Hours',
            'tentative_date' => 'Tentative Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[EnquiryBatchElectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryBatchElectives()
    {
        return $this->hasMany(EnquiryBatchElectives::className(), ['elective_id' => 'id']);
    }
	
	public static function getElectives()
    {
        $data=  static::find()->all();
        $value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','name');
        return $value;
    }
}
