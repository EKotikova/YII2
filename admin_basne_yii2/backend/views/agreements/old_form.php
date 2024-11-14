<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
//use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use \app\models\Organizations;
use \app\models\UserProfile;
use \app\models\Programs;
use \app\models\Rubrics;
use kartik\file\FileInput;


/** @var yii\web\View $this */
/** @var app\models\Agreements $model */
/** @var yii\widgets\ActiveForm $form */


?>

<div class="agreements-form">

    <?php $form = ActiveForm::begin([
            'id' => 'form-agreements',
            'enableClientValidation' => true,
            'options' => [
            'pjax-container' => 'agreements',
                'enctype' => 'multipart/form-data'
        ],
        'type' => ActiveForm::TYPE_HORIZONTAL,
        //'layout' => 'horizontal',
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

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'accomplice')->textInput() ?>
    <?= $form->field($model, 'renegotiation')->textInput() ?>
    <?= $form->field($model, 'date')->textInput() ?>


    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'theme')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'organization_id')->widget(Select2::class,[
            'name' => 'organization',
            'data' => Organizations::getOrganization(),
           'options' => ['placeholder' => 'Выберите организацию'],
          'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?=
    $form->field($model, 'curator_id')->widget(Select2::class,[
        'name' => 'curator',
        'data' => UserProfile::getListCurator(),
        'options' => ['placeholder' => 'Выберите куратора'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'executor_id')->widget(Select2::class,[
        'name' => 'executor',
        'data' => UserProfile::getListExecutor(),
        'options' => ['placeholder' => 'Выберите исполнителя'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]) ?>

    <!--?= $form->field($model, 'file')->widget(FileInput::class,[
            'pluginOptions' =>[
                'showRemove' => false,
                'showUpload' => false,
                'overwriteInitial' => false,
                'uploadAsync' => true,
                'browseOnZoneClick' => true,
                'fileActionSettings' => [
                    'showRemove' => false,
            ],
                'maxFileSize' => 1024000, 'msgPlaceholder' => Yii::t('yii', 'Выберите'),
                'uploadUrl' => Url::to(['upload/resource_path'])
            ],
    ]);
    ?-->
    <!--?= $form->field($model, 'file')->widget(FileInput::class,[
            'options' => ['multiple' => true],
        'pluginOptions' =>[
            'showRemove' => false,
            'showUpload' => false,
            'overwriteInitial' => false,
            'uploadAsync' => true,
            'browseOnZoneClick' => true,
            'fileActionSettings' => [
                'showRemove' => false,
            ],
            'maxFileSize' => 1024000, 'msgPlaceholder' => Yii::t('yii', 'Выберите'),
            'uploadUrl' => Url::to(['upload/zadanie_path'])


        ],
    ]) ?-->
    <!--?= $form->field($model, 'file')->widget(FileInput::class,[
        'pluginOptions' =>[
            'showRemove' => false,
            'showUpload' => false,
            'overwriteInitial' => false,
            'uploadAsync' => true,
            'browseOnZoneClick' => true,
            'fileActionSettings' => [
                'showRemove' => false,
            ],
             'msgPlaceholder' => Yii::t('yii', 'Выберите'),
            'uploadUrl' => Url::to(['upload/techzad_path'])
        ],
    ]) ?-->

    <?= $form->field($model,'rubrics')->multiselect(Rubrics::getParent_rubric(),
        ['custom' => true, 'id' => 'custom-checkbox-list']);


    /*listBox(Rubrics::getParent_rubric($checbox = 'false'),
        ['id' => 'rubric',
            'multiple' => true,
            'style' => 'font-size:12px;',

        ]);*/

    ?>

    <?= $form->field($model, 'additional_information')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>


    <!--?= $form->field($model, 'program_id')->widget(Select2::class,[
        'name' => 'program',
        'data' => Programs::getProgram(),
        'options' => ['placeholder' => 'Выберите программу'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]) ?-->

    <div class="form-group mycentered-text">
        <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton']) ?>
        <?= Html::Button(Yii::t('app', 'Cancel'), ['class' => 'btn btn-danger btn-sm', 'value'=> Url::to(['agreements/index']), 'id' =>'modalCancel']) ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>

