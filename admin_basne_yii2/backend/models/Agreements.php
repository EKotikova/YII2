<?php

namespace app\models;

use Yii;
use app\models\Organizations;
use app\models\Rubrics;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;


/**
 * This is the model class for table "tbl_agreements".
 *
 * @property int $id
 * @property string $number
 * @property string $date
 * @property string|null $title
 * @property string|null $theme
 * @property int|null $organization_id
 * @property int|null $curator_id
 * @property int|null $executor_id
 * @property string|null $additional_information
 * @property string|null $resource_path
 * @property string|null $zadanie_path
 * @property string|null $techzad_path
 * @property string|null $note
 * @property int $program_id
 * @property int|null $accomplice
 * @property int|null $renegotiation
 *
 * @property User $curator
 * @property User $executor
 * @property Organizations $organization
 *
 * * @property string $files;
 * * @property string $zadanie;
 * * @property string $techzad;
 */
class Agreements extends \yii\db\ActiveRecord
{
    public $files;
    public $zadanie;
    public $techzad;
    public $arangement;
    public $agreement_rubric;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_agreements';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', 'date', 'program_id'], 'required'],
            [['date'], 'safe'],
            [['theme', 'additional_information'], 'string'],
            [['organization_id', 'curator_id', 'executor_id', 'program_id', 'accomplice', 'renegotiation'], 'integer'],
            [['number', 'resource_path', 'zadanie_path', 'techzad_path', 'note'], 'string', 'max' => 255],
            [['title'], 'string', 'max' => 1000],
            [['curator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['curator_id' => 'id']],
            [['executor_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['executor_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::class, 'targetAttribute' => ['organization_id' => 'id']],
            [['files'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['zadanie'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['techzad'], 'file', 'skipOnEmpty' => true, 'extensions' => 'pdf'],
            [['arangement'], 'safe'],
            [['arangement'], 'string'],
            //[['rubrics'],'safe'],
            [['agreement_rubric'], 'safe']

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'number' => Yii::t('app', '№ договора'),
            'date' => Yii::t('app', 'Дата'),
            'title' => Yii::t('app', 'Название'),
            'theme' => Yii::t('app', 'Тема'),
            'organization_id' => Yii::t('app', 'Организация-исполнитель'),
            'curator_id' => Yii::t('app', 'Куратор'),
            'executor_id' => Yii::t('app', 'Исполнитель'),
            'additional_information' => Yii::t('app', 'Дополнительная информация'),
            'resource_path' => Yii::t('app', 'Договор'),
            'files' => Yii::t('app', 'Договор'),
            'zadanie' => Yii::t('app', ' Задание'),
            'zadanie_path' => Yii::t('app', 'Задание'),
            'agreement_rubric' => Yii::t('app', 'Рубрика'),
            'techzad_path' => Yii::t('app', 'Техническое задание'),
            'techzad' => Yii::t('app', 'Техническое задание'),
            'note' => Yii::t('app', 'Прмечание'),
            'program_id' => Yii::t('app', 'Программа'),
            'accomplice' => Yii::t('app', 'Номер договора основного исполнителя'),
            'renegotiation' => Yii::t('app', 'Вместо расторгнутого'),
            'arangement' => Yii::t('app', 'Мероприятие'),
        ];
    }

    /**
     * Gets query for [[Curator]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCurator()
    {
        return $this->hasone(UserProfile::class, ['id' => 'curator_id']);
    }

    /**
     * Gets query for [[Executor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getExecutor()
    {
        return $this->hasone(UserProfile::class, ['id' => 'executor_id']);
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasone(Organizations::class, ['id' => 'organization_id']);
    }

    public function getPrograms()
    {
        return $this->hasMany(Programs::class, ['id' => 'program_id']);
    }

    public function getAccomplice()
    {
        return $this->hasMany(Agreements::class, ['id' => 'accomplice']);
    }

    public function getAdditionalAgreements()
    {
        return $this->hasMany(AdditionalAgreements::class, ['agreement_id' => 'id']);
    }

    public function getCalendarPlans()
    {
        return $this->hasMany(CalendarPlans::class, ['agreement_id' => 'id']);
    }

    public function getArangements()
    {
        return $this->hasMany(Arangements::class, ['id' => 'arangement_id'])
            ->viaTable('tbl_arangement_agreement_mapping', ['agreement_id' => 'id']);
    }

    public function getRubrics()
    {
        return $this->hasMany(Rubrics::class, ['id' => 'id_rubric'])
            ->onCondition('type_entity = "' . RubricsMapping::ENTITY_AGREEMENT . '"')
            ->viaTable('tbl_rubrics_mapping', ['id_entity' => 'id']);
    }


    public static function getListAccomplice()
    {

        $arrayAccomplice = ArrayHelper::map(Agreements::find()->select(['id', 'number'])->where(['program_id' => $_SESSION['program_id']])->all(), 'id', 'number');
        $arrayAccomplice += ['0' => 'основной договор'];
        return ArrayHelper::recursiveSort($arrayAccomplice, 'ksort');
    }

    public static function getListRenegotiation()
    {
        return ArrayHelper::map(Agreements::find()->select(['id', 'number'])->where(['program_id' => $_SESSION['program_id']])->all(), 'id', 'number');
    }

    public static function OrganizationforAgreements()
    {
        $id_organization = ArrayHelper::getColumn(OrganizationProgramMapping::find()->select(['organization_id'])->
        where(['program_id' => $_SESSION['program_id']])->all(), 'organization_id');

        return ArrayHelper::map(Organizations::find()->orderBy(['shortname' => SORT_ASC])->select(['id', 'shortname'])->
        where(['id' => $id_organization])->all(), 'id', 'shortname');
    }


}