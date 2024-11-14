<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AdditionalAgreements;
use yii\data\Pagination;


/**
 * AdditionalAgreementsSearch represents the model behind the search form of `app\models\AdditionalAgreements`.
 */
class AdditionalAgreementsSearch extends AdditionalAgreements
{
    public string $agreements='';
    public string $curator='';
    public string $executor='';
    public string $organization='';
    public string $userprofile = '';


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agreements'],'safe'],
            [['agreements'],'string'],
            [['userprofile'],'string'],
            [['userprofile'],'safe'],
            [['agreements'],'string'],
            [['agreements'],'safe'],
            [['organization'],'string'],
            [['organization'],'safe'],
            [['curator','executor'],'safe'],
            [['curator','executor'],'string'],
            [['id', 'agreement_id'], 'integer'],
            [['number', 'date', 'subject', 'resource_path', 'note'], 'safe'],
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
        $query = AdditionalAgreements::find()->where(['agreement_id'=>Agreements::find()->select('id')->where(['program_id'=>$_SESSION['program_id']])]);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([

            'defaultOrder' => [
                'date' => SORT_ASC,
            ],
            'attributes' => [
                'number' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],
                'date' => [
                    'asc' => ['date' => SORT_ASC],
                    'desc' => ['date' => SORT_DESC],
                ],
                'agreements' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],
                'curator' => [
                    'asc' => ['last_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC],
                ],

                'executor' =>[
                    'asc' => ['first_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC],
                ]

            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $table_agreement = Agreements::tableName();
        $table_curator = UserProfile::tableName();
        $table_executor = UserProfile::tableName();
        $table_additional = AdditionalAgreements::tableName();
        //$table_organization = Organizations::tableName();


           // echo $this->curator;
           // echo $this->executor;
           // $query->joinWith('userprofile');
            $query->andFilterWhere(['like', $table_curator.'.last_name', $this->curator]);
            $query->andFilterWhere(['like', $table_executor.'.last_name', $this->executor]);


        // grid filtering conditions
        $query->andFilterWhere([
            $table_additional .'.date' => $this->date,
        ]);
        $query->andFilterWhere(['like', $table_additional.'.number', $this->number]);
        $query->joinWith('agreements');
        $query->andFilterWhere(['like', $table_agreement . '.number', $this->agreements]);


//        if(!empty($this->agreement)) {
//            if(ctype_digit($this->agreement)) {
//                $query->joinWith('agreements');
//                $query->andFilterWhere(['like', $table_agreement . '.number', $this->agreements]);
//            }
//            else{
//                $query->joinWith('organization');
//                $query->andFilterWhere(['like', $table_organization . '.shortname', $this->organization]);
//            }


        return $dataProvider;
    }
}
