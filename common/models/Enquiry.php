<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "enquiry".
 *
 * @property int $id
 * @property int|null $date_of_enquiry
 * @property string|null $full_name
 * @property string|null $contact_no
 * @property string|null $email
 * @property string|null $address
 * @property string|null $owner
 * @property string|null $city
 * @property int|null $country_id
 * @property string|null $source
 * @property string|null $subject
 * @property string|null $referred_by
 * @property int|null $program_id
 * @property string|null $final_status_l1
 * @property int|null $invoice_raised_l1
 * @property int|null $l1_batch
 * @property int|null $l1_status
 * @property string|null $final_status_l2
 * @property int|null $invoice_raised_l2
 * @property int|null $l2_batch
 * @property int|null $l2_status
 * @property string|null $final_status_l3
 * @property int|null $invoice_raised_l3
 * @property int|null $l3_batch
 * @property int|null $l3_status
 * @property int|null $amount
 * @property int|null $currency_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Batch $l1Batch
 * @property Batch $l2Batch
 * @property Batch $l3Batch
 * @property Location $country
 * @property Currency $currency
 * @property Program $program
 */
class Enquiry extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_of_enquiry', 'country_id', 'program_id', 'invoice_raised_l1', 'l1_batch', 'l1_status', 'invoice_raised_l2', 'l2_batch', 'l2_status', 'invoice_raised_l3', 'l3_batch', 'l3_status', 'amount', 'currency_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['full_name', 'address', 'owner', 'subject'], 'string', 'max' => 255],
            [['contact_no'], 'string', 'max' => 20],
            [['email', 'city', 'source', 'referred_by', 'final_status_l1', 'final_status_l2', 'final_status_l3'], 'string', 'max' => 50],
            [['l1_batch'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['l1_batch' => 'id']],
            [['l2_batch'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['l2_batch' => 'id']],
            [['l3_batch'], 'exist', 'skipOnError' => true, 'targetClass' => Batch::className(), 'targetAttribute' => ['l3_batch' => 'id']],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
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
            'date_of_enquiry' => 'Date Of Enquiry',
            'full_name' => 'Full Name',
            'contact_no' => 'Contact No',
            'email' => 'Email',
            'address' => 'Address',
            'owner' => 'Owner',
            'city' => 'City',
            'country_id' => 'Country ID',
            'source' => 'Source',
            'subject' => 'Subject',
            'referred_by' => 'Referred By',
            'program_id' => 'Program ID',
            'final_status_l1' => 'Final Status L1',
            'invoice_raised_l1' => 'Invoice Raised L1',
            'l1_batch' => 'L1 Batch',
            'l1_status' => 'L1 Status',
            'final_status_l2' => 'Final Status L2',
            'invoice_raised_l2' => 'Invoice Raised L2',
            'l2_batch' => 'L2 Batch',
            'l2_status' => 'L2 Status',
            'final_status_l3' => 'Final Status L3',
            'invoice_raised_l3' => 'Invoice Raised L3',
            'l3_batch' => 'L3 Batch',
            'l3_status' => 'L3 Status',
            'amount' => 'Amount',
            'currency_id' => 'Currency ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[L1Batch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getL1Batch()
    {
        return $this->hasOne(Batch::className(), ['id' => 'l1_batch']);
    }

    /**
     * Gets query for [[L2Batch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getL2Batch()
    {
        return $this->hasOne(Batch::className(), ['id' => 'l2_batch']);
    }

    /**
     * Gets query for [[L3Batch]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getL3Batch()
    {
        return $this->hasOne(Batch::className(), ['id' => 'l3_batch']);
    }

    /**
     * Gets query for [[Country]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Location::className(), ['id' => 'country_id']);
    }

    /**
     * Gets query for [[Currency]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurrency()
    {
        return $this->hasOne(Currency::className(), ['id' => 'currency_id']);
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
}
