<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MapPropertyRecords $model */
/** @var app\models\CostCreatingMaps $model_const */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Map Property Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-property-records-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
        'model_const'=>$model_const
    ]) ?>

</div>
