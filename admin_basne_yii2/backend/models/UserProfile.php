<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "tbl_user_profile".
 *
 * @property int $id
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $middle_name
 * @property string|null $emails
 * @property string|null $mobile_phone
 * @property string|null $other_phone
 * @property string|null $fax
 * @property int $organization_id
 * @property string|null $degree
 * @property string|null $position
 * @property string|null $image_path
 * @property string|null $post_code
 * @property string|null $country
 * @property string|null $city
 * @property string|null $address
 * @property string|null $web_site
 * @property string|null $progress
 * @property string|null $expertise
 * @property string|null $experience
 * @property int|null $is_reviewing_books
 * @property int|null $is_disertation
 * @property int|null $is_assessment_of_projects
 *
 * @property Organizations $organization
 * @property User $user
 */
class UserProfile extends ActiveRecord
{
    public static int $partispant_curator = 1;
    public  static int  $partispant_executor = 2;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user_profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name', 'middle_name','emails'], 'required'],
            [['user_id','organization_id'], 'required'],
            [['user_id', 'organization_id', 'is_reviewing_books', 'is_disertation', 'is_assessment_of_projects'], 'integer'],
            [['progress', 'expertise', 'experience'], 'string'],
            [['first_name', 'last_name', 'middle_name', 'degree', 'position'], 'string', 'max' => 150],
            [['emails', 'mobile_phone', 'other_phone', 'fax', 'image_path', 'address', 'web_site'], 'string', 'max' => 250],
            [['post_code'], 'string', 'max' => 50],
            [['country', 'city'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['organization_id'], 'exist', 'skipOnError' => true, 'targetClass' => Organizations::class, 'targetAttribute' => ['organization_id' => 'id']],

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'first_name' => Yii::t('app', 'Фамилия'),
            'last_name' => Yii::t('app', 'Имя'),
            'middle_name' => Yii::t('app', 'Отчество'),
            'emails' => Yii::t('app', 'Email'),
            'mobile_phone' => Yii::t('app', 'Мобильный телефон'),
            'other_phone' => Yii::t('app', 'Телефон(ы)'),
            'fax' => Yii::t('app', 'Факс'),
            'organization_id' => Yii::t('app', 'Организация'),
            'degree' => Yii::t('app', 'Ученая степень'),
            'position' => Yii::t('app', 'Должность'),
            'image_path' => Yii::t('app', 'Фото'),
            'post_code' => Yii::t('app', 'Почтовый код'),
            'country' => Yii::t('app', 'Страна'),
            'city' => Yii::t('app', 'Город'),
            'address' => Yii::t('app', 'Адрес'),
            'web_site' => Yii::t('app', 'web-сайт'),
            'progress' => Yii::t('app', 'Достижения'),
            'expertise' => Yii::t('app', 'Область компетенции'),
            'experience' => Yii::t('app', 'Опыт работы'),
            'is_reviewing_books' => Yii::t('app', 'Рецензирование книг'),
            'is_disertation' => Yii::t('app', 'Оппонирование диссертаций'),
            'is_assessment_of_projects' => Yii::t('app', 'Экспертиза проектов'),
        ];
    }

    /**
     * Gets query for [[Organization]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrganization()
    {
        return $this->hasOne(Organizations::class, ['id' => 'organization_id']);
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

    public function getSource_deg(){
        return $this->hasOne(Source::class,['id'=>'degree']);
    }
    public function getSource_city(){
        return $this->hasOne(Source::class,['id'=>'city']);
    }

    public function  getCountry_name(){
        return $this->hasOne(Country::class,['id'=>'country']);
    }
    public function signup($id,$mail)
    {
            $user = new User();
            $partispan = new Participants();
            $user->id = $id+1;
            $user->email = $mail;
            $user->save();
            $partispan->save();
            return $user;  // это отправка будет на ваш экшн

    }
    public function signup_patispan($id)
    {
        $partispan = new Participants();
        $partispan->participants_type_id=(isset($_SESSION['participants_type']))?$_SESSION['participants_type']:1;
        $partispan->user_id=$id;
        $partispan->program_id=$_SESSION['program_id'];
        $partispan->save();
        return $partispan;  // это отправка будет на ваш экшн

    }

    public function getfullName(){

        return $this->last_name.' '.$this->first_name;
    }

    public static  function getListCurator(){
        return ArrayHelper::map(UserProfile::find()->select(['id','user_id','last_name','first_name'])->orderBy('last_name')->where(['user_id'=>Participants::getListUserID(self::$partispant_curator)])->all(),'id','fullName');
    }

    public static function getListExecutor(){
        return ArrayHelper::map(UserProfile::find()->select(['id','user_id','last_name','first_name'])->orderBy('last_name')->where(['user_id'=>Participants::getListUserID(self::$partispant_executor)])->all(),'id','fullName');
    }

}
