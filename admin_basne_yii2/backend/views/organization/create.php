<?php

//use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */

$this->title = Yii::t('app', 'Create Organization');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizations-create">

    <!--h1--><!--?= //Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
