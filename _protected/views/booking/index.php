<?php $this->registerJsFile(Yii::$app->request->baseUrl.'/themes/slate/js/ajax.js',['depends' => [\yii\web\JqueryAsset::className()]]); ?>
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\BookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Bookings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="booking-index">

    <h1>
    <?= Html::encode($this->title) ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <span class="pull-right">    
        <?= Html::a(Yii::t('app', 'Create Booking'), ['create'], ['class' => 'btn btn-success']) ?>
	</span> 
	
	</h1>
	<?php  yii\widgets\Pjax::begin(['id' => 'pjaxBookings']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'booking_id',
            'table_id',
            'people',
            'user_id',
//             'date',
            [
            	'attribute'=>'date',
            	'filter'=>DatePicker::widget([
            		'model' => $searchModel,
            		'attribute' => 'date',
				    'options' => ['placeholder' => 'yyyy-mm-dd'],
				    'pluginOptions' => [
				        'autoclose'=>true,
				        'format' => 'yyyy-mm-dd'
				    ]
			    ]),
			],
            // 'time',
            // 'comment',
            // 'booking_time',

            ['class' => 'yii\grid\ActionColumn',
            'header' => "Menu",
            'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'View booking', 
                            'class'=>'glyphicon glyphicon-eye-open']);
                    },
                    'update' => function ($url, $model, $key) {
                        return Html::a('', $url, ['title'=>'Manage booking', 
                            'class'=>'glyphicon glyphicon-user']);
                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('', $url, 
                        ['title'=>'Delete booking', 
                            'class'=>'glyphicon glyphicon-trash',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this booking?'),
                                'method' => 'post']
                        ]);
                    }
                ]
            ], // ActionColumn
        ],
    ]); ?>
    <?php  yii\widgets\Pjax::end() ?>

</div>
