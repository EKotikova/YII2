<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrganizationBp $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organization Bps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="organization-bp-view">
    <div class="details-block organization-detail">
        <div class="organization-row">
            <div class="name">
                <span><?php echo "{$model->fullname} ({$model->shortname})"; ?></span>
            </div>
        </div>
        <div class="custom-table-organization">
            <div class="chief custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Руководитель:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->chief}"; ?></span>
            </div>
            <div class="adress custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Адрес:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->adress}"; ?></span>
            </div>
            <div class="requisite custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Реквизиты:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->requisite}"; ?></span>
            </div>
        </div>
    </div>
</div>
