<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organizations-update">

    <h4 class="header_h4"><?= Html::encode($this->title) ?></h4>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
