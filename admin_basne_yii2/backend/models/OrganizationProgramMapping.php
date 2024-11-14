<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_organization_program_mapping".
 *
 * @property int $id
 * @property int $program_id
 * @property int $organization_id
 */
class OrganizationProgramMapping extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_organization_program_mapping';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_id', 'organization_id'], 'required'],
            [['program_id', 'organization_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'program_id' => Yii::t('app', 'Программа'),
            'organization_id' => Yii::t('app', 'Организация'),
        ];
    }

    public function getOrganizationMapping(){
        return $this->hasMany(Organizations::class,['id'=>'organization_id']);
    }
}
