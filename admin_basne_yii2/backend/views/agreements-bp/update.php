<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AgreementsBp $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements Bps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
?>
<div class="agreements-bp-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
