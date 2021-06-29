<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "enquiry_remarks".
 *
 * @property int $id
 * @property int|null $enquiry_id
 * @property int|null $date
 * @property string|null $remarks
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 *
 * @property Enquiry $enquiry
 */
class EnquiryRemarks extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry_remarks';
    }

    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            [['enquiry_id', 'date', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['remarks'], 'string'],
            [['enquiry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enquiry::className(), 'targetAttribute' => ['enquiry_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enquiry_id' => 'Enquiry ID',
            'date' => 'Date',
            'remarks' => 'Remarks',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
        ];
    }

    /**
     * Gets query for [[Enquiry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiry()
    {
        return $this->hasOne(Enquiry::className(), ['id' => 'enquiry_id']);
    }
}
