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
* @property int|null $currency
* @property int|null $amount
* @property string|null $installment_plan
* @property int|null $invoicing
 * @property int|null $status
 *
 * @property Batch $batch
 * @property Enquiry $enquiry
* @property Currency $currency0
* @property EnquiryBatchElectives[] $enquiryBatchElectives 
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
            [['enquiry_id', 'program_id', 'batch_id', 'currency', 'start_date', 'created_at', 'updated_at', 'amount', 'invoicing', 'status'], 'integer'],
            [['installment_plan'], 'string'],
            [['name', 'final_status'], 'string', 'max' => 50],
            [['batch_id'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['batch_id' => 'id']],
            [['enquiry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Enquiry::className(), 'targetAttribute' => ['enquiry_id' => 'id']],
            [['currency'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency' => 'id']], 
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
    
    public function getProgram()
    {
        return $this->hasOne(Program::className(), ['id' => 'program_id']);
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
 
   
   /**
    * Gets query for [[Currency0]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getCurrency0() 
   { 
       return $this->hasOne(Currency::className(), ['id' => 'currency']); 
   } 

    /**
     * Gets query for [[EnquiryBatchElectives]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryBatchElectives()
    {
        return $this->hasMany(EnquiryBatchElectives::className(), ['enquiry_batch_id' => 'id']);
    }
	
	public static function getEnquiryBatches($id)
    {
        $data=  static::find()->joinWith('batch')->where([ 'enquiry_batch.enquiry_id'=>$id, 'enquiry_batch.status'=>10 ])->all();
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'name','name');
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','batch_id');
		$value = [];
		foreach($data as $dt){
			$value[] = $dt->batch_id;
			// $value[] = $dt->currency0->name;
			// $value[] = $dt->amount;
			// $value[] = $dt->batch_id;
		}
        return $value;
    }
	
	public static function getEbo($id)
    {
        $data=  static::find()->joinWith('batch')->where([ 'enquiry_batch.enquiry_id'=>$id, 'enquiry_batch.status'=>10 ])->all();
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'name','name');
        //$value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','batch_id');
		$value = []; 
        $count =0;
		foreach($data as $dt){
			// $value[$count]['batch'] = $dt->batch_id;
			$value[$count]['currency'] = isset($dt->currency)?$dt->currency0->name:'';
			$value[$count]['amount'] = $dt->amount;
			$value[$count]['install'] = $dt->installment_plan;
            $count++;
		}
        return $value;
    }
}
