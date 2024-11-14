<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use \app\models\Rubrics;

/** @var yii\web\View $this */
/** @var app\models\Rubrics $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="rubrics-form">

    <?php $form = ActiveForm::begin([ 'id' => 'form-rubrics',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'rubrics',
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
        ],]); ?>

    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'parent_id')->widget(Select2::class,[
            'name' => 'parent',
            'hideSearch' => true,
            'data' => Rubrics::getParent_rubric(),
           'options' => ['placeholder' => 'Выберите рубрику'],
          'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='rubrics/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='rubrics/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
