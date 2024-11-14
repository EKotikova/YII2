<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_additional_agreementsbp".
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property string|null $subject
 * @property int $agreementbp_id
 * @property string|null $resource_path
 * @property string|null $list_path
 *
 * @property AgreementsBp $agreementbp
 */
class AdditionalAgreementsbp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_additional_agreementsbp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'date', 'agreementbp_id'], 'required'],
            [['date'], 'safe'],
            [['subject'], 'string'],
            [['agreementbp_id'], 'integer'],
            [['number'], 'string', 'max' => 50],
            [['resource_path', 'list_path'], 'string', 'max' => 150],
            [['agreementbp_id'], 'exist', 'skipOnError' => true, 'targetClass' => AgreementsBp::class, 'targetAttribute' => ['agreementbp_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Номер ДС к договору БП*'),
            'date' => Yii::t('app', 'Дата*'),
            'subject' => Yii::t('app', 'Перечень имущества, передаваемого в БП'),
            'agreementbp_id' => Yii::t('app', 'Договор БП*'),
            'resource_path' => Yii::t('app', 'ДС (pdf)'),
            'list_path' => Yii::t('app', 'Перечень (pdf)'),
        ];
    }

    /**
     * Gets query for [[Agreementbp]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgreementbp()
    {
        return $this->hasmany(AgreementsBp::class, ['id' => 'agreementbp_id']);
    }
}
