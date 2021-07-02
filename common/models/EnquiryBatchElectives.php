<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry_batch_electives".
 *
 * @property int $id
 * @property int|null $enquiry_batch_id
 * @property int|null $elective_id
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Elective $elective
 * @property EnquiryBatch $enquiryBatch
 */
class EnquiryBatchElectives extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry_batch_electives';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enquiry_batch_id', 'elective_id', 'created_at', 'updated_at'], 'integer'],
            [['elective_id'], 'exist', 'skipOnError' => true, 'targetClass' => Elective::className(), 'targetAttribute' => ['elective_id' => 'id']],
            [['enquiry_batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => EnquiryBatch::className(), 'targetAttribute' => ['enquiry_batch_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enquiry_batch_id' => 'Enquiry Batch ID',
            'elective_id' => 'Elective ID',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Elective]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getElective()
    {
        return $this->hasOne(Elective::className(), ['id' => 'elective_id']);
    }

    /**
     * Gets query for [[EnquiryBatch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryBatch()
    {
        return $this->hasOne(EnquiryBatch::className(), ['id' => 'enquiry_batch_id']);
    }
}
