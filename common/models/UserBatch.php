<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_batch".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $user_id
 * @property int|null $program_id
 * @property int|null $batch_id
 * @property int|null $start_date
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $final_status
 * @property int|null $invoice_raised
 * @property int|null $status
 *
 * @property Batch $batch
 * @property User $user
 */
class UserBatch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'program_id', 'batch_id', 'start_date', 'created_at', 'updated_at', 'invoice_raised', 'status'], 'integer'],
            [['name', 'final_status'], 'string', 'max' => 50],
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['batch_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'user_id' => 'User ID',
            'program_id' => 'Program ID',
            'batch_id' => 'Batch ID',
            'start_date' => 'Start Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'final_status' => 'Final Status',
            'invoice_raised' => 'Invoice Raised',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Batch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBatch()
    {
        return $this->hasOne(Batch::className(), ['id' => 'batch_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
