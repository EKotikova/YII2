<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rubrics $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubrics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="rubrics-update">

    <h4 class="header_h4"><?= Html::encode($this->title) ?></h4>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
