<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_rubrics".
 *
 * @property int $id
 * @property string $code
 * @property string|null $name
 * @property int $parent_id
 */
class Rubrics extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_rubrics';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','code'],'required', 'message' => 'Значение является обязательным и не может быть пустым'],
            [['code'], 'required'],
            [['parent_id'], 'integer'],
            [['code'], 'string', 'max' => 45],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'code' => Yii::t('app', 'Код'),
            'name' => Yii::t('app', 'Наименование'),
            'parent_id' => Yii::t('app', 'Код родительской рубрики'),
        ];
    }

    public function getRubricsP(){

        return $this->hasMany(Rubrics::class,['parent_id' => 'id']);
    }



    public function getfullName(){

        return $this->code.' '.$this->name;
    }

    public static function parentRubric(){
        return Rubrics::find()->select(['id','code'])->orderBy(['id'=>SORT_DESC])->limit('3')->offset('231')->all();
    }

    public static  function listidRubric($code){
        return Rubrics::find()->select(['code','id'])->andWhere(['like','code',$code])->all();
    }

    public static function  getParent_rubric(){
        $result = [];
        $parent_rubric = self::parentRubric();
        foreach ($parent_rubric as $value) {
           $listIdRubric=self::listidRubric($value['code']);
           foreach ($listIdRubric as $item){
                   $result += ArrayHelper::map(Rubrics::find()->select(['id', 'name', 'code'])->where(['id' => $item['id']])->all(), 'id', 'fullName');
          }
      }
      return $result;
   }

}


