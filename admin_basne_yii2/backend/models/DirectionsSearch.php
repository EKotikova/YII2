<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Directions;
use yii\data\Pagination;

/**
 * DirectionsSearch represents the model behind the search form of `app\models\Directions`.
 */
class DirectionsSearch extends Directions
{
    /**
     * {@inheritdoc}
     */
    //public string $program = ' ';


    public function rules()
    {
        return [
            //[['program'],'integer'],
           // [['program'],'safe'],
            [['id', 'program_id'], 'integer'],
            [['number', 'name', 'note'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Directions::find()->where(['program_id'=>$_SESSION['program_id']]);
        //$pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>6]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           // 'pagination'=>$pages,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('program');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'program_id' => $this->program_id,
        ]);

        $table_derections = Directions::tableName();

        $query->andFilterWhere(['like', $table_derections.'.number', $this->number])
            ->andFilterWhere(['like', $table_derections.'.name', $this->name]);

        return $dataProvider;
    }
}
