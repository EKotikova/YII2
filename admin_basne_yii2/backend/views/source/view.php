<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Source $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sources'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="source-view">

    <div class="details-block organization-detail">

    <div class="custom-table-organization">

        <div class="adress custom-table-row">

            <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Параметр:'); ?></span>

            <span class="content-block custom-table-cell"><?php echo "{$model->name}"; ?></span>

        </div>

        <div class="phone custom-table-row">

            <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Значение:'); ?></span>

            <span class="content-block custom-table-cell"><?php echo "{$model->value}"; ?></span>

        </div>

    </div>



</div>



</div>
