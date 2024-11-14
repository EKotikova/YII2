<?php

use app\models\UserProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\Organizations;
use \app\models\Source;
use \app\models\Country;
use yii\web\UploadedFile;
use \app\models\User;

/** @var yii\web\View $this */
/** @var app\models\UserProfile $model */
/** @var yii\widgets\ActiveForm $form */
?>


<div class="user-profile-form">

    <?php $form = ActiveForm::begin([
            'id'=>'form-user-profile',
           'enableClientValidation' => true,
           'options' => [
            'pjax-container' => 'user-profile',
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

    <?= $form->field($model, 'user_id')->textInput(['value'=>User::getLastId(),'hidden'=>true])->label(false) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'middle_name')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'organization_id')->widget(Select2::class,[
            'name' => 'organizations',
             'hideSearch' => true,
             'data' =>Organizations::getOrganization(),
             'options' => ['placeholder' => 'Выберите организацию ...'],
             'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'position')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'degree')->widget(Select2::class,[
        'name' => 'source',
        'hideSearch' => true,
        'data' =>Source::getDegree(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'image_path')->fileInput() ?>
    <?= $form->field($model, 'post_code')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'country')->widget(Select2::class,[
        'name' => 'country',
        'hideSearch' => true,
        'data'=>Country::getCountry(),
        'options' => ['placeholder' => 'Выберите страну ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]);

    ?>
    <?= $form->field($model, 'city')->widget(Select2::class, [
        'name' => 'city',
        'hideSearch' => true,
        'data' => Source::getCity(),
        'options' => ['placeholder' => 'Выберите город ...'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'emails')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'mobile_phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'other_phone')->textInput(['maxlength' => true,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>
    <?= $form->field($model, 'fax')->textInput(['maxlength' => true,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>

    <?= $form->field($model, 'web_site')->textInput(['maxlength' => true,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>

    <?= $form->field($model, 'progress')->textarea(['rows' => 6,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>

    <?= $form->field($model, 'expertise')->textarea(['rows' => 6,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>

    <?= $form->field($model, 'experience')->textarea(['rows' => 6,
        'placeholder'=>'для ввода нескольких значений используйте разделитель ; (точка с запятой)']) ?>

    <?= $form->field($model, 'is_reviewing_books')->checkbox([
        'template' => '<div class="col-md-3">{label}</div><div class="col-md-6">{input}</div><div class="col-md-8">{error}</div>'
    ]) ?>

    <?= $form->field($model, 'is_disertation')->checkbox([
        'template' => '<div class="col-md-3">{label}</div><div class="col-md-6">{input}</div><div class="col-md-8">{error}</div>'
    ]) ?>

    <?= $form->field($model, 'is_assessment_of_projects')->checkbox([
        'template' => '<div class="col-md-3">{label}</div><div class="col-md-6">{input}</div><div class="col-md-8">{error}</div>'
    ]) ?>

    <div class="form-group mycentered-text ">
        <?php
        if(\Yii::$app->requestedRoute =='user-profile/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='user-profile/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
