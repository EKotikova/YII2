<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Directions $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="directions-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
