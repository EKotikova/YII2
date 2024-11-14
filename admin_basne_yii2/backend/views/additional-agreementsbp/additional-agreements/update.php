<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreements $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="additional-agreements-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
