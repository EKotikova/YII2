<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\OrganizationBp $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organization-bp-form align-items-center">

    <?php $form = ActiveForm::begin([
            'id' => 'form-organizations-bp',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'organizations-bp',
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

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'shortname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'chief')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'requisite')->textarea(['rows' => 6]) ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='organization-bp/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='organization-bp/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
