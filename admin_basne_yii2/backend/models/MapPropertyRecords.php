<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_map_property_records".
 *
 * @property int $id
 * @property int|null $kod_egr
 * @property string|null $fullname
 * @property int|null $count
 * @property string|null $characterization
 * @property string|null $area
 * @property int $agreement_id
 * @property string|null $create_than
 * @property string|null $date_acquisition
 * @property string|null $using
 * @property string|null $resource_path
 *
 * @property Agreements $agreement
 */
class MapPropertyRecords extends \yii\db\ActiveRecord
{
    public $files;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_map_property_records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kod_egr', 'count', 'agreement_id'], 'integer'],
            [['agreement_id'], 'required'],
            [['date_acquisition'], 'safe'],
            [['fullname', 'characterization'], 'string', 'max' => 1000],
            [['area', 'create_than', 'using'], 'string', 'max' => 255],
            [['resource_path'], 'string', 'max' => 150],
            [['agreement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agreements::class, 'targetAttribute' => ['agreement_id' => 'id']],
            //[['curator'],'safe']
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kod_egr' => Yii::t('app', 'Учетный номер плательщика'),
            'fullname' => Yii::t('app', 'Наименование имущества'),
            'count' => Yii::t('app', 'Количество(ед.)'),
            'characterization' => Yii::t('app', 'Характеристика, назначение имущества'),
            'area' => Yii::t('app', 'Место нахождения имущества'),
            'agreement_id' => Yii::t('app', 'Договор'),
            'create_than' => Yii::t('app', 'Имущество создано (приобретено)'),
            'date_acquisition' => Yii::t('app', 'Дата создания (приобретения) имущества'),
            'using' => Yii::t('app', 'Использование  имущества'),
            'resource_path' => Yii::t('app', 'Файл имущества'),
            'files' => Yii::t('app', 'Файл имущества'),

        ];
    }

    /**
     * Gets query for [[Agreement]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasmany(Agreements::class, ['id' => 'agreement_id']);
    }

    public function getCostcreatingmaps(){

        return $this->hasMany(CostCreatingMaps::class,['map_id'=>'id']);
    }

    public function  getCuratorid()
    {   foreach ($this->agreement as $item) {
        return $item->curator_id;
    }
    }

    public function getCuratorname(){

        return UserProfile::find()->select('name')->where(['id'=>$this->getCuratorid()])->all();
    }


    public static function getAgreementNumber(){
        if(!empty($_SESSION['program_id'])) {
            $number = ArrayHelper::map(Agreements::find()->select(['id', 'number'])->where(['program_id' => $_SESSION['program_id']])->all(), 'id', 'number');
        }
        else{
            $number = ArrayHelper::map(Agreements::find()->select(['id', 'number'])->all(), 'id', 'number');
        }
        return $number;
    }


}
