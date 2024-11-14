<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_additional_agreements".
 *
 * @property int $id
 * @property string|null $number
 * @property string|null $date
 * @property string|null $subject
 * @property string|null $resource_path
 * @property string|null $note
 * @property int $agreement_id
 */
class AdditionalAgreements extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_additional_agreements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date'], 'safe'],
            [['subject', 'note'], 'string'],
            [['agreement_id','number','date'], 'required'],
            [['agreement_id'], 'integer'],
            [['number'], 'string', 'max' => 50],
            [['resource_path'], 'string', 'max' => 150],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', '№ доп. соглашения'),
            'date' => Yii::t('app', 'Дата'),
            'subject' => Yii::t('app', 'Предмет заключения'),
            'resource_path' => Yii::t('app', 'Электронная копия'),
            'note' => Yii::t('app', 'Примечание'),
            'agreement_id' => Yii::t('app', 'Договор'),
        ];
    }


    public function getAgreements(){
        return $this->hasMany(Agreements::class,['id'=>'agreement_id']);
    }

    public function getOrganization()
    {
        return $this->hasOne(Organizations::class, ['id' => 'organization_id']);
    }

    public function getCurator()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'curator_id']);
    }

    public function getExecutor()
    {
        return $this->hasOne(UserProfile::class, ['id' => 'executor_id']);
    }

    public function getCalendarPlans(){
        return $this->hasMany(CalendarPlans::class,['add_agrement_id'=>'id']);
    }




}
