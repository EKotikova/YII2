<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Directions $model */

$this->title = Yii::t('app', 'Create Directions');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="directions-create">

    <!--h1><!?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
