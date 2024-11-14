<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\MapPropertyRecords;

/**
 * SeachMapPropertyRecords represents the model behind the search form of `app\models\MapPropertyRecords`.
 */
class SeachMapPropertyRecords extends MapPropertyRecords
{
    public string $curator='';
    public string $agreement_number = '';
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'kod_egr', 'count'], 'integer'],
            [['fullname', 'characterization', 'area', 'create_than', 'date_acquisition', 'using', 'resource_path',], 'safe'],
            [['agreement_number'],'safe'],
            [['agreement_number'],'string'],
            [['curator'],'safe'],
            [['curator'],'string']
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
        $query = MapPropertyRecords::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->setSort([
            'attributes' => [
                'kod_egr' => [
                    'asc' => ['kod_egr' => SORT_ASC],
                    'desc' => ['kod_egr' => SORT_DESC],
                ],
                'fullname' => [
                    'asc' => ['fullname' => SORT_ASC],
                    'desc' => ['fullname' => SORT_DESC],
                ],

                'characterization' => [
                    'asc' => ['characterization' => SORT_ASC],
                    'desc' => ['characterization' => SORT_DESC],
                ],
                'agreement_number' => [
                    'asc' => ['agreement_id' => SORT_ASC],
                    'desc' => ['agreement_id' => SORT_DESC],
                ],
                'date_acquisition' => [
                    'asc' => ['date_acquisition' => SORT_ASC],
                    'desc' => ['date_acquisition' => SORT_DESC],
                ],
                'curator' => [
                    'asc' => ['last_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $table_curator = UserProfile::tableName();

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'kod_egr' => $this->kod_egr,
            'count' => $this->count,
            'date_acquisition' => $this->date_acquisition,
        ]);

        if(isset($_SESSION['program_id'])) {
            $query->joinWith('agreement')->where(['program_id'=>$_SESSION['program_id']]);
        }
        $query->andFilterWhere(['like','number',$this->agreement_number]);
        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'characterization', $this->characterization])
            ->andFilterWhere(['like', 'area', $this->area])
            ->andFilterWhere(['like', 'create_than', $this->create_than])
            ->andFilterWhere(['like', 'using', $this->using])
            ->andFilterWhere(['like', 'resource_path', $this->resource_path]);

        $query->leftJoin('tbl_user_profile',['tbl_user_profile.id'=>$this->getCuratorid()])
            ->andFilterWhere(['AND',['like', 'last_name', $this->curator]]);
        //$query->leftJoin('tbl_user_profile', ['tbl_user_profile.id' =>$this->getCuratorid()])->andFilterWhere(['like', 'last_name', $this->curator]);

        return $dataProvider;
    }
}
