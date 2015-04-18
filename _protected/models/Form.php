<?php

namespace app\models;

use yii\base\Model;
use Yii;

class Form extends Model
{
    public $email;
    public $phone;
    public $name;
    public $comment;
    public $date;
    public $time;
    public $people;
    public $table;
    public $restaurant_name;


    public function rules()
    {
        return [
                
            [['email','phone', 'name','date','time', 'people'], 'required'],
   
            ['email', 'email'],
            ['comment', 'string','max' => 255]

            
            
                
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
