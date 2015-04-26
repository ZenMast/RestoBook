<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Reservation extends Model
{
    public $email;
    public $phone;
    public $name;
    public $comment;
    public $date;
    public $time;
    public $people;
    public $tables;
    public $restaurant_data;
    public $restaurant_id;


    public function rules()
    {
    	
    	return [
                
            [['email','phone', 'name','date','time', 'people','tables'], 'required'],
   			
            ['email', 'email'],
            ['comment', 'string','max' => 255],                     
    		['restaurant_id', 'number'],
        ];
    }
    public function attributeLabels()
    {
        return [ 

            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'comment' => Yii::t('app', 'Comment'),
            'phone' => Yii::t('app', 'Phone'),     
        ];
    }

}
