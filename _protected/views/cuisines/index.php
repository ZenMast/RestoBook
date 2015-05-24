<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CuisineSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Cuisines');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuisine-index">

    <h1>
    <?= Html::encode($this->title) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <span class="pull-right">    
        <?= Html::a(Yii::t('app', 'Create Cuisine'), ['create'], ['class' => 'btn btn-success']) ?>
    </span> 
    </h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'cuisine_id',
            'cuisine',

            ['class' => 'yii\grid\ActionColumn',
            'header' => "Menu",
            'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View cuisine', 
                            'class'=>'glyphicon glyphicon-eye-open']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage cuisine', 
                            'class'=>'glyphicon glyphicon-user']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                        ['title'=>'Delete cuisine', 
                            'class'=>'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this cuisine?'),
                                'method' => 'post']
                        ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>

</div>
