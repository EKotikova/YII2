<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_source".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $value
 */
class Source extends ActiveRecord
{
    /**
     * {@inheritdoc}
     *
     */
    public static function tableName()
    {
        return 'tbl_source';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name','value'],'required', 'message'=>'Значение является обязательным и не может быть пустым'],
            [['name', 'value'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', ' Пораметр'),
            'value' => Yii::t('app', 'Значение') ,
        ];
    }

    public static function getCity(){
        $city = ArrayHelper::map(Source::find()->select(['id','value'])->where(['name'=>'city'])->distinct()->all(),'id','value');
        return  $city;
    }

    public static function getDegree(){
        $degree = ArrayHelper::map(Source::find()->select(['id','value'])->where(['name'=>'degree'])->distinct()->all(),'id','value');
        return  $degree;
    }

    public static function listSourceName(){
       
        return array_unique(ArrayHelper::map(Source::find()->distinct(true)->select(['id','name'])->all(),'id','name'));
    }


}
