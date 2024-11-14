<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Programs $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Programs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="programs-view">
    <div class="details-block program-detail">
        <div class="program-row">
            <div class="name">
                <span><?php echo "{$model->name} ({$model->date_start} - {$model->date_end})"; ?></span>
            </div>
        </div>
    </div>
</div>
