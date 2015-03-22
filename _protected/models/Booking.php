<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bookings".
 *
 * @property integer $booking_id
 * @property integer $table_id
 * @property integer $people
 * @property integer $user_id
 * @property string $date
 * @property string $time
 * @property string $comment
 * @property string $booking_time
 *
 * @property Tables $table
 * @property User $user
 */
class Booking extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bookings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['table_id', 'people', 'user_id', 'date', 'time'], 'required'],
            [['booking_id', 'table_id', 'people', 'user_id'], 'integer'],
            [['date', 'time', 'booking_time'], 'safe'],
            [['comment'], 'string', 'max' => 3000]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'booking_id' => Yii::t('app', 'Booking ID'),
            'table_id' => Yii::t('app', 'Table ID'),
            'people' => Yii::t('app', 'People'),
            'user_id' => Yii::t('app', 'User ID'),
            'date' => Yii::t('app', 'Date'),
            'time' => Yii::t('app', 'Time'),
            'comment' => Yii::t('app', 'Comment'),
            'booking_time' => Yii::t('app', 'Booking Time'),
        ];
    }
    
    

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTable()
    {
        return $this->hasOne(Tables::className(), ['table_id' => 'table_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
