<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use yii\helpers\Url;
use kartik\select2\Select2;
use kartik\file\FileInput;
use app\models\Organizations;
use app\models\UserProfile;
use app\models\Programs;
use app\models\Rubrics;
use kartik\date\DatePicker;
use app\models\Agreements;
use app\models\Arangements;
use yii\web\JsExpression;

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

    <?= $form->field($model, 'accomplice')->widget(Select2::class,[
        'hideSearch' => true,
        'data'=>Agreements::getListAccomplice(),
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>
    <?= $form->field($model, 'renegotiation')->widget(Select2::class,[
        'hideSearch' => true,
        'data'=>Agreements::getListRenegotiation(),
                'options' => ['placeholder' => ' '],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
        ]) ?>

    <?= $form->field($model, 'date')->widget(DatePicker::class,[
        'name' => 'date',
        'value' => date('Y-M-d'),
        'type'=>DatePicker::TYPE_INPUT,
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true
        ]
    ]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 5]) ?>

    <?= $form->field($model, 'arangement')->widget(Select2::class,[
            'name' => 'arangement',
             'hideSearch' => true,
             'data' => Arangements::listNumberArangement(),
             'options' => [ 'placeholder' => 'Выберите мероприятие', 'id' => 'agreement_arangement_id',
                 "onChange" => "{
          $.get('/admin_basne_yii2/backend/web/agreements/name?id='+$(this).val(), function(data) {
              $('#namearangement').html(data);
      });
   }",
             ],
              'pluginOptions' => [
              'allowClear' => true,

              ],
    ]);
            echo "<div  id='namearangement' class='add_info'></div>";

    ?>

    <?= $form->field($model, 'theme')->textInput(['rows' => 6]) ?>

    <?= $form->field($model, 'organization_id')->widget(Select2::class,[
        'name' => 'agreement_organization',
        'hideSearch' => true,
        'data' => Agreements::OrganizationforAgreements(),
        'options' => ['placeholder' => 'Выберите организацию'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]) ?>

    <?=
    $form->field($model, 'curator_id')->widget(Select2::class,[
        'name' => 'agreement_curator',
        'hideSearch' => true,
        'data' => UserProfile::getListCurator(),
        'options' => ['placeholder' => 'Выберите куратора'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ])
    ?>

    <?= $form->field($model, 'executor_id')->widget(Select2::class,[
        'name' => 'agreement_executor',
        'hideSearch' => true,
        'data' => UserProfile::getListExecutor(),
        'options' => ['placeholder' => 'Выберите исполнителя'],
        'pluginOptions' => [
            'allowClear' => true
        ],

    ]) ?>

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
    <!--?= $form->field($model, 'resource_path')->textInput(['maxlength' => true]) ?-->

    <?php if(!empty($model->zadanie_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->zadanie_path).'</div>';
    }
    ?>
    <?= $form->field($model, 'zadanie')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/zadanie_path']),
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
    <!--?= $form->field($model, 'zadanie_path')->textInput(['maxlength' => true]) ?-->

    <?php if(!empty($model->techzad_path)){
        echo '<div id="file" class="PostFile"> Файл :'. Url::to($model->techzad_path).'</div>';
    }
    ?>
    <?= $form->field($model, 'techzad')->widget(FileInput::class,[
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
            ' uploadUrl' => Url::to(['upload/techzad_path']),
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


    <!--?= $form->field($model, 'techzad_path')->textInput(['maxlength' => true]) ?-->

<?= $form->field($model,'agreement_rubric')->multiselect(Rubrics::getParent_rubric(),
       ['custom' => true, 'id' => 'custom-checkbox-list']);?>

    <?= $form->field($model, 'additional_information')->textarea(['rows' => 6]) ?>
    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='agreements/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='agreements/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

