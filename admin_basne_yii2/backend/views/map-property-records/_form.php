<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Url;
use app\models\MapPropertyRecords;
use app\models\CostCreatingMaps;

/** @var yii\web\View $this */
/** @var app\models\MapPropertyRecords $model */
/** @var app\models\CostCreatingMaps $model_const */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="map-property-records-form">

    <?php $form = ActiveForm::begin([
            'id' => 'form-map-property-records',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'map-property-records',
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
            ],]]); ?>

    <?= $form->field($model, 'kod_egr')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fullname')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'count')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'characterization')->textarea(['rows' => 4]) ?>

    <?= $form->field($model, 'agreement_id')->widget(Select2::class,[
        'name' => 'agreement',
        'hideSearch' => true,
        'data' =>MapPropertyRecords::getAgreementNumber(),
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ?>

    <?= $form->field($model, 'area')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'create_than')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_acquisition')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]);  ?>

    <?= $form->field($model, 'using')->textarea(['rows' => 6,'value'=>'используется по прямому назначению']) ?>

    <?php if(!empty($model->resource_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->resource_path).'</div>';
    }
    ?>
    <?= $form->field($model, 'files')->widget(FileInput::class,[
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

    <?= $form->field($model_const, 'year')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model_const, 'finance_sg')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model_const, 'finance_rb')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model_const, 'finance_rf')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model_const, 'finance_other')->textInput(['maxlength' => true]) ?>


    <div class="form-group mycentered-text ">
        <?php
        if(\Yii::$app->requestedRoute =='map-property-records/create') {?>
            <?= Html::input('submit','const','+',['class'=>'submitbutton','id'=>'costadd']) ?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='map-property-records/update') {?>
            <?= Html::input('submit','const','+',['class'=>'submitbutton','id'=>'costadd']) ?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<script type="text/javascript">
    jQuery(document).ready(function() {
        $i=1;
        jQuery("#costadd").click (function(e){
            $str="<div class='mb-3 row highlight-addon field-costcreatingmaps-year'><label class='col-sm-2 has-star col-md-2 col-sm-2' for='costcreatingmaps-year'>Год</label><div class='col-sm-10 col-md-10 col-sm-10t'><input id='costcreatingmaps-year' class='form-control' name='CostCreatingMaps["+$i+"][year]' type='text'><div class='invalid-feedback'></div></div></div>";
            $str=$str+"<div class='mb-3 row highlight-addon field-costcreatingmaps-finance_sg'><label class='col-sm-2 has-star col-md-2 col-sm-2' for='costcreatingmaps-finance_sg'>Средства бюджета СГ</label><div class='col-sm-10 col-md-10 col-sm-10t'><input id='costcreatingmaps-finance_sg' class='form-control' name='CostCreatingMaps["+$i+"][finance_sg]' type='text'><div class='invalid-feedback'></div></div></div>";
            $str=$str+"<div class='mb-3 row highlight-addon field-costcreatingmaps-finance_rb'><label class='col-sm-2 has-star col-md-2 col-sm-2' for='costcreatingmaps-finance_rb'>Средства бюджета РБ</label><div class='col-sm-10 col-md-10 col-sm-10t'><input id='costcreatingmaps-finance_rb' class='form-control' name='CostCreatingMaps["+$i+"][finance_rb]' type='text'><div class='invalid-feedback'></div></div></div>";
            $str=$str+"<div class='mb-3 row highlight-addon field-costcreatingmaps-finance_rf'><label class='col-sm-2 has-star col-md-2 col-sm-2' for='costcreatingmaps-finance_rf'>Средства бюджета РФ</label><div class='col-sm-10 col-md-10 col-sm-10t'><input id='costcreatingmaps-finance_rf' class='form-control' name='CostCreatingMaps["+$i+"][finance_rf]' type='text'><div class='invalid-feedback'></div></div></div>";
            $str=$str+"<div class='mb-3 row highlight-addon field-costcreatingmaps-finance_other'><label class='col-sm-2 has-star col-md-2 col-sm-2' for='costcreatingmaps-finance_other'>Иные источники финансирования</label><div class='col-sm-10 col-md-10 col-sm-10t'><input id='costcreatingmaps-finance_other' class='form-control' name='CostCreatingMaps["+$i+"][finance_other]' type='text'><div class='invalid-feedback'></div></div></div";
            jQuery('#costadd').closest(".mycentered-text").before($str);
            $i++;
            e.preventDefault();
            return false;
        });
    });
</script>