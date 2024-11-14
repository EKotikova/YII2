<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Rubrics $model */

$this->title = Yii::t('app', 'Create Rubrics');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Rubrics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrics-create">

    <!--h1><!?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
