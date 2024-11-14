<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_country".
 *
 * @property int $id
 * @property string $name
 */
class Country extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_country';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'номер'),
            'name' => Yii::t('app', 'Наименование'),
        ];
    }

    public static function getCountry(){
        return ArrayHelper::map(Country::find()->select(['id','name'])->all(),'id','name');

    }
}
