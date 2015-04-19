<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "restaurants".
 *
 * @property integer $restaurant_id
 * @property string $name
 * @property string $opening_time
 * @property string $closing_time
 * @property string $country
 * @property string $city
 * @property string $address
 * @property integer $cuisine
 * @property integer $vegetarian
 * @property integer $wifi
 * @property integer $max_people
 * @property string $website
 * @property string $email
 * @property string $phone
 * @property string $description
 *
 * @property Cuisines $cuisine0
 * @property Tables[] $tables
 */
class Restaurant extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'restaurants';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'country', 'city', 'address', 'email', 'phone'], 'required'],
            [['opening_time', 'closing_time'], 'safe'],
            [['cuisine', 'vegetarian', 'wifi', 'max_people'], 'integer'],
            [['name', 'country', 'city', 'address', 'email'], 'string', 'max' => 200],
            [['website', 'phone'], 'string', 'max' => 300],
            [['description'], 'string', 'max' => 20000],
        	['email', 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
            'name' => Yii::t('app', 'Name'),
            'opening_time' => Yii::t('app', 'Opening Time'),
            'closing_time' => Yii::t('app', 'Closing Time'),
            'country' => Yii::t('app', 'Country'),
            'city' => Yii::t('app', 'City'),
            'address' => Yii::t('app', 'Address'),
            'cuisine' => Yii::t('app', 'Cuisine'),
            'vegetarian' => Yii::t('app', 'Vegetarian'),
            'wifi' => Yii::t('app', 'Wifi'),
            'max_people' => Yii::t('app', 'Max People'),
            'website' => Yii::t('app', 'Website'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'description' => Yii::t('app', 'Description'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCuisine0()
    {
        return $this->hasOne(Cuisines::className(), ['cuisine_id' => 'cuisine']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTables()
    {
        return $this->hasMany(Tables::className(), ['restaurant_id' => 'restaurant_id']);
    }
}
