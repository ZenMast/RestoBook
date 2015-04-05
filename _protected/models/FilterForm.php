<?php

namespace app\models;

use yii\base\Model;
use Yii;

class FilterForm extends Model
{
	public $country;
	public $city;
	public $opening_time;
	public $closing_time;
	public $restaurant;
	public $cuisine;
	public $guests;
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
