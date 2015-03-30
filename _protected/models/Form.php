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
	

    public function rules()
    {
        return [
                
            [['email','phone', 'name'], 'required'],
   
            ['email', 'email'],
            ['comment', 'string', 'min' => 20, 'max' => 255]

            
            
                
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
