<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\CalendarPlans;
use yii\data\Pagination;

/**
 * CalendarPlansSearch represents the model behind the search form of `app\models\CalendarPlans`.
 */
class CalendarPlansSearch extends CalendarPlans
{
    public string $agreements='';
    public string $additionalAgreements='';
    public string $curator='';
    public string $executor='';

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['additionalAgreements'],'string'],
            [['additionalAgreements'],'safe'],
            [['agreements'],'string'],
            [['agreements'],'safe'],
            [['curator','executor'],'safe'],
            [['curator','executor'],'string'],
            [['id', 'agreement_id', 'add_agrement_id', 'is_has_aktT', 'is_has_aktE'], 'integer'],
            [['step_number', 'date_start', 'date_end', 'report', 'aktt_path', 'akte_path', 'aktt_year_path', 'reportf_path', 'phase', 'excerpt_number', 'date_excerpt', 'excerpt_path', 'date_notification', 'notification_path', 'note'], 'safe'],
            [['price'], 'number'],
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
        $table_calendar_plans = CalendarPlans::tableName();
        $query = CalendarPlans::find()->where([$table_calendar_plans.'.agreement_id'=>Agreements::find()->select(['id'])->where(['program_id'=>$_SESSION['program_id']])]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([

            'defaultOrder' => [
                'date_start' => SORT_ASC,
            ],
            'attributes' => [
                'date_start' => [
                    'asc' => ['date_start' => SORT_ASC],
                    'desc' => ['date_start' => SORT_DESC],
                ],
                'date_end' => [
                    'asc' => ['date_end' => SORT_ASC],
                    'desc' => ['date_end' => SORT_DESC],
                ],
               /* 'agreement' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],*/
             /*   'addAgrement' => [
                    'asc' => ['number' => SORT_ASC],
                    'desc' => ['number' => SORT_DESC],
                ],*/
                'step_number' => [
                    'asc' => ['step_number' => SORT_ASC],
                    'desc' => ['step_number' => SORT_DESC],
                ],
               /* 'curator' => [
                    'asc' => ['last_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC],
                ],

                'executor' =>[
                    'asc' => ['first_name' => SORT_ASC],
                    'desc' => ['first_name' => SORT_DESC],
                ]*/

            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }


        $table_agreement = Agreements::tableName();
        $table_add_agreement = AdditionalAgreements::tableName();
        $table_executor = UserProfile::tableName();

        $query->joinWith('agreements');
        $query->joinWith('additionalAgreements');

        // grid filtering conditions
       /* $query->andFilterWhere([
            'id' => $this->id,
            'agreement_id' => $this->agreement_id,
            'add_agrement_id' => $this->add_agrement_id,
            'date_start' => $this->date_start,
            'date_end' => $this->date_end,
            'is_has_aktT' => $this->is_has_aktT,
            'is_has_aktE' => $this->is_has_aktE,
            'price' => $this->price,
            'date_excerpt' => $this->date_excerpt,
            'date_notification' => $this->date_notification,
        ]);*/

        $query->andFilterWhere(['like', 'step_number', $this->step_number])
            ->andFilterWhere(['like', $table_agreement.'.number', $this->agreements])
            ->andFilterWhere(['like', $table_add_agreement.'.number', $this->additionalAgreements])
           // ->andFilterWhere(['like', 'last_name', $this->curator])
            ->andFilterWhere(['like', $table_executor.'.last_name', $this->executor])
            ->andFilterWhere(['like', 'report', $this->report]);
           /* ->andFilterWhere(['like', 'aktt_path', $this->aktt_path])
            ->andFilterWhere(['like', 'akte_path', $this->akte_path])
            ->andFilterWhere(['like', 'aktt_year_path', $this->aktt_year_path])
            ->andFilterWhere(['like', 'reportf_path', $this->reportf_path])
            ->andFilterWhere(['like', 'phase', $this->phase])
            ->andFilterWhere(['like', 'excerpt_number', $this->excerpt_number])
            ->andFilterWhere(['like', 'excerpt_path', $this->excerpt_path])
            ->andFilterWhere(['like', 'notification_path', $this->notification_path])
            ->andFilterWhere(['like', 'note', $this->note]);*/

        return $dataProvider;
    }
}
