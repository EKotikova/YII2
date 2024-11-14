<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_programs".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $note
 */
class Programs extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_programs';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['note'], 'string'],
            [['name'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => Yii::t('app', 'Наименование программ'),
            'date_start' => Yii::t('app', 'Дата начала'),
            'date_end' => Yii::t('app', 'Дата окончания'),
            'note' => Yii::t('app', 'Примечание'),
        ];
    }

    public static function getProgram(){
        return ArrayHelper::map(Programs::find()->all(),'id','name');
    }
}
