<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "owner".
 *
 * @property int $id
 * @property string|null $name
 * @property string $email
 * @property string|null $contact_no
 * @property int|null $status
 *
 * @property Enquiry[] $enquiries
 */
class Owner extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'owner';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['email'], 'required'],
            // ['email', 'default', 'value' => 'owner@ctt.com'],
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['email', 'contact_no'], 'string', 'max' => 255],
            // [['email'], 'unique'],
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
            'email' => 'Email',
            'contact_no' => 'Contact No',
            'status' => 'Status',
        ];
    }

    /**
     * Gets query for [[Enquiries]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEnquiries()
    {
        return $this->hasMany(Enquiry::className(), ['owner_id' => 'id']);
    }
}
