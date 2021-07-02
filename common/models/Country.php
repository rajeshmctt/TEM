<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "country".
 *
 * @property int $id
 * @property string|null $country
 * @property string|null $name
 *
 * @property City[] $cities
* @property Currency[] $currencies 
 * @property Enquiry[] $enquiries
 * @property State[] $states
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['country'], 'string', 'max' => 50],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'name' => 'Name',
        ];
    }

    /**
     * Gets query for [[Cities]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCities()
    {
        return $this->hasMany(City::className(), ['country_id' => 'id']);
    }
    
    /**
     * Gets query for [[Currencies]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getCurrencies() 
    { 
        return $this->hasMany(Currency::className(), ['country_id' => 'id']); 
    } 

    /**
     * Gets query for [[Enquiries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['countries_id' => 'id']);
    }

    /**
     * Gets query for [[States]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStates()
    {
        return $this->hasMany(State::className(), ['country_id' => 'id']);
    }
}
