<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Agreements $model */

$this->title = Yii::t('app', 'Create Agreements');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-create">
    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>
</div>
