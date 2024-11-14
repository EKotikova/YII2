<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendar Plans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="calendar-plans-number">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
