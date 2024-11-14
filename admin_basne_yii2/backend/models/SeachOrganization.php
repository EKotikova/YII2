<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Organizations;
use yii\data\Pagination;

/**
 * SeachOrganization represents the model behind the search form of `app\models\Organizations`.
 */
class SeachOrganization extends Organizations
{
    public $source;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            //[['program_id'], 'integer'],
            [['fullname', 'shortname', 'requisite', 'phone', 'emails', 'post', 'chief', 'note'], 'safe'],
            [['source'],'safe'],

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

        (isset($_SESSION['program_id']))? $program_id = $_SESSION['program_id'] : $program_id="";
       $table_organization =Organizations::tableName();
       $query = Organizations::find()->where([$table_organization.'.id'=>OrganizationProgramMapping::find()->select('organization_id')->where(['program_id'=>$program_id])]);

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

        $query->joinWith('source');

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'shortname', $this->shortname])
            ->andFilterWhere(['like', 'requisite', $this->requisite])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'emails', $this->emails])
            ->andFilterWhere(['like', 'post', $this->post])
            ->andFilterWhere(['like', 'chief', $this->chief])
            ->andFilterWhere(['like', 'note', $this->note]);

        return $dataProvider;
    }
}
