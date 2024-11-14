<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_arangements".
 *
 * @property int $id
 * @property string|null $number
 * @property string|null $name
 * @property string|null $note
 * @property int $direction_id
 *
 * @property Directions $direction
 */
class Arangements extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_arangements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'note'], 'string'],
            [['direction_id','name','direction_id'], 'required'],
            [['direction_id'], 'integer'],
            [['number'], 'string', 'max' => 50],
            [['direction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Directions::class, 'targetAttribute' => ['direction_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', '№ мероприятия'),
            'name' => Yii::t('app', 'Название мероприятия'),
            'note' => Yii::t('app', 'Примечание'),
            'direction_id' => Yii::t('app', '№ направления'),
        ];
    }

    /**
     * Gets query for [[Direction]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDirection()
    {
        return $this->hasMany(Directions::class, ['id' => 'direction_id']);
    }

    public  function  getArangements(){
        return $this->hasMany(ArangementAgreementMapping::class,['arangement_id' => 'id']);
    }

    public static function listNumberArangement(){
        return ArrayHelper::map(Arangements::find()->distinct(true)->select(['id','number'])
            ->where(['direction_id'=>Directions::find()->select(['id'])
                ->where(['program_id'=>$_SESSION['program_id']])])->all(),'id','number');
    }


}
