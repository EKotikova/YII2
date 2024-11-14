<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_cost_creating_maps".
 *
 * @property int $id
 * @property int|null $map_id
 * @property string|null $year
 * @property float|null $finance_sg
 * @property float|null $finance_rb
 * @property float|null $finance_rf
 * @property float|null $finance_other
 *
 * @property MapPropertyRecords $map
 */
class CostCreatingMaps extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_cost_creating_maps';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['map_id'], 'integer'],
            [['year'], 'safe'],
            [['finance_sg', 'finance_rb', 'finance_rf', 'finance_other'], 'number'],
            [['map_id'], 'exist', 'skipOnError' => true, 'targetClass' => MapPropertyRecords::class, 'targetAttribute' => ['map_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'map_id' => Yii::t('app', 'Map ID'),
            'year' => Yii::t('app', 'Год'),
            'finance_sg' => Yii::t('app', 'Средства бюджета СГ'),
            'finance_rb' => Yii::t('app', 'Средства бюджета РБ'),
            'finance_rf' => Yii::t('app', 'Средства бюджета РФ'),
            'finance_other' => Yii::t('app', 'Иные источники финансирования'),
        ];
    }

    /**
     * Gets query for [[Map]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMap()
    {
        return $this->hasOne(MapPropertyRecords::class, ['id' => 'map_id']);
    }
}
