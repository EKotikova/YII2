<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organizations'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);

?>
<div class="organizations-view">

    <h4 class="header_h4"><?= Html::encode($this->title) ?></h4>
    <div class="details-block organization-detail">
        <div class="organization-row">
            <div class="name">
                <span><?php echo "{$model->fullname} ({$model->shortname})"; ?></span>
            </div>
        </div>
        <div class="custom-table-organization">
            <div class="chief custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Руководитель:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->chief} ({$model->post})"; ?></span>
            </div>
            <div class="adress custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Адрес:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo (isset($model->source->value))? "{$model->post_code}, {$model->source->value}, {$model->adress}":"{$model->post_code}, {$model->adress}" ?></span>
            </div>
            <div class="phone custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Телефон:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->phone}"; ?></span>
            </div>
            <div class="emails custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'E-mail:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->emails}"; ?></span>
            </div>
            <div class="requisite custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Реквизиты:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->requisite}"; ?></span>
            </div>
        </div>

    </div>

</div>
