<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_agreements_bp".
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property int $id_organization_lender
 * @property int $id_organization_recipient
 * @property int $id_agreements
 * @property string|null $list
 * @property string|null $agreement_path
 * @property string|null $list_path
 *
 * @property AdditionalAgreementsbp[] $tblAdditionalAgreementsbps
 */
class AgreementsBp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_agreements_bp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'number', 'date', 'id_organization_lender', 'id_organization_recipient', 'id_agreements'], 'required'],
            [['id', 'id_organization_lender', 'id_organization_recipient', 'id_agreements'], 'integer'],
            [['date'], 'safe'],
            [['list'], 'string'],
            [['number', 'agreement_path', 'list_path'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', 'Номер договора БП*'),
            'date' => Yii::t('app', 'Дата'),
            'id_organization_lender' => Yii::t('app', 'Организация-Ссудодатель*'),
            'id_organization_recipient' => Yii::t('app', 'Организация-Ссудополучатель*'),
            'id_agreements' => Yii::t('app', 'Договор о создании НТП*'),
            'list' => Yii::t('app', 'Перечень имущества, передаваемого в БП'),
            'agreement_path' => Yii::t('app', 'Договор БП (pdf)'),
            'list_path' => Yii::t('app', 'Перечень (pdf)'),
        ];
    }

    /**
     * Gets query for [[TblAdditionalAgreementsbps]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalAgreementsbps()
    {
        return $this->hasMany(AdditionalAgreementsbp::class, ['agreementbp_id' => 'id']);
    }

    public function getLender(){
        return $this->hasone(OrganizationBp::class,['id'=>'id_organization_lender']);
    }
    public function getPrecipient(){
        return $this->hasone(OrganizationBp::class,['id'=>'id_organization_recipient']);

    }
    public function getAgreement()
    {
        return $this->hasmany(Agreements::class, ['id' => 'id_agreements']);
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

    public static function getlistLender(){
        return ArrayHelper::map(OrganizationBp::find()->select(['id','shortname'])->where(['id'=>self::getlistLender()])->all(),'id','shortname');
    }
    public static function getlistPrecipient(){
        return ArrayHelper::map(OrganizationBp::find()->select(['id','shortname'])->where(['id'=>self::getlistPrecipient()])->all(),'id','shortname');
    }
}
