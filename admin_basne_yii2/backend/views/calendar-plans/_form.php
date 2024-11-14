<?php

use app\models\AdditionalAgreements;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\file\FileInput;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use app\models\Agreements;
use app\models\CalendarPlans;
/** @var yii\web\View $this */
/** @var app\models\CalendarPlans $model */
/** @var yii\widgets\ActiveForm $form */
/** @var  $arr */

?>

<div class="calendar-plans-form">

    <?php $form = ActiveForm::begin([
            'id' => 'form-calendar-plans',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'calendar-plans',
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

    <?= $form->field($model, 'agreement_id')->dropDownList(Agreements::getListRenegotiation(),[
        'onchange' =>
            '$.post("/admin_basne_yii2/backend/web/calendar-plans/number?id="+$(this).val(),function(data){
               $("select#list_add_gremeents").html(data);
            });',

        ]); ?>

    <?= $form->field($model, 'add_agrement_id')->dropDownList((!empty($arr))? $arr : [],[
        'id' => 'list_add_gremeents',

    ]); ?>

    <?= $form->field($model, 'step_number')->textInput(['maxlength' => true]); ?>

    <?= $form->field($model, 'date_start')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'date_end')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'report')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput() ?>
    <?= $form->field($model, 'phase')->textarea(['rows' => 6]) ?>


    <!--?= $form->field($model, 'is_has_aktT')->textInput() ?-->

    <!--?= $form->field($model, 'aktt_path')->textInput(['maxlength' => true]) ?-->

    <!--?= $form->field($model, 'is_has_aktE')->textInput() ?-->

    <?= $form->field($model, 'akte_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/akte_path']),
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

    <?= $form->field($model, 'aktt_year_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/aktt_year_path']),
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

        ],]);?>

    <?= $form->field($model, 'reportf_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/reportf_path']),
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



    <?= $form->field($model, 'excerpt_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'date_excerpt')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'excerpt_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/excerpt_path']),
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

    <?= $form->field($model, 'date_notification')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]); ?>

    <?= $form->field($model, 'notification_path')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/notification_path']),
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

    <?= $form->field($model, 'note')->textInput(['maxlength' => true]) ?>

    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='calendar-plans/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='calendar-plans/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    <?php ActiveForm::end(); ?>

</div>
