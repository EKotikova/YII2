<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_user".
 *
 * @property int $id
 * @property string $email
 * @property string|null $password
 * @property int|null $role_id
 * @property string|null $create_date
 * @property string|null $last_login
 * @property int|null $is_blocked
 * @property string|null $token
 *
 * @property Participants[] $Participants
 * @property UserProfile[] $UserProfiles
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['role_id', 'is_blocked'], 'integer'],
            [['create_date', 'last_login'], 'safe'],
            [['email', 'password', 'token'], 'string', 'max' => 250],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'email' => Yii::t('app', 'Email'),
            'password' => Yii::t('app', 'Password'),
            'role_id' => Yii::t('app', 'Role ID'),
            'create_date' => Yii::t('app', 'Create Date'),
            'last_login' => Yii::t('app', 'Last Login'),
            'is_blocked' => Yii::t('app', 'Is Blocked'),
            'token' => Yii::t('app', 'Token'),
        ];
    }

    /**
     * Gets query for [[TblParticipants]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblParticipants()
    {
        return $this->hasMany(Participants::class, ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TblUserProfiles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblUserProfiles()
    {
        return $this->hasMany(UserProfile::class, ['user_id' => 'id']);
    }

    public  static function  getLastId(){
        $lastid =User::find()->max('id');
        return $lastid;
    }


}
