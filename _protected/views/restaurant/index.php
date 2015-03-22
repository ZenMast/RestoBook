<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RestaurantSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Restaurants');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="restaurant-index">

    <h1>
    <?= Html::encode($this->title) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
	
    <span class="pull-right">    
        <?= Html::a(Yii::t('app', 'Create Restaurant'), ['create'], ['class' => 'btn btn-success']) ?>
	</span>  
	</h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'restaurant_id',
            'name',
//             'opening_time',
//             'closing_time',
            'country',
            'city',
            'address',
            'cuisine',
//             'vegetarian',
//             'wifi',
//             'max_people',
            'website',
            'email:email',
            'phone',
//             'description',

            ['class' => 'yii\grid\ActionColumn',
            'header' => "Menu",
            'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View restaurant', 
                            'class'=>'glyphicon glyphicon-eye-open']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage restaurant', 
                            'class'=>'glyphicon glyphicon-user']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                        ['title'=>'Delete restaurant', 
                            'class'=>'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this restaurant?'),
                                'method' => 'post']
                        ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>

</div>
