<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_calendar_plans".
 *
 * @property int $id
 * @property int|null $agreement_id
 * @property int|null $add_agrement_id
 * @property string|null $step_number
 * @property string|null $date_start
 * @property string|null $date_end
 * @property string|null $report
 * @property int|null $is_has_aktT
 * @property string|null $aktt_path
 * @property int|null $is_has_aktE
 * @property string|null $akte_path
 * @property string|null $aktt_year_path
 * @property string|null $reportf_path
 * @property float|null $price
 * @property string|null $phase
 * @property string|null $excerpt_number
 * @property string|null $date_excerpt
 * @property string|null $excerpt_path
 * @property string|null $date_notification
 * @property string|null $notification_path
 * @property string|null $note
 *
 * @property AdditionalAgreements $AdditionalAgreements
 */
class CalendarPlans extends \yii\db\ActiveRecord
{
    public $files;
    public $resource_path;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_calendar_plans';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['agreement_id', 'add_agrement_id', 'is_has_aktT', 'is_has_aktE'], 'integer'],
            [['date_start', 'date_end', 'date_excerpt', 'date_notification'], 'safe'],
            [['report', 'phase'], 'string'],
            [['price'], 'number'],
            [['step_number', 'excerpt_number'], 'string', 'max' => 255],
            [['aktt_path', 'akte_path', 'aktt_year_path', 'reportf_path', 'excerpt_path', 'notification_path'], 'string', 'max' => 150],
            [['note'], 'string', 'max' => 1000],
            [['add_agrement_id'], 'exist', 'skipOnError' => true, 'targetClass' => AdditionalAgreements::class, 'targetAttribute' => ['add_agrement_id' => 'id']],
            [['files'], 'file','skipOnEmpty' => true, 'extensions'=>'pdf,txt,doc, docx'],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'agreement_id' => Yii::t('app', 'Договор'),
            'add_agrement_id' => Yii::t('app', 'Дополнительное соглашение'),
            'step_number' => Yii::t('app', '№ этапа'),
            'date_start' => Yii::t('app', 'Дата начала'),
            'date_end' => Yii::t('app', 'дата окончания'),
            'report' => Yii::t('app', 'Наименование этапа работы'),
            'is_has_aktT' => Yii::t('app', 'Индикатор наличия акта тех.приемки'),
            'aktt_path' => Yii::t('app', 'Акт технической приемки'),
            'is_has_aktE' => Yii::t('app', 'Индикатор наличия финансового акта'),
            'akte_path' => Yii::t('app', 'Финансовый акт'),
            'aktt_year_path' => Yii::t('app', 'Акт технической приемки за год'),
            'reportf_path' => Yii::t('app', 'Финансовый отчет'),
            'price' => Yii::t('app', 'Цена этапа, тыс.руб.'),
            'phase' => Yii::t('app', 'Отчетность о полученных результатах'),
            'excerpt_number' => Yii::t('app', 'Выписка из протокола №'),
            'date_excerpt' => Yii::t('app', 'Дата выписки №'),
            'excerpt_path' => Yii::t('app', 'Выписка'),
            'date_notification' => Yii::t('app', 'Дата уведомления'),
            'notification_path' => Yii::t('app', 'Уведомление'),
            'note' => Yii::t('app', 'Примечание'),
            'files' => Yii::t('app', 'Файлы'),

        ];
    }

    /**
     * Gets query for [[AdditionalAgreements]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdditionalAgreements()
    {
        return $this->hasMany(AdditionalAgreements::class, ['id' => 'add_agrement_id' ]);
    }

   public function getAgreements(){
        return $this->hasmany(Agreements::class,['id'=>'agreement_id']);
   }
    public static function getNumberaddAgreements($number_agreement) {
        return ArrayHelper::map(AdditionalAgreements::find()->distinct(true)->select(['id','number'])->where(['agreement_id'=>$number_agreement])->all(),'id','text');
    }


}
