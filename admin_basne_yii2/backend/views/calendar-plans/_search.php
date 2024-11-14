<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CalendarPlansSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="calendar-plans-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'agreement_id') ?>

    <?= $form->field($model, 'add_agrement_id') ?>

    <?= $form->field($model, 'step_number') ?>

    <?= $form->field($model, 'date_start') ?>

    <?php // echo $form->field($model, 'date_end') ?>

    <?php // echo $form->field($model, 'report') ?>

    <?php // echo $form->field($model, 'is_has_aktT') ?>

    <?php // echo $form->field($model, 'aktt_path') ?>

    <?php // echo $form->field($model, 'is_has_aktE') ?>

    <?php // echo $form->field($model, 'akte_path') ?>

    <?php // echo $form->field($model, 'aktt_year_path') ?>

    <?php // echo $form->field($model, 'reportf_path') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'phase') ?>

    <?php // echo $form->field($model, 'excerpt_number') ?>

    <?php // echo $form->field($model, 'date_excerpt') ?>

    <?php // echo $form->field($model, 'excerpt_path') ?>

    <?php // echo $form->field($model, 'date_notification') ?>

    <?php // echo $form->field($model, 'notification_path') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
