<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\UserProfile;
use yii\data\Pagination;
use yii\web\UploadedFile;
use app\models\Participants;
/**
 * SearchUserProfile represents the model behind the search form of `app\models\UserProfile`.
 */
class SearchUserProfile extends UserProfile
{
    public string $last_name_first_name_middle_name='';
    public string $organization='';
    public string $source_deg='';
    public string $source_city='';
    public $image;
    public $country_name;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            //[['organization_id']]
            [['organization'],'safe'],
            [['organization'],'string'],
            [['last_name_first_name_middle_name'],'string'],
            [['id', 'user_id', 'is_reviewing_books', 'is_disertation', 'is_assessment_of_projects'], 'integer'],
            [['first_name', 'last_name', 'middle_name', 'emails', 'mobile_phone', 'other_phone', 'fax', 'degree', 'position', 'image_path', 'post_code', 'country', 'city', 'address', 'web_site', 'progress', 'expertise', 'experience'], 'safe'],
            [['image'],'file','extensions'=>'png,jpg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload(){

        if($this->validate()){
            var_dump($this->validate());
            $this->image->saveAs("uploads/{$this->image->baseName}.{$this->image->extension}");
        }
        else{
            return false;
        }
    }
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
        $query = UserProfile::find()->andwhere(['user_id'=>Participants::getListUserID($_GET['participants_type_id'])]);

        //$pages = new Pagination(['totalCount'=>$query->count(), 'pageSize'=>6]);

        // add conditions that should always apply here

        $query->joinWith('organization');

        $query->joinWith('source_deg');

        $query->joinWith('source_city');

        $query->joinWith('country_name');


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
           // 'pagination'=>$pages,

        ]);
        $dataProvider->setSort([
            'attributes' => [
                'organization' => [
                    'asc' => ['fullname' => SORT_ASC],
                    'desc' => ['fullname' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'emails' => [
                    'asc' => ['emails' => SORT_ASC],
                    'desc' => ['emails' => SORT_DESC],
                    'default' => SORT_ASC,
                ],
                'last_name_first_name_middle_name' =>[
                    'asc' => ['last_name' => SORT_ASC],
                    'desc' => ['last_name' => SORT_DESC],
                    'default' => SORT_ASC,

                ]

            ],
        ]);


        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
       /* $query->andFilterWhere([
            'id' => $this->id,
            'user_id' => $this->user_id,
            'organization_id' =>$this->organization_id,
            'is_reviewing_books' => $this->is_reviewing_books,
            'is_disertation' => $this->is_disertation,
            'is_assessment_of_projects' => $this->is_assessment_of_projects,
        ]);*/


        $query->andFilterWhere(['like','fullname',$this->organization]);
        $query->andFilterWhere(['like','first_name',$this->last_name_first_name_middle_name])
            ->orFilterWhere(['like','last_name',$this->last_name_first_name_middle_name])
            ->orFilterWhere(['like','middle_name',$this->last_name_first_name_middle_name]);

        if(isset($this->emails)) {
            $tbl_name = UserProfile::tableName();
            $query->andFilterWhere(['like', $tbl_name.'.emails', $this->emails]);
        }


       /* $query->andFilterWhere(['like', 'emails', $this->emails])
            ->andFilterWhere(['like', 'mobile_phone', $this->mobile_phone])
            ->andFilterWhere(['like', 'other_phone', $this->other_phone])
            ->andFilterWhere(['like', 'fax', $this->fax])
            ->andFilterWhere(['like', 'degree', $this->degree])
            ->andFilterWhere(['like', 'position', $this->position])
            ->andFilterWhere(['like', 'image_path', $this->image_path])
            ->andFilterWhere(['like', 'post_code', $this->post_code])
            //->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like','address',$this->address])
            ->andFilterWhere(['like', 'web_site', $this->web_site])
            ->andFilterWhere(['like', 'progress', $this->progress])
            ->andFilterWhere(['like', 'expertise', $this->expertise])
            ->andFilterWhere(['like', 'experience', $this->experience]);*/

        return $dataProvider;
    }
}
