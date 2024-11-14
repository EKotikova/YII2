<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\Source;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="organizations-form align-items-center">

    <?php $form = ActiveForm::begin([
                          'id' => 'form-organizations',
                          'enableClientValidation' => true,
                          'options' => [
                          'pjax-container' => 'organizations',
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

    <?= $form->field($model, 'fullname')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'shortname')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'chief')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'post')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'post_code')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'city')->widget(Select2::classname(), [
        'name' => 'city',
        'hideSearch' => true,
        'data' => Source::getCity(),
        'options' => ['placeholder' => 'Выберите город ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'adress')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'emails')->textInput(['maxlength' => 250]) ?>

    <?= $form->field($model, 'requisite')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


    <div class="form-group mycentered-text">

        <?php
        if(\Yii::$app->requestedRoute =='organization/create') {?>
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
      <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='organization/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
