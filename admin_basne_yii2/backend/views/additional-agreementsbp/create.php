<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreementsbp $model */

$this->title = Yii::t('app', 'Create Additional Agreementsbp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional Agreementsbps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-agreementsbp-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
