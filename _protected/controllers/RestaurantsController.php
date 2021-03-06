<?php

namespace app\controllers;

use Yii;
use app\models\Restaurant;
use app\models\RestaurantSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\CuisineSearch;
use yii\helpers\ArrayHelper;
use app\models\BookingSearch;


/**
 * RestaurantController implements the CRUD actions for Restaurant model.
 */
class RestaurantsController extends AppController
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
     * Lists all Restaurant models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RestaurantSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $cuisines = ArrayHelper::map(CuisineSearch::findAllNamesIds(), 'cuisine_id', 'cuisine');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        	'cuisines' => $cuisines
        ]);
    }

    /**
     * Displays a single Restaurant model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
    	
    	$bookingsTotal = strval(RestaurantSearch::countBookingsSum($id));
    	 
        return $this->render('view', [
            'model' => $this->findModel($id),
        	'bookingsTotal' => $bookingsTotal,
        		
        ]);
    }

    /**
     * Creates a new Restaurant model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Restaurant();
        $cuisines = ArrayHelper::map(CuisineSearch::findAllNamesIds(), 'cuisine_id', 'cuisine');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->restaurant_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            	'cuisines' => $cuisines,
            ]);
        }
    }

    /**
     * Updates an existing Restaurant model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $cuisines = ArrayHelper::map(CuisineSearch::findAllNamesIds(), 'cuisine_id', 'cuisine');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->restaurant_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            	'cuisines' => $cuisines,
            ]);
        }
    }

    /**
     * Deletes an existing Restaurant model.
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
     * Finds the Restaurant model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Restaurant the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Restaurant::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
