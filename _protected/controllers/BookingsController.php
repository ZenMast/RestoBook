<?php

namespace app\controllers;

use Yii;
use app\models\Booking;
use app\models\BookingSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\TableSearch;
use yii\helpers\ArrayHelper;
use app\models\UserSearch;


/**
 * BookingController implements the CRUD actions for Booking model.
 */
class BookingsController extends AppController
{
//     public function behaviors()
//     {
//         return [
//             'verbs' => [
//                 'class' => VerbFilter::className(),
//                 'actions' => [
//                     'delete' => ['post'],
//                 ],
//             ],
//         ];
//     }

    /**
     * Lists all Booking models.
     * @return mixed
     */
    public function actionIndex()
    {
    
    	
        $searchModel = new BookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    

    /**
     * Displays a single Booking model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Booking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Booking();
        $tables = ArrayHelper::map(TableSearch::findAllIds(), 'table_id', 'table_id');
        $users = ArrayHelper::map(UserSearch::findAllIds(), 'id', 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->booking_id]);
        } else {
            return $this->render('create', [
            	'model' => $model,
                'tables' => $tables,
            	'users' => $users,
            ]);
        }
    }

    /**
     * Updates an existing Booking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $tables = ArrayHelper::map(TableSearch::findAllIds(), 'table_id', 'table_id');
        $users = ArrayHelper::map(UserSearch::findAllIds(), 'id', 'id');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->booking_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'tables' => $tables,
            	'users' => $users,
            ]);
        }
    }

    /**
     * Deletes an existing Booking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Booking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Booking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Booking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionLongpoll(){   	
    	$id = BookingSearch::findLast()[0]['booking_id'];
    	while (true) {      	 
     		$newBook = BookingSearch::findNewer($id);    		
            if ($newBook) {
               return true;
            }
            sleep(10);
        }
    }
}

