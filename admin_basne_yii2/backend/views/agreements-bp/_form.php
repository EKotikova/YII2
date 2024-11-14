<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use \app\models\AgreementsBp;

/** @var yii\web\View $this */
/** @var app\models\AgreementsBp $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="agreements-bp-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-agreements',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'agreements-bp',
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


    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ] ]);?>

    <?= $form->field($model, 'id_agreements')->widget(Select2::class,[
        'name' => 'agreement',
        'hideSearch' => true,
        'data' => AgreementsBp::getAgreementNumber(),
        'options' => ['placeholder' => 'Выберите договор'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?= $form->field($model, 'id_organization_lender')->widget(Select2::class,[
        'name' => 'lender',
        'hideSearch' => true,
        'data' => AgreementsBp::getlistLender(),
        'options' => ['placeholder' => 'Выберите договор'],
        'pluginOptions' => [
            'allowClear' => true
        ], ]);?>

    <?= $form->field($model, 'id_organization_recipient')->widget(Select2::class,[
        'name' => 'recipient',
        'hideSearch' => true,
        'data' => AgreementsBp::getlistPrecipient(),
        'options' => ['placeholder' => 'Выберите договор'],
        'pluginOptions' => [
            'allowClear' => true
        ], ]); ?>


    <?= $form->field($model, 'list')->textarea(['rows' => 6]) ?>

    <?php if(!empty($model->agreement_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->agreement_path).'</div>';
    }
    ?>

    <?= $form->field($model, 'agreement_path')->widget(FileInput::class,[
        'options'=>['multiple'=>true],
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
            'uploadUrl' => Url::to(['upload/agreement_path']),
            'uploadExtraData' => [
                'resource' => $model->id,
            ],
            'pluginEvents' =>[
                'filebatchselected' => 'function() {
                jQuery(this).fileinput("upload");
            }',
                'fileuploaded' => 'function(event, data, previewId, index){
                    var _pdfname = jQuery("#file").val();
                    if(_pdfname != ""){
                         _pdfname =  _pdfname ;
                    }
                    _pdfname = _pdfname ;
                    jQuery("#file").val(_pdfname);
            }',
                'filebatchuploadcomplete' => 'function(event, preview, config, tags, extraData)  {
                jQuery.pjax.reload({container: "#" ,"agreements",async: false});
                var _str = "[data-key=\''.$model->id.'\']";
                jQuery(_str).addClass("last-record");
          }',
            ],

        ],]); ?>

    <?php if(!empty($model->list_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->list_path).'</div>';
    }
    ?>

    <?= $form->field($model, 'list_path')->widget(FileInput::class,[
        'options'=>['multiple'=>true],
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
            ' uploadUrl' => Url::to(['upload/list_path']),
            'uploadExtraData' => [
                'resource' => $model->id,
            ],
            'pluginEvents' =>[
                'filebatchselected' => 'function() {
                jQuery(this).fileinput("upload");
            }',
                'fileuploaded' => 'function(event, data, previewId, index){
                    var _pdfname = jQuery("#file").val();
                    if(_pdfname != ""){
                         _pdfname =  _pdfname ;
                    }
                    _pdfname = _pdfname ;
                    jQuery("#file").val(_pdfname);
            }',
                'filebatchuploadcomplete' => 'function(event, preview, config, tags, extraData)  {
                jQuery.pjax.reload({container: "#" ,"agreements",async: false});
                var _str = "[data-key=\''.$model->id.'\']";
                jQuery(_str).addClass("last-record");
          }',
            ],

        ],]); ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='agreements-bp/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='agreements-bp/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
