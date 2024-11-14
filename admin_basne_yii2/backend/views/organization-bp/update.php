<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrganizationBp $model */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organization Bps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="organization-bp-update">

    <h4 class="header_h4"><?= Html::encode($this->title) ?></h4>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
