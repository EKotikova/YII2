<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreements $model */

$this->title = ' №'.$model->number.' от '.$model->date;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="additional-agreements-view">
    <div class="details-block add-aggrement-detail">
        <div class="agreement-info">
            <div class="title">
                <?php echo "Договор <span class='color'>№{$model->agreements[0]->number}</span>" . " Год <span class='color'>" .  date("Y", strtotime($model->agreements[0]->date)) . "</span>"; ?>
            </div>
            <div class="download">
                <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                <span class="content-block"><?php echo Html::a($model->agreements[0]->resource_path, Url::to($model->agreements[0]->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oData->agreement, 'resource_path', '/admin/agreement/download'); ?></span>
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
        <div class="add-agreement-info">
            <div class="title">
                <?php echo "Дополнительное соглашение <span class='color'>№{$model->number}" . " от " .  date("d.m.Y", strtotime($model->date)) . "</span>"; ?>
            </div>
            <div class="download">
                <span class="title-block"><?php echo Yii::t('app', 'Электронная версия:'); ?></span>
                <span class="content-block"><?php echo Html::a($model->resource_path, Url::to($model->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oData, 'resource_path', '/admin/additionalagreement/download'); ?></span>
            </div>
        </div>
        <div class="calendar-plants-block wrapper custom-table">
            <?php foreach ( $model->calendarPlans as $CalendarPlan ): ?>
                <div class="etap-row custom-table-row">
                    <div class="etap-info custom-table-cell">
                        <div>
                            <span class="etap-number"><?php echo "Этап № {$CalendarPlan->step_number} "; ?></span>
                            <span class="etap-date"><?php echo "{$CalendarPlan->date_start} - {$CalendarPlan->date_end}";?></span>
                        </div>
                        <span class="etap-report"><?php echo $CalendarPlan->report; ?></span>
                        <span class="etap-report"><?php echo $CalendarPlan->phase; ?></span>
                    </div>
                    <div class="etap-download custom-table-cell">
                        <div class="custom-table">
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Акт технической приемки:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->aktt_path, Url::to($CalendarPlan->aktt_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'aktt_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Финансовый акт:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->akte_path, Url::to($CalendarPlan->akte_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'akte_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Акт техн. приемки за год:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->aktt_year_path, Url::to($CalendarPlan->aktt_year_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'aktt_year_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Финансовый отчет:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->reportf_path, Url::to($CalendarPlan->reportf_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'reportf_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Выписка:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->excerpt_path, Url::to($CalendarPlan->excerpt_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'excerpt_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                            <div class="custom-table-row">
                                <span class="custom-table-cell">Уведомление:</span>
                                <span class="custom-table-cell">
                            <?php echo Html::a($CalendarPlan->notification_path, Url::to($CalendarPlan->notification_path,true))//echo FileHelper::getFileTemplateForDetailView($oCalendarPlan, 'notification_path', '/admin/calendarplan/download'); ?>
                        </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>






    <!--?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'number',
            'date',
            'subject:ntext',
            'resource_path',
            'note:ntext',
            'agreement_id',
        ],
    ]) ?-->

</div>
