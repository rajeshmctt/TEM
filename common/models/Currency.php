<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "currency".
 *
 * @property int $id
 * @property string|null $name
* @property int|null $country_id 
 * @property int|null $created_at
 * @property int|null $updated_at
 *
*
* @property Country $country 
 * @property Enquiry[] $enquiries
* @property EnquiryBatch[] $enquiryBatches 
 */
class Currency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'currency';
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
            [['country_id', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['name'], 'required'],
            [['country_id'], 'exist', 'skipOnError' => true, 'targetClass' => Country::className(), 'targetAttribute' => ['country_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Currency',
            'country_id' => 'Country',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Enquiries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['currency_id' => 'id']);
    }
 
    /** 
     * Gets query for [[Country]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCountry() 
    { 
        return $this->hasOne(Country::className(), ['id' => 'country_id']); 
    }

    /**
     * Gets query for [[EnquiryBatches]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiryBatches()
    {
        return $this->hasMany(EnquiryBatch::className(), ['currency' => 'id']);
    }
	
	public static function getCurrency()
    {
        $data=  static::find()->all();
        $value=(count($data)==0)? []: \yii\helpers\ArrayHelper::map($data, 'id','name');
        return $value;
    }
}
