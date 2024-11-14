<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */

$this->title = Yii::t('app', 'Create Arangements');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Arangements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="arangements-create">

    <!--h1><!?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
