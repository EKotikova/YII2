<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreements $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-agreements-create">
    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
