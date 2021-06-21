<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

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
* @property int|null $owner_id 
 * @property string|null $city
 * @property int|null $country_id
 * @property string|null $source
 * @property string|null $subject
 * @property string|null $referred_by
 * @property int|null $program_id
 * @property int|null $amount
 * @property int|null $currency_id
* @property string|null $remarks 
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Location $country
 * @property Currency $currency
 * @property Program $program
* @property Owner $owner0 
* @property EnquiryBatch[] $enquiryBatches 
 */
class Enquiry extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'enquiry';
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
            [['date_of_enquiry', 'owner_id', 'country_id', 'program_id', 'amount', 'currency_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['remarks'], 'string'], 
            [['full_name', 'address', 'owner', 'subject'], 'string', 'max' => 255],
            [['contact_no'], 'string', 'max' => 20],
            [['email', 'city', 'source', 'referred_by'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['owner_id' => 'id']], 
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
            'owner_id' => 'Owner ID', 
            'city' => 'City',
            'country_id' => 'Country ID',
            'source' => 'Source',
            'subject' => 'Subject',
            'referred_by' => 'Referred By',
            'program_id' => 'Program ID',
            'amount' => 'Amount',
            'currency_id' => 'Currency ID',
            'remarks' => 'Remarks', 
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
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
    
    /**
     * Gets query for [[Owner0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOwner0()
    {
        return $this->hasOne(Owner::className(), ['id' => 'owner_id']);
    }
 
    /** 
     * Gets query for [[EnquiryBatches]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getEnquiryBatches() 
    { 
        return $this->hasMany(EnquiryBatch::className(), ['enquiry_id' => 'id']); 
    } 
}
