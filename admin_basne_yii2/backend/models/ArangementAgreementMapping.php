<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_arangement_agreement_mapping".
 *
 * @property int $id
 * @property int $arangement_id
 * @property int $agreement_id
 *
 * @property Agreements $agreement
 * @property Arangements $arangement
 */
class ArangementAgreementMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_arangement_agreement_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['arangement_id', 'agreement_id'], 'required'],
            [['arangement_id', 'agreement_id'], 'integer'],
            [['agreement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agreements::class, 'targetAttribute' => ['agreement_id' => 'id']],
            [['arangement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Arangements::class, 'targetAttribute' => ['arangement_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'arangement_id' => Yii::t('app', 'Меропритие'),
            'agreement_id' => Yii::t('app', 'Договор'),
        ];
    }

    /**
     * Gets query for [[Agreement]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgreements()
    {
        return $this->hasmany(Agreements::class, ['id' => 'agreement_id']);
    }

    /**
     * Gets query for [[Arangement]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArangement()
    {
        return $this->hasOne(Arangements::class, ['id' => 'arangement_id']);
    }
}
