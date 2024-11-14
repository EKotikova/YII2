<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Participants $model */

$this->title = Yii::t('app', 'Create Participants');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Participants'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="participants-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
