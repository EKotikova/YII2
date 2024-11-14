<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use \app\models\Programs;



/** @var yii\web\View $this */
/** @var app\models\Directions $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="directions-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-directions',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'directions',
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

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>



    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='directions/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='directions/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
