<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\Directions;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="arangements-form">

    <?php $form = ActiveForm::begin([
        'id' => 'form-arangements',
        'enableClientValidation' => true,
        'options' => [
            'pjax-container' => 'arangements',
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


    <?php  echo "<div class='add_info'>
                 <span class='title-block custom-table-cell'>Направление</span></br>
                 <span class='content-block custom-table-cell' id='namedirections'></span>
            </div>";
    ?>
    <?= $form->field($model, 'direction_id')->widget(Select2::class,[
            'name' => 'direction',
        'hideSearch' => true,
        'data' => Directions::getDerecNumber(),
        'options' => ['placeholder' => 'Выберите номер мероприятия',
            "onChange" => "{
          $.get('/admin_basne_yii2/backend/web/directions/name?id='+$(this).val(), function(data) {
              $('#namedirections').html(data);
      });
   }"
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ]) ;
    ?>

    <?= $form->field($model, 'number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>


    <div class="form-group mycentered-text">
        <?php
        if(\Yii::$app->requestedRoute =='arangements/create') {?>
            <?= Html::submitButton(Yii::t('app', 'Add'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>
        <?php if(\Yii::$app->requestedRoute =='arangements/update') {?>
            <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'submitbutton ']) ?>
        <?php  } ?>

    </div>

    <?php ActiveForm::end(); ?>

</div>
