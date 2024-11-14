<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Directions $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Directions'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="directions-view">
    <div class="details-block participant-detail">
        <div class="direction-row">
            <div class="name">
                <span><?php echo "{$model->number}. {$model->name}"; ?></span>
            </div>
            <?php if(!empty($model->note)) {?>
                <div class="custom-table-participant">
                    <div class="organization custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Примечание');?></span>
                        <span class="content-block custom-table-cell"><?php echo $model->note ?></span>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

<!--    --><?php //= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'number',
//            'name:ntext',
//            'note:ntext',
//            [
//                 'attribute' => 'program',
//                 'label' => 'Программы',
//                  'value' => function($model){
//                    return $model->program->name;
//                  }
//            ],
//            //'program_id',
//        ],
//    ]) ?>

</div>
