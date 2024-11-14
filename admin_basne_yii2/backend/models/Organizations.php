<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use app\models\Source;
use yii\helpers\ArrayHelper;
/**
 * This is the model class for table "tbl_organizations".
 *
 * @property int $id
 * @property string|null $fullname
 * @property string|null $shortname
 * @property string|null $requisite
 * @property string|null $post_code
 * @property string|null $city
 * @property string|null $adress
 * @property string|null $phone
 * @property string|null $emails
 * @property string|null $post
 * @property string|null $chief
 * @property string|null $note
 */

class Organizations extends ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    

    public static function tableName()
    {
        return 'tbl_organizations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fullname','shortname'],'required','message'=>'Значение является обязательным и не может будет  пустым'],
            [['emails'],'email','message'=>"{attribute} введен в некорректном формате"],
            [['requisite','post_code','city','adress','phone','emails','post','chief','note'],'safe'],
            [['requisite', 'note'], 'string'],
            [['fullname', 'shortname', 'adress', 'emails'], 'string', 'max' => 250],
            [['post_code'], 'string', 'max' => 50],
            [['city', 'phone', 'post', 'chief'], 'string', 'max' => 100],
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
            'requisite' => Yii::t('app', 'Реквизиты'),
            'post_code' => Yii::t('app', 'Почтовый код'),
            'city' => Yii::t('app', 'Город'),
            'adress' => Yii::t('app', 'Адрес'),
            'phone' => Yii::t('app', 'Телефон'),
            'emails' => Yii::t('app', 'e-mail'),
            'post' => Yii::t('app', 'Должность'),
            'chief' => Yii::t('app', 'Руководитель'),
            'note' => Yii::t('app', 'Примечание'),
        ];
    }


    public function getSource(){
        return $this->hasOne(Source::className(),['id'=>'city']);
    }

    public function getListIdOrganizationforProgram(){
        return $this->hasMany(OrganizationProgramMapping::class,['organization_id'=>'id'])
            ->onCondition(["program_id"=>$_SESSION['program_id']]);
    }

    public static function getOrganization(){
      return  ArrayHelper::map(Organizations::find()->select(['id','shortname'])->
      orderBy(['shortname'=>SORT_ASC])->
      where(['id'=>OrganizationProgramMapping::find()->select(['organization_id'])->
      where(['program_id'=>$_SESSION['program_id']])])->distinct()->all(),'id','shortname');
    }


}
