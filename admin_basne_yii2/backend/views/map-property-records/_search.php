<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SeachMapPropertyRecords $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="map-property-records-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'kod_egr') ?>

    <?= $form->field($model, 'fullname') ?>

    <?= $form->field($model, 'count') ?>

    <?= $form->field($model, 'characterization') ?>

    <?php // echo $form->field($model, 'area') ?>

    <?php // echo $form->field($model, 'agreement_id') ?>

    <?php // echo $form->field($model, 'create_than') ?>

    <?php // echo $form->field($model, 'date_acquisition') ?>

    <?php // echo $form->field($model, 'using') ?>

    <?php // echo $form->field($model, 'resource_path') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
