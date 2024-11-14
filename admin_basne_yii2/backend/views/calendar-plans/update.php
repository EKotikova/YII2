<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CalendarPlans $model */
/** @var  $arr */


$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendar Plans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="calendar-plans-update">

    <!--h1><!-?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
        'arr'=>$arr,
    ]) ?>

</div>
