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
	public $guests = 2;
	public $date;
	public $time;



    public function rules()
    {

        return [
            ['country', 'string'],
            ['city', 'string'], 
        	['restaurant', 'string'],
        	['cuisine', 'string'],
        	['guests', 'number'],
        	['date', 'string'],
        	['time', 'string'],
        ];
    }
    public function attributeLabels()
    {
        return [      
        ];
    }
}
