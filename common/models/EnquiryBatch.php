<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry_batch".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $enquiry_id
 * @property int|null $program_id
 * @property int|null $batch_id
 * @property int|null $start_date
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property string|null $final_status
* @property string|null $currency
* @property int|null $amount
* @property string|null $installment_plan
* @property int|null $invoicing
 * @property int|null $status
 *
 * @property Batch $batch
 * @property Enquiry $enquiry
 */
class EnquiryBatch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry_batch';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['enquiry_id', 'program_id', 'batch_id', 'start_date', 'created_at', 'updated_at', 'amount', 'invoicing', 'status'], 'integer'],
            [['installment_plan'], 'string'],
            [['name', 'final_status'], 'string', 'max' => 50],
            [['currency'], 'string', 'max' => 20], 
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['batch_id' => 'id']],
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
            'name' => 'Name',
            'enquiry_id' => 'Enquiry ID',
            'program_id' => 'Program ID',
            'batch_id' => 'Batch ID',
            'start_date' => 'Start Date',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'final_status' => 'Final Status',
            'currency' => 'Currency', //
            'amount' => 'Amount',  //
            'installment_plan' => 'Installment Plan',  // 
            'invoicing' => 'Invoicing', //
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
     * Gets query for [[Enquiry]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiry()
    {
        return $this->hasOne(Enquiry::className(), ['id' => 'enquiry_id']);
    }
	
	public static function getEnquiryBatches($id)
    {
        $data=  static::find()->joinWith('batch')->where([ 'enquiry_batch.enquiry_id'=>$id, 'enquiry_batch.status'=>10 ])->all();
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'name','name');
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','batch_id');
		$value = [];
		foreach($data as $dt){
			$value[] = $dt->batch_id;
		}
        return $value;
    }
}
