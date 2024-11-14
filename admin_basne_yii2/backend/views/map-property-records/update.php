<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\MapPropertyRecords $model */
/** @var app\models\CostCreatingMaps $model_const */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Map Property Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = ['label' =>$model_const->map_id , 'url' => ['view', 'id' => $model_const->map_id]];

?>
<div class="map-property-records-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
        'model_const' => $model_const
    ]) ?>

</div>
