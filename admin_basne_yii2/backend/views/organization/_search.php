<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\SeachOrganization $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organizations-search">

    <?php
        $form = ActiveForm::begin([
            'action' => ['index'],
            'method' => 'get',
        ]);

    ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'fullname') ?>

    <?= $form->field($model, 'shortname') ?>

    <?= $form->field($model, 'requisite') ?>

    <?= $form->field($model, 'post_code') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'adress') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'emails') ?>

    <?php // echo $form->field($model, 'post') ?>

    <?php // echo $form->field($model, 'chief') ?>

    <?php // echo $form->field($model, 'note') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
