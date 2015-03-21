<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cuisines".
 *
 * @property integer $cuisine_id
 * @property string $cuisine
 *
 * @property Restaurants[] $restaurants
 */
class Cuisine extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cuisines';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cuisine'], 'required'],
            [['cuisine'], 'string', 'max' => 300]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cuisine_id' => Yii::t('app', 'Cuisine ID'),
            'cuisine' => Yii::t('app', 'Cuisine'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurants()
    {
        return $this->hasMany(Restaurants::className(), ['cuisine' => 'cuisine_id']);
    }
}
