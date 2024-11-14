<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Arangements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');

$res=$model->direction[0]->name;
$this->registerJs("$('#namedirections').text('".$res."')");


?>
<div class="arangements-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
