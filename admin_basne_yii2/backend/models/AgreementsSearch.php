<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Agreements;
use yii\data\Pagination;
use app\models\Organizations;

/**
 * AgreementsSearch represents the model behind the search form of `app\models\Agreements`.
 */
class AgreementsSearch extends Agreements
{

    public string $organization='';
    public string $curator_last_name ='';
    //public string $agreement_rubric = '';
    public string $executor_last_name = '';
    public string $programs = '';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [

            [['programs'],'safe'],
            [['programs'],'string'],
            [['agreement_rubric'],'safe'],
            [['agreement_rubric'],'string'],
            [['arangement'],'safe'],
            [['arangement'],'string'],
            [['organization','curator_last_name','executor_last_name'],'safe'],
            [['organization','executor_last_name','curator_last_name'],'string'],
            [['id', 'organization_id', 'curator_id', 'executor_id', 'program_id', 'accomplice', 'renegotiation'], 'integer'],
            [['number', 'date', 'title', 'theme', 'additional_information', 'zadanie_path', 'techzad_path', 'note'], 'safe'],

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
        if(isset($_SESSION['program_id'])) {
            $query = Agreements::find()->where(['program_id' => $_SESSION['program_id']]);
        }
        else{
            $query = Agreements::find();
        }
       // $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>10]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination'=>$pages,
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
                'title' => [
                    'asc' => ['title' => SORT_ASC],
                    'desc' => ['title' => SORT_DESC],
                ],
                'organization' => [
                    'asc' => ['fullname' => SORT_ASC],
                    'desc' => ['fullname' => SORT_DESC],
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

        $query->joinWith('organization');
        //$query->joinWith('curator');
        //$query->joinWith('executor');
        $query->joinWith('programs');
        $query->joinWith(['curator'=>function($query) {$query->from(['curator'=>'tbl_user_profile']);}]);
        $query->joinWith(['executor'=>function($query) {$query->from(['executor'=>'tbl_user_profile']);}]);


        $table_rubric = Rubrics::tableName();
        //$table_programs = Programs::tableName();
        $table_arangement = Arangements::tableName();
        $userprofile = UserProfile::tableName();

       // $query->andFilterWhere(['like',$userprofile.'.last_name',$this->executor]);


        $query->andFilterWhere(['like',$table_rubric.' .agreement_rubric.name',$this->agreement_rubric]);
       $query->andFilterWhere(['like',$table_arangement.' .arangement',$this->arangement]);

        //$query->andFilterWhere(['like','last_name',$this->curator_last_name]);
       // $query->andFilterWhere(['like','last_name',$this->executor_last_name]);
        $query->andFilterWhere(['like', 'number', $this->number])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like','fullname',$this->organization])
            ->andFilterWhere(['like', 'theme', $this->theme])
            ->andFilterWhere(['like', 'additional_information', $this->additional_information])
            ->andFilterWhere(['like', 'resource_path', $this->resource_path])
            ->andFilterWhere(['like', 'zadanie_path', $this->zadanie_path])
            ->andFilterWhere(['like', 'techzad_path', $this->techzad_path])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
