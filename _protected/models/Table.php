<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tables".
 *
 * @property integer $max_people
 * @property integer $table_id
 * @property integer $restaurant_id
 *
 * @property Bookings[] $bookings
 * @property Restaurants $restaurant
 */
class Table extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tables';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['max_people', 'table_id', 'restaurant_id'], 'integer'],
            [['restaurant_id'], 'required']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'max_people' => Yii::t('app', 'Max People'),
            'table_id' => Yii::t('app', 'Table ID'),
            'restaurant_id' => Yii::t('app', 'Restaurant ID'),
        ];
    }
    
    /**
     * Gets the restaurant name from the related Restaurants table.
     *
     * @return mixed
     */
    public function getRestaurantName()
    {
    	return $this->restaurant->name;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBookings()
    {
        return $this->hasMany(Booking::className(), ['table_id' => 'table_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::className(), ['restaurant_id' => 'restaurant_id']);
    }
}
