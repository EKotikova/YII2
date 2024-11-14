<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
//use yii\widgets\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Agreements;

/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreements $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="additional-agreements-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-additional-agreements',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'additional-agreements',
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
        ]
    ]) ?>

    <?= $form->field($model, 'subject')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'agreement_id')->widget(Select2::class,[
            'name' => 'agreement',
            'hideSearch' => true,
            'data' =>Agreements::getListRenegotiation(),
            'pluginOptions' => [
            'allowClear' => true,
        ],
    ])?>

    <?php if(!empty($model->resource_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->resource_path).'</div>';
    }
    ?>
    <?= $form->field($model, 'resource_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/resource_path']),
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

        ],]);
    ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='additional-agreements/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='additional-agreements/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
