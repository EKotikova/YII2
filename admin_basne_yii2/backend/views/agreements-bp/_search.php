<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\AgreementsBpSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="agreements-bp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'number') ?>

    <?= $form->field($model, 'date') ?>

    <?= $form->field($model, 'id_organization_lender') ?>

    <?= $form->field($model, 'id_organization_recipient') ?>

    <?php // echo $form->field($model, 'id_agreements') ?>

    <?php // echo $form->field($model, 'list') ?>

    <?php // echo $form->field($model, 'agreement_path') ?>

    <?php // echo $form->field($model, 'list_path') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
