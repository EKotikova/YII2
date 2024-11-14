<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_organization_bp".
 *
 * @property int $id
 * @property string $fullname
 * @property string $shortname
 * @property string|null $chief
 * @property string|null $requisite
 * @property string|null $adress
 */
class OrganizationBp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_organizations_bp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname', 'shortname'], 'required'],
            [['requisite'], 'string'],
            [['fullname', 'shortname', 'adress'], 'string', 'max' => 250],
            [['chief'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'fullname' => Yii::t('app', 'Полное наименование'),
            'shortname' => Yii::t('app', 'Сокрощенное наименование'),
            'chief' => Yii::t('app', 'Руководитель'),
            'requisite' => Yii::t('app', 'Реквизиты'),
            'adress' => Yii::t('app', 'Адресс'),
        ];
    }
}
