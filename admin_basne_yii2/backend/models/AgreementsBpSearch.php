<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AgreementsBp;

/**
 * AgreementsBpSearch represents the model behind the search form of `app\models\AgreementsBp`.
 */
class AgreementsBpSearch extends AgreementsBp
{
    public string  $agreement='';
    public string  $lender='';
    public string  $precipient='';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_organization_lender', 'id_organization_recipient', 'id_agreements'], 'integer'],
            [['number', 'date', 'list', 'agreement_path', 'list_path'], 'safe'],
            [['agreement'],'safe'],
            [['lender'],'safe'],
            [['precipient'],'safe'],

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
        $query = AgreementsBp::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([

            /*'defaultOrder' => [
                'curator' => SORT_ASC,
            ],*/
            'attributes' => [
                'number' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],
                'agreement' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],
                'lender' => [
                    'asc' => ['shortname' => SORT_ASC],
                    'desc' => ['shortname' => SORT_DESC],
                ],
                'precipient' => [
                    'asc' => ['shortname' => SORT_ASC],
                    'desc' => ['shortname' => SORT_DESC],
                ],


            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $table_agreement = Agreements::tableName();
        $table_organizationBp = OrganizationBp::tableName();
        $table_agreement_bp = AgreementsBp::tableName();

        $query->joinWith('agreement');
        $query->andFilterWhere(['like',$table_agreement.'.number',$this->agreement]);
        if(isset($this->lender)) {
            $query->joinWith('lender');
            $query->andFilterWhere(['like', $table_organizationBp . '.shortname', $this->lender]);
        }
        if(isset($this->precipient)) {
            $query->joinWith('precipient');
            $query->andFilterWhere(['like', $table_organizationBp . '.shortname', $this->precipient]);
        }
        // grid filtering conditions
        $query->andFilterWhere([
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like',$table_agreement_bp. '.number', $this->number])
            ->andFilterWhere(['like', 'list', $this->list])
            ->andFilterWhere(['like', 'agreement_path', $this->agreement_path])
            ->andFilterWhere(['like', 'list_path', $this->list_path]);

        return $dataProvider;
    }
}
