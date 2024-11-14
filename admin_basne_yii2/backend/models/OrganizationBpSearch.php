<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\OrganizationBp;
use yii\data\Pagination;

/**
 * OrganizationBpSearch represents the model behind the search form of `app\models\OrganizationBp`.
 */
class OrganizationBpSearch extends OrganizationBp
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['fullname', 'shortname', 'chief', 'requisite', 'adress'], 'safe'],
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
        $table_organization_bp =OrganizationBp::tableName();
        $query = OrganizationBp::find()->where([$table_organization_bp.'.id'=>OrganizationProgramMapping::find()->select('organization_id')->where(['program_id'=>$_SESSION['program_id']])]);
        $pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>10]);


        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination'=>$pages,
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
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'shortname', $this->shortname])
            ->andFilterWhere(['like', 'chief', $this->chief])
            ->andFilterWhere(['like', 'requisite', $this->requisite])
            ->andFilterWhere(['like', 'adress', $this->adress]);

        return $dataProvider;
    }
}
