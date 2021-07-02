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
* @property int|null $countries_id 
* @property int|null $state_id 
* @property int|null $city_id 
 * @property string|null $source
* @property string|null $close_reason 
 * @property string|null $subject
 * @property string|null $referred_by
 * @property int|null $program_id
 * @property int|null $amount
 * @property int|null $currency_id
* @property string|null $remarks 
* @property int|null $enq_status
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Location $country
 * @property Currency $currency
 * @property Program $program
* @property City $city0
* @property Country $countries
* @property Owner $owner0
* @property State $state0
* @property EnquiryBatch[] $enquiryBatches 
* @property EnquiryRemarks[] $enquiryRemarks
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
            [['date_of_enquiry', 'owner_id', 'country_id', 'countries_id', 'state_id', 'city_id', 'program_id', 'amount', 'currency_id', 'enq_status', 'status', 'created_at', 'updated_at'], 'integer'],
            [['remarks'], 'string'], 
            [['full_name', 'address', 'owner', 'close_reason', 'subject'], 'string', 'max' => 255],
            [['contact_no'], 'string', 'max' => 20],
            [['email', 'city', 'source', 'referred_by'], 'string', 'max' => 50],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Location::className(), 'targetAttribute' => ['country_id' => 'id']],
            [['currency_id'], 'exist', 'skipOnError' => true, 'targetClass' => Currency::className(), 'targetAttribute' => ['currency_id' => 'id']],
            [['program_id'], 'exist', 'skipOnError' => true, 'targetClass' => Program::className(), 'targetAttribute' => ['program_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['owner_id' => 'id']], 
            [['city_id'], 'exist', 'skipOnError' => true, 'targetClass' => City::className(), 'targetAttribute' => ['city_id' => 'id']],
            [['countries_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['countries_id' => 'id']],
            [['owner_id'], 'exist', 'skipOnError' => true, 'targetClass' => Owner::className(), 'targetAttribute' => ['owner_id' => 'id']],
            [['state_id'], 'exist', 'skipOnError' => true, 'targetClass' => State::className(), 'targetAttribute' => ['state_id' => 'id']],
            [['email', 'contact_no'], 'unique'],
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
            'countries_id' => 'Countries ID', 
            'state_id' => 'State ID', 
            'city_id' => 'City ID', 
            'source' => 'Source',
            'close_reason' => 'Reason of Closing', 
            'subject' => 'Subject',
            'referred_by' => 'Referred By',
            'program_id' => 'Program ID',
            'amount' => 'Amount',
            'currency_id' => 'Currency ID',
            'remarks' => 'Remarks', 
            'enq_status' => 'Enquiry Status',
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

    /**
     * Gets query for [[EnquiryRemarks]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryRemarks()
    {
        return $this->hasMany(EnquiryRemarks::className(), ['enquiry_id' => 'id']);
    }

    /**
     * Gets query for [[State]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getState() 
    { 
        return $this->hasOne(State::className(), ['id' => 'state_id']); 
    } 
   
   /**
    * Gets query for [[City0]].
    *
    * @return \yii\db\ActiveQuery
    */
   public function getCity0()
   {
       return $this->hasOne(City::className(), ['id' => 'city_id']);
   }

   /**
    * Gets query for [[Countries]].
    *
    * @return \yii\db\ActiveQuery
    */
   public function getCountries()
   {
       return $this->hasOne(Country::className(), ['id' => 'countries_id']);
   }
}
