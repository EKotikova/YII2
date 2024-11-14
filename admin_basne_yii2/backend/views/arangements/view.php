<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Arangements $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Arangements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="arangements-view">
    <div class="details-block participant-detail">
       <div class="direction-row">
            <div class="name">
                <span><?php echo "{$model->number}. {$model->name}"; ?></span>
            </div>
           <div class="custom-table-participant">
               <?php if(!empty($model->note)) {?>
                   <div class="organization custom-table-row">
                       <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Примечание');?></span>
                        <span class="content-block custom-table-cell"><?php echo $model->note ?></span>
                    </div>
                <?php } ?>
                <div class="organization custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Направление');?></span>
                  <span class="content-block custom-table-cell"><?php echo $model->direction[0]->number.'. '.$model->direction[0]->name ?></span>
                </div>
            </div>
        </div>
    </div>
</div>