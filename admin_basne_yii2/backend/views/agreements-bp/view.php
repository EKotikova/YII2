<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\AgreementsBp $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional Agreementsbps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="agreements-bp-view">
    <div class="details-block agreement-detail" >
        <div class="col-left">
            <div class = "agreementbp">
                <?php  if(!empty($model->agreement)){
                    echo "{$model->agreement[0]->title}";
                } ?>
            </div>
            <div class="agreement-block wrapper">
                <div class="custom-table-agreement">
                    <div class="curator custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Договор НТП: '); ?></span>
                        <span class="content-block custom-table-cell">
                       <?php  if(!empty($model->agreement)){
                           echo "№ {$model->agreement[0]->number} (".date("d.m.Y", strtotime($model->agreement[0]->date)).")";
                       } ?>
                    </span>
                    </div>
                    <div class="executor custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Ссудодатель:'); ?></span>
                        <span class="content-block custom-table-cell">
                         <?php  if(!empty($model->lender)){ echo "{$model->lender->fullname} ({$model->lender->shortname})"; } ?>
                    </span>
                    </div>
                    <div class="curator custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Ссудополучатель:'); ?></span>
                        <span class="content-block custom-table-cell">
                        <?php  if(!empty($model->recipient)){ echo "{$model->recipient->fullname} ({$model->recipient->shortname})"; } ?>
                    </span>
                    </div>
                    <div class="download custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Договор БП(pdf):'); ?></span>
                        <span class="content-block custom-table-cell"><?php echo Html::a($model->agreement_path, Url::to($model->agreement_path)); ?></span>
                    </div>
                    <div class="download custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Перечень(pdf):'); ?></span>
                        <span class="content-block custom-table-cell"><?php echo Html::a($model->list_path, Url::to($model->list_path)); ?></span>
                    </div>
                </div>

            </div>
        </div>
    </div>