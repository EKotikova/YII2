<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Participants $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="participants-form align-items-center ">

    <?php $form = ActiveForm::begin([
            'id' => 'participants',
            'enableClientValidation' => true,
            'options' => [
            'pjax-container' => 'requests-type',
        ],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
            'horizontalCssClasses' => [
                'label' => 'col-sm-2',
                'offset' => 'col-sm-offset-1',
                'wrapper' => 'col-sm-10',
                'error' => '',
                'hint' => '',
            ],
        ],
    ]); ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'participants_type_id')->textInput() ?>

    <?= $form->field($model, 'program_id')->textInput() ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='participant/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='participant/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
