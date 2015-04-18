<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Table;

/**
 * TableSearch represents the model behind the search form about `app\models\Table`.
 */
class TableSearch extends Table
{
	
	public $restaurant;
	
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['max_people', 'table_id', 'restaurant_id'], 'integer'],
        	[['restaurant'], 'safe'],
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
    	return Table::find()
    	->select(['table_id','max_people'])
    	-> all();
    }

    static public function findAllTableId($params) {
        return Table::findBySql(
            'select tables.table_id,tables.max_people 
            FROM tables 
            join restaurants 
            on restaurants.restaurant_id=tables.restaurant_id 
            where restaurants.name="'. $params-> restaurant_name .'"')
        -> all();
    }


    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     * 
     * For Stanislav - generated query here (using join) is:
     * SELECT `tables`.* FROM `tables` LEFT JOIN `restaurants` ON `tables`.`restaurant_id` = `restaurants`.`restaurant_id` 
     */
    public function search($params)
    {
        $query = Table::find();
        
        //JOIN operation, to enable tables sort by restaurant name
        $query->joinWith('restaurant');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        // Important: here is how we set up the sorting
        // The key is the attribute name on our "TableSearch" instance
        $dataProvider->sort->attributes['restaurant'] = [
        		// The tables are the ones our relation are configured to
        		// in my case they are prefixed with "tbl_"
        		'asc' => ['restaurants.name' => SORT_ASC],
        		'desc' => ['restaurants.name' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'max_people' => $this->max_people,
            'table_id' => $this->table_id,
            'restaurant_id' => $this->restaurant_id,
        ]);
        
        //For filtering
        $query->andFilterWhere(['like', 'restaurants.name', $this->restaurant]);

        return $dataProvider;
    }
}
