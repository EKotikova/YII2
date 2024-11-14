<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_rubrics_mapping".
 *
 * @property int $id
 * @property int $id_rubric
 * @property int $id_entity
 * @property string $type_entity
 */
class RubricsMapping extends \yii\db\ActiveRecord
{
    const ENTITY_AGREEMENT = 'agreement';
    const ENTITY_EXPERT = 'expert';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_rubrics_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_rubric', 'id_entity', 'type_entity'], 'required'],
            [['id_rubric', 'id_entity'], 'integer'],
            [['type_entity'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'id_rubric' => Yii::t('app', 'Id Rubric'),
            'id_entity' => Yii::t('app', 'Id Entity'),
            'type_entity' => Yii::t('app', 'Type Entity'),
        ];
    }


}


