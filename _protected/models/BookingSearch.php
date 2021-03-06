<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Booking;
use yii\db\ActiveRecord;

/**
 * BookingSearch represents the model behind the search form about `app\models\Booking`.
 */
class BookingSearch extends Booking
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['booking_id', 'table_id', 'people', 'user_id'], 'integer'],
            [['date', 'time', 'comment', 'booking_time'], 'safe'],
        ];
    }
    static public function findAllbds() {
        return Booking::find()
        ->select(['booking_id','booking_time'])
        -> all();
    }
    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Booking::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'booking_id' => $this->booking_id,
            'table_id' => $this->table_id,
            'people' => $this->people,
            'user_id' => $this->user_id,
            'date' => $this->date,
            'time' => $this->time,
            'booking_time' => $this->booking_time,
        ]);

        $query->andFilterWhere(['like', 'comment', $this->comment]);

        return $dataProvider;
    }
    
    public static function findNewer($id){
    	return BookingSearch::findBySql(
    		'select booking_id FROM bookings where booking_id >' . $id)->all();   	
    }
    
    
    public static function findLast(){
    	return BookingSearch::findBySql(
    			'SELECT booking_id FROM bookings ORDER BY booking_id DESC LIMIT 1')->all();
    }
}
