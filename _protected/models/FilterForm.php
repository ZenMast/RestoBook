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
	public $restaurants;
	public $restaurant;
	public $cuisine;
	public $vegetarian;
	public $wifi;

    public function rules()
    {

        return [
            ['country', 'string'],
            ['city', 'string'], 
        	['restaurant', 'string'],
        	['cuisine', 'string'],
        	['guests', 'number'],
        	['vegetarian', 'number'],
        	['wifi', 'number'],
        ];
    }
    public function attributeLabels()
    {
        return [      
        ];
    }
}
