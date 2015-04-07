<?php

namespace app\models;

use yii\base\Model;
use Yii;

class TableSelection extends Model
{
	public $restaurant;
	public $booking_time;
	public $date;

    public function rules()
    {
        return [
            
        ];
    }
    public function attributeLabels()
    {
        return [      
        ];
    }
}
