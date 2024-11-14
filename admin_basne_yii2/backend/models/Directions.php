<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_directions".
 *
 * @property int $id
 * @property string|null $number
 * @property string|null $name
 * @property string|null $note
 * @property int $program_id
 *
 * @property Arangements[] $tblArangements
 */
class Directions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_directions';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number','name','program_id'],'required', 'message' => 'Значение является обязательным и не может быть пустым'],
            [['name', 'note'], 'string'],
            [['program_id'], 'required'],
            [['program_id'], 'integer'],
            [['number'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', '№ направления'),
            'name' => Yii::t('app', 'Названия направления'),
            'note' => Yii::t('app', 'Примечание'),
            'program_id' => Yii::t('app', 'программа'),
        ];
    }

    /**
     * Gets query for [[TblArangements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArangements()
    {
        return $this->hasMany(Arangements::class, ['direction_id' => 'id']);
    }

    public function getProgram(){

        return $this->hasOne(Programs::class,['id'=>'program_id']);
    }


    public static function getDerecNumber(){
        return ArrayHelper::map(Directions::find()->distinct()->select(['id','number'])->where(['program_id'=>$_SESSION['program_id']])->all(),'id','number');
    }
}
