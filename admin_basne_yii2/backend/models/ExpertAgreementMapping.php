<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_expert_agreement_mapping".
 *
 * @property int $id
 * @property int $user_id
 * @property int $agreement_id
 *
 * @property Agreements $agreement
 * @property User $user
 */
class ExpertAgreementMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_expert_agreement_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'agreement_id'], 'required'],
            [['user_id', 'agreement_id'], 'integer'],
            [['agreement_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agreements::class, 'targetAttribute' => ['agreement_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'agreement_id' => Yii::t('app', 'Agreement ID'),
        ];
    }

    /**
     * Gets query for [[Agreement]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgreement()
    {
        return $this->hasOne(Agreements::class, ['id' => 'agreement_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
