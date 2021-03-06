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
    
    public static function findFiltered($params){
    	$where = null;
    	$finalwhere = null;    	
    	if ($params){
	    	if (strpos($params->cuisine, 'All') ===  false)
	    		 $where  .=  " c.cuisine='".$params->cuisine."'";
	    	
	    	if (strpos($params->country, 'All') ===  false){
	    		if ($where)
	    			$where  .= " and";
	    		$where  .=  " r.country='".$params->country."'";   		
	    	}
	    	if (strpos($params->city, 'All') === false){
	    		if ($where)
	    			$where  .= " and";
	    		$where  .=  " r.city='".$params->city."'";
	    	}
	    	if (strpos($params->restaurant, 'All') ===  false){
	    		if ($where)
	    			$where  .= " and";
	    		$where  .=  " r.name='".$params->restaurant."'";
	    	}
	    	if ($params->wifi = 1){
	    		if ($where)
	    			$where  .= " and";
	    		$where  .=  " r.wifi>=1";
	    	}
	    	if ($params->vegetarian = 1){
	    		if ($where)
	    			$where  .= " and";
	    		$where  .=  " r.vegetarian>=1";
	    	}
	    	if ($where)
	    		$finalwhere = " where ".$where;
    	}
    	return RestaurantSearch::findBySql(
    			'select r.restaurant_id, r.email, r.description, r.name, r.city, r.country, r.max_people, r.opening_time, r.closing_time, r.address, c.cuisine from restaurants r left join cuisines c on r.cuisine=c.cuisine_id'.$finalwhere)
    			-> all();
    	
    }
    
    public static function findForDropdownByCountry($params){
    	return RestaurantSearch::findBySql(
    			'select name, city from restaurants where country="'.$params.'"')
    			-> all();   	
    }
    public static function findForDropdownByCity($params){
    	return RestaurantSearch::findBySql(
    			'select name, city from restaurants where city="'.$params.'"')
    			-> all();
    }
    
}
