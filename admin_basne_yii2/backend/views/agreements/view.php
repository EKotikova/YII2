<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;


/** @var yii\web\View $this */
/** @var app\models\Agreements $model */

$this->title =$model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>


<div class="details-block  agreements-view">
    <div class="col-left">
        <div class="agreement-block wrapper">
            <div class="name">
                <span class="title-block"><?php echo $this->title ?></span>
            </div>
            <div class="custom-table-agreement">
                <div class="theme custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Мероприятие ');  if(!empty($model->arangements)) {echo $model->arangements[0]->number;}?></span>
                    <span class="content-block custom-table-cell"><?php if(!empty($model->arangements)){ echo $model->arangements[0]->name; }?></span>
                </div>
                <div class="executor custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Исполнитель:'); ?></span>
                    <span class="content-block custom-table-cell">
                        <?php echo $model->organization->fullname . ", "; ?>
                        <?php echo ( !empty($model->executor) ) ? "<i>{$model->executor->first_name} {$model->executor->last_name}</i>" : ""; ?>
                    </span>
                </div>
                <div class="curator custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Курирует:'); ?></span>
                    <span class="content-block custom-table-cell"><?php echo ( !empty($model->curator) ) ? "{$model->curator->first_name} {$model->curator->last_name}" : ""; ?></span>
                </div>
                <div class="download custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Договор:'); ?></span>
                    <span class="content-block custom-table-cell"><?php echo $model->resource_path; ?></span>
                </div>
                <div class="download custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Тех.задание:'); ?></span>
                    <span class="content-block custom-table-cell"><?php echo $model->techzad_path; ?></span>
                </div>
                <div class="download custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Задание:'); ?></span>
                    <span class="content-block custom-table-cell"><?php echo ((!empty($model->zadanie_path)))? "{$model->zadanie_path}" :""; ?></span>
                </div>
                <div class="download custom-table-row">
                    <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Рубрики:'); ?></span>
                    <span class="content-block custom-table-cell"><?php  if(!empty($model->rubrics)){
                             foreach ($model->rubrics as $rubric){
                                 echo "{$rubric->code}"."-"."{$rubric->name }";
                             }
                        }  ?></span>
                </div>
            </div>

        </div>
        <?php if(!empty($model->renegotiation)){ ?>
            <div class="accomplice-block">
                <?php
                echo "<div class='accomplice-title'>Договор заключен после расторжения договора ";
                echo Html::a("<span class='color'>№ {$model->renegotiation}</span> </div>", "#", ['onclick' => 'javascript: ChangePopup.view("' . Url::to("/agreement/view",["id"=>$model->id]) . '")']);
                ?>
                <div class="custom-table-agreement">
                    <div class="accomplice-row download custom-table-row">
                        <span class="title-block custom-table-cell" style="vertical-align: middle;"><?php echo Html::a("Договор <span class='color'>№{$model->renegotiation}</span>" . " Год <span class='color'>" .  date("Y", strtotime($model->date)) . "</span>", "#", ['onclick' => 'javascript: ChangePopup.view("' . Url::to("/agreement/view?",["id"=>$model->id]) . '")']); ?></span>
                        <span class="content-block custom-table-cell"><?php //echo Html::a($model->renegotiation->resource_path, Url::to($model->renegotiation->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oDataRenegotiation, 'resource_path', '/admin/agreement/download'); ?></span>
                    </div>

                    <div class="executor custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Исполнитель:'); ?></span>
                        <span class="content-block custom-table-cell">
                      <?php echo $model->organization->fullname . ", "; ?>
                      <?php echo ( !empty($model->executor) ) ? "<i>{$model->executor->first_name} {$model->executor->last_name}</i>" : ""; ?>
                    </span>
                    </div>
                    <div class="download custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Тех.задание:'); ?></span>
                        <span class="content-block custom-table-cell"><?php //echo Html::a($model->renegotiation->techzad_path, Url::to($model->renegotiation->techzad_path,true))//echo FileHelper::getFileTemplateForDetailView($oDataRenegotiation, 'techzad_path', '/admin/agreement/download'); ?></span>
                    </div>
                    <div class="download custom-table-row">
                        <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Задание:'); ?></span>
                        <span class="content-block custom-table-cell"><?php //echo Html::a($model->renegotiation->zadanie_path, Url::to($model->renegotiation->zadanie_path,true))//echo FileHelper::getFileTemplateForDetailView($oDataRenegotiation, 'zadanie_path', '/admin/agreement/download'); ?></span>
                    </div>

                    <?php
                    $aAdditionalAgreements = $model->additionalAgreements;
                    foreach ( $aAdditionalAgreements  as $oAdditionalAgreements ): ?>
                        <div class="download custom-table-row">
                            <span class="title-block custom-table-cell"><?php echo "ДС № {$oAdditionalAgreements->number} от " . date('d.m.Y', strtotime($oAdditionalAgreements->date)); ?></span>
                            <span class="content-block custom-table-cell"><?php echo Html::a($oAdditionalAgreements->resource_path, Url::to($oAdditionalAgreements->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oAdditionalAgreements, 'resource_path', '/admin/additionalagreement/download'); ?></span>
                        </div>
                    <?php endforeach;?>
                </div>
            </div>
        <?php } ?>

        <?php if(!empty($model->accomplice)){ ?>
        <div class="accomplice-block">
            <?php  echo "<div class='accomplice-title'>Головной исполнитель - {$model->organization->shortname} ";
            echo Html::a("(основной договор <span class='color'>№ {$model->number}</span>) </div></div>", "#", ['onclick' => 'javascript: ChangePopup.view("' . Url::to("/agreements/view",["id"=>$model->id]) . '")']);
            }elseif(empty($model->accomplice)){?>
                <div class='accomplice-title'>Соисполнителей нет</div> <?php }else{?>
                <div class="accomplice-block">
                    <div class='accomplice-title'>Соисполнители</div>
                    <?php foreach ( $model->accomplice as $oAccomplice ):?>
                        <div class="custom-table-agreement">
                            <div class="accomplice-row download custom-table-row">
                                <span class="title-block custom-table-cell" style="vertical-align: middle;"><?php echo Html::a("Договор <span class='color'>№{$oAccomplice->number}</span>" . " Год <span class='color'>" .  date("Y", strtotime($oAccomplice->date)) . "</span>", "#", ['onclick' => 'javascript: ChangePopup.view("' . Url::to("/agreement/view",["id"=>$oAccomplice->id]) . '")']); ?></span>
                                <span class="content-block custom-table-cell"><?php echo Html::a($oAccomplice->resource_path, Url::to($oAccomplice->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oAccomplice, 'resource_path', '/admin/agreement/download'); ?></span>
                            </div>

                            <div class="executor custom-table-row">
                                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Исполнитель:'); ?></span>
                                <span class="content-block custom-table-cell">
                        <?php echo $model->organization->fullname . ", "; ?>
                        <?php echo ( !empty($model->executor) ) ? "<i>{$model->executor->first_name} {$model->executor->last_name}</i>" : ""; ?>
                    </span>
                            </div>
                            <div class="download custom-table-row">
                                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Тех.задание:'); ?></span>
                                <span class="content-block custom-table-cell"><?php  echo Html::a($oAccomplice->techzad_path, Url::to($oAccomplice->techzad_path,true))//echo FileHelper::getFileTemplateForDetailView($oAccomplice, 'techzad_path', '/admin/agreement/download'); ?></span>
                            </div>
                            <div class="download custom-table-row">
                                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Задание:'); ?></span>
                                <span class="content-block custom-table-cell"><?php echo Html::a($oAccomplice->zadanie_path, Url::to($oAccomplice->zadanie_path,true))//echo FileHelper::getFileTemplateForDetailView($oAccomplice, 'zadanie_path', '/admin/agreement/download'); ?></span>
                            </div>

                            <?php
                            $aAdditionalAgreements = $model->additionalAgreements;
                            foreach ( $aAdditionalAgreements  as $oAdditionalAgreements ): ?>
                                <div class="download custom-table-row">
                                    <span class="title-block custom-table-cell"><?php echo "ДС № {$oAdditionalAgreements->number} от " . date('d.m.Y', strtotime($oAdditionalAgreements->date)); ?></span>
                                    <span class="content-block custom-table-cell"><?php echo Html::a($oAdditionalAgreements->resource_path, Url::to($oAdditionalAgreements->resource_path,true))//echo FileHelper::getFileTemplateForDetailView($oAdditionalAgreements, 'resource_path', '/admin/additionalagreement/download'); ?></span>
                                </div>
                            <?php endforeach;?>
                        </div>



                    <?php  endforeach; ?>
                </div>
            <?php }?>

        </div>
        <div class="col-right">
            <div class="calendar-plan-row">
                <div class="year"><?php echo date('Y', strtotime($model->date)) ;?></div>
                <div class="name">
                    <span><?php echo "Календарный план работы к договору № {$model->number} от " . date('d.m.Y', strtotime($model->date))/*date('d.m.Y', strtotime($oDate->date))*/; ?></span>
                    <?php if(!empty($model->calendarPlans)){?> <span style="margin-left: 15px;">
                        <?php echo Html::a('<span class="bi-eye-fill eye"></span>','#',
                            [
                                'data-url' => Url::to("/admin_basne_yii2/backend/web/calendar-plans/view?id=".$model->calendarPlans[0]->id),
                                'title' => Yii::t('yii', 'Подробнее'),
                                'class' => 'plans_block',
                                'data-id' => $model->calendarPlans[0]->id,
                                'data-pjax' => '0',
                                'data-block-title' => 'Календарный план к договору № '.$model->number,
                            ]
                        );  ?>
                   </span> <?php }?>
                </div>
            </div>
            <div class="calendar-plants-block wrapper custom-table">

                <?php foreach ( $model->calendarPlans as $oCalendarPlan ):
                    if($oCalendarPlan->add_agrement_id ==NULL){?>
                        <div class="etap-row">
                            <div class="custom-table-row">
                                <div class="etap-number custom-table-cell">
                                    <span><?php echo "Этап № {$oCalendarPlan->step_number}"; ?></span>
                                </div>
                                <div class="etap-info custom-table-cell">
                                    <span><?php echo "{$oCalendarPlan->date_start} - {$oCalendarPlan->date_end}"; ?></span>
                                    <span><?php echo $oCalendarPlan->report; ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="remarks-block">

<!--                            --><?php // $this->widget('admin.components.widgets.RemarkWidget', array(
//                                'aData'    => $oCalendarPlan->remarks,
//                                'oAddForm' => RemarkHelper::getFormAdd( $oCalendarPlan->id )
//                            )); ?>
                        </div>
                    <?php } endforeach; ?>

            </div>
            <div class="additional-agreements-block wrapper">
                <?php  //$aAdditionalAgreements = $oData->additional_agreements(array('order'=>'date'));

                foreach ( $model->additionalAgreements as $oAdditionalAgreements ): ?>
                    <div class="additional-agreements-row">
                        <div class="year"><?php echo date('Y', strtotime($oAdditionalAgreements->date)) ;?></div>
                        <div class="name">
                            <span><?php echo "Дополнительное соглашение № {$oAdditionalAgreements->number} от " . date('d.m.Y', strtotime($oAdditionalAgreements->date)); ?></span>
                            <span style="margin-left: 15px;">
                        <?php echo Html::a('<span class="bi-eye-fill eye"></span>', "#",
                            [
                                'data-url' => Url::to("/admin_basne_yii2/backend/web/additional-agreements/view?id=".$oAdditionalAgreements->id),
                                'title' => Yii::t('yii', 'Потробнее'),
                                'class' => 'additional-block',
                                'data-id' => $oAdditionalAgreements->id,
                                'data-pjax' => '0',
                                'data-block-title' => 'Дополнительное соглашение: № '.$oAdditionalAgreements->number.' от '.date("d.m.Y", strtotime($oAdditionalAgreements->date)),

                            ]);
                          ?>
                    </span>

                        </div>
                    </div>
                    <div class="calendar-plants-block wrapper custom-table">
                        <?php foreach ( $oAdditionalAgreements->calendarPlans as $oCalendarPlan ): ?>
                            <div class="etap-row">
                                <div class="custom-table-row">
                                    <div class="etap-number custom-table-cell">
                                        <span><?php echo "Этап № {$oCalendarPlan->step_number}"; ?></span>
                                    </div>
                                    <div class="etap-info custom-table-cell">
                                        <span><?php echo "{$oCalendarPlan->date_start} - {$oCalendarPlan->date_end}"; ?></span>
                                        <span><?php echo $oCalendarPlan->report; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="remarks-block">
<!--                                --><?php //$this->widget('admin.components.widgets.RemarkWidget', array(
//                                    'aData'    => $oCalendarPlan->remarks,
//                                    'oAddForm' => RemarkHelper::getFormAdd( $oCalendarPlan->id )
//                                )); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
