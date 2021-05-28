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
 * @property Enquiry[] $enquiries
 * @property Enquiry[] $enquiries0
 * @property Enquiry[] $enquiries1
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
     * Gets query for [[Enquiries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['l1_batch' => 'id']);
    }

    /**
     * Gets query for [[Enquiries0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries0()
    {
        return $this->hasMany(Enquiry::className(), ['l2_batch' => 'id']);
    }

    /**
     * Gets query for [[Enquiries1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries1()
    {
        return $this->hasMany(Enquiry::className(), ['l3_batch' => 'id']);
    }
}
