<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Restaurant;
use yii\helpers\ArrayHelper;


/**
 * RestaurantSearch represents the model behind the search form about `app\models\Restaurant`.
 */
class RestaurantSearch extends Restaurant
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['restaurant_id', 'cuisine', 'vegetarian', 'wifi', 'max_people'], 'integer'],
            [['name', 'opening_time', 'closing_time', 'country', 'city', 'address', 'website', 'email', 'phone', 'description'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }
    
    static public function findAllIds() {
    	return Restaurant::find()
    	->select(['restaurant_id'])
    	-> all();
    }
    
   
    static public function findAllInfIds() {
        return Restaurant::find()
        ->select(['restaurant_id','name', 'city','country','max_people','opening_time','closing_time','address'])
        -> all();
    }
    
    static public function findAllData() {
    	return RestaurantSearch::findBySql(
    	 	'select r.restaurant_id, r.name, r.city, r.country, r.max_people, r.opening_time, r.closing_time, r.address, c.cuisine from restaurants r join cuisines c on r.cuisine=cuisine_id')
    	-> all();
    }
    
   
    static public function findAllIdsToAssocString() {

    	return ArrayHelper::map(RestaurantSearch::findAllIds(), 'restaurant_id', 'restaurant_id');
    
    }
    
    
    //Aggregation (count), shows total number of bookings per restaurant
    static public function countBookingsSum($id) {
    	return RestaurantSearch::findBySql(
    			'select count(*) from bookings,`tables` where bookings.table_id = `tables`.table_id and `tables`.restaurant_id = ' . $id
    			)
		->count();
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
        $query = Restaurant::find();

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
            'restaurant_id' => $this->restaurant_id,
            'opening_time' => $this->opening_time,
            'closing_time' => $this->closing_time,
            'cuisine' => $this->cuisine,
            'vegetarian' => $this->vegetarian,
            'wifi' => $this->wifi,
            'max_people' => $this->max_people,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'website', $this->website])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
    
    static public function findByParams($country) {
    	return RestaurantSearch::findBySql('select * from restaurants where country ="'.$country.'"')->all();
    }
}
