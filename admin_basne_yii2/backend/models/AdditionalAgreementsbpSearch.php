<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdditionalAgreementsbp;

/**
 * AdditionalAgreementsbpSearch represents the model behind the search form of `app\models\AdditionalAgreementsbp`.
 */
class AdditionalAgreementsbpSearch extends AdditionalAgreementsbp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agreementbp_id'], 'integer'],
            [['number', 'date', 'subject', 'resource_path', 'list_path'], 'safe'],
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
        $query = AdditionalAgreementsbp::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'agreementbp_id' => $this->agreementbp_id,
        ]);

        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'resource_path', $this->resource_path])
            ->andFilterWhere(['like', 'list_path', $this->list_path]);

        return $dataProvider;
    }
}
