<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */

$this->title = Yii::t('app', 'Create Directions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-name">

    <!--h1><!?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
