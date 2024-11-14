<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Arangements;
use yii\data\Pagination;

/**
 * ArangementsSearch represents the model behind the search form of `app\models\Arangements`.
 */
class ArangementsSearch extends Arangements
{
    public string $arangements = '';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'direction_id'], 'integer'],
            [['number', 'name', 'note'], 'safe'],
            [['arangements'],'safe'],
            [['arangements'],'string'],
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
        $query = Arangements::find()->where(['direction_id'=>Directions::find()->select(['id'])->where(['program_id'=>$_SESSION['program_id']])]);
        //$query = Arangements::find();

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

        $query->joinWith('arangements');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'direction_id' => $this->direction_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
