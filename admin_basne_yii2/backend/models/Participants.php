<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "tbl_participants".
 *
 * @property int $id
 * @property int $user_id
 * @property int $participants_type_id
 * @property int $program_id
 *
 * @property ParticipantsType $participantsType
 * @property User $user
 */
class Participants extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_participants';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'participants_type_id', 'program_id'], 'required'],
            [['user_id', 'participants_type_id', 'program_id'], 'integer'],
            [['participants_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => ParticipantsType::class, 'targetAttribute' => ['participants_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'participants_type_id' => Yii::t('app', 'Participants Type ID'),
            'program_id' => Yii::t('app', 'Program ID'),
        ];
    }

    /**
     * Gets query for [[ParticipantsType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParticipantsType()
    {
        return $this->hasOne(ParticipantsType::class, ['id' => 'participants_type_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasmany(User::class, ['id' => 'user_id']);
    }

    public static function  getListUserID($participants_type_id){
        if($participants_type_id){
            $listUserid = Participants::find()->distinct(true)->select('user_id')->where(['participants_type_id'=>$participants_type_id])
                ->andwhere(["program_id"=>$_SESSION['program_id']]);
        }
        else{
            $listUserid=0;
        }
        return $listUserid;
    }
}
