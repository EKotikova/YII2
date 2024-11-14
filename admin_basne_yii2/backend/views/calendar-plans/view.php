<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var app\models\CalendarPlans $model */


$this->title = 'Календарный план к договору № '.$model->agreements[0]->number;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Calendar Plans'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="calendar-plans-view">
    <?php
    if(isset($model->additionalAgreements) and (!empty($model->additionalAgreements))){
        $isDenomination = (strtotime($model->additionalAgreements[0]->date) >= strtotime('2016-07-01')) ? 1 : 0;
    }else{
        $isDenomination = (strtotime($model->date_start) >= strtotime('2016-07-01')) ? 1 : 0;
    }
    ?>
    <div class="details-block calendarplan-detail">
        <div class="agreement-info">
            <div class="title">
                <?php echo "Договор <span class='color'>№{$model->agreements[0]->number}</span>" . " от <span class='color'>" .  date("d.m.Y", strtotime($model->agreements[0]->date)) . "</span>"; ?>
            </div>
            <div class="download">
                <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                <span class="content-block"><?php  echo Html::a($model->agreements[0]->resource_path, Url::to($model->agreements[0]->resource_path,true))//echo FileHelper::findFiles($model->agreements[0], ['resource_path', '/admin/agreement/download']); ?></span>
            </div>
        </div>
        <div class="tehnzadanie-info">
            <div class="title">
                <?php echo "Техническое задание"; ?>
            </div>
            <div class="download">
                <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                <span class="content-block"><?php echo Html::a($model->agreements[0]->techzad_path, Url::to($model->agreements[0]->techzad_path,true))//echo FileHelper::getFileTemplateForDetailView($oData->agreement, 'techzad_path', '/admin/agreement/download'); ?></span>
            </div>
        </div>
        <div class="zadanie-info">
            <div class="title">
                <?php echo "Задание"; ?>
            </div>
            <div class="download">
                <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                <span class="content-block"><?php echo Html::a($model->agreements[0]->zadanie_path, Url::to($model->agreements[0]->zadanie_path,true))//echo FileHelper::getFileTemplateForDetailView($oData->agreement, 'zadanie_path', '/admin/agreement/download'); ?></span>
            </div>
        </div>
        <?php if(!empty($model->additionalAgreements)){ ?>
            <div class="add-agreement-info">
                <div class="title">
                    <?php echo "Дополнительное соглашение <span class='color'>№{$model->additionalAgreements[0]->number}" . " от " .  date("d.m.Y", strtotime($model->additionalAgreements[0]->date)) . "</span>"; ?>
                </div>
                <div class="download">
                    <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                    <span class="content-block"><?php echo Html::a($model->additionalAgreements[0]->resource_path, Url::to($model->additionalAgreements[0]->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oData->additionalagreement, 'resource_path', '/admin/additionalagreement/download'); ?></span>
                </div>
            </div>
        <?php }?>
        <div class="calendar-plants-block wrapper custom-table">
            <div class="etap-row custom-table-row">
                <div class="etap-info custom-table-cell">
                    <div>
                        <span class="etap-number"><?php echo "Этап № {$model->step_number} "; ?></span>
                        <span class="etap-date"><?php echo "{$model->date_start} - {$model->date_end}";?></span>
                    </div>
                    <span class="etap-otchet"><?php echo "Наименование";?></span>
                    <span class="etap-report"><?php echo $model->report; ?></span>
                    <span class="etap-otchet"><?php echo "Отчетность";?></span>
                    <span class="etap-report"><?php echo $model->phase; ?></span>
                    <span class="etap-otchet"><?php echo ($isDenomination)?"Цена этапа, руб.":"Цена этапа, тыс. руб.";?></span>
                    <span class="etap-report"><?php echo $model->price; ?></span>
                    <span class="etap-otchet"><?php echo "Примечание";?></span>
                    <span class="etap-report"><?php echo $model->note; ?></span>
                </div>
                <div class="etap-download custom-table-cell">
                    <div class="custom-table">
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Акт технической приемки:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->aktt_path, Url::to($model->aktt_path,true))////echo FileHelper::getFileTemplateForDetailView($oData, 'aktt_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Финансовый акт:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->akte_path, Url::to($model->akte_path,true))////echo FileHelper::getFileTemplateForDetailView($oData, 'akte_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Акт техн. приемки за год:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->aktt_year_path, Url::to($model->aktt_year_path,true))// //echo FileHelper::getFileTemplateForDetailView($oData, 'aktt_year_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Финансовый отчет:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->reportf_path, Url::to($model->reportf_path,true))////echo FileHelper::getFileTemplateForDetailView($oData, 'reportf_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Выписка:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->excerpt_path, Url::to($model->excerpt_path,true))////echo FileHelper::getFileTemplateForDetailView($oData, 'excerpt_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                        <div class="custom-table-row">
                            <span class="custom-table-cell">Уведомление:</span>
                            <span class="custom-table-cell">
                            <?php echo Html::a($model->notification_path, Url::to($model->notification_path,true))////echo FileHelper::getFileTemplateForDetailView($oData, 'notification_path', '/admin/calendarplan/download'); ?>
                        </span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

