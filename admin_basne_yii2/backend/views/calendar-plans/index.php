<?php

use app\models\CalendarPlans;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\CalendarPlansSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Calendar Plans');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="calendar-plans-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'additional-agreements',
            'data-url' => Yii::$app->urlManager->createUrl('calendar-plans/create'),
            'title' => Yii::t('yii', 'Добавить календарный план'),
            'data-title' => 'Добавление календарного плана: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>
    <?php Pjax::begin(['id'=>'calendar-plans']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],
            //'id',
           // 'agreement_id',
            [ 'attribute'=>'agreements',
                'label'=>'№ договора',
                'value'=> function($model){
                    foreach ($model->agreements as $value) {
                        return $value->number;
                    }
                }
            ],
            ['attribute'=>'additionalAgreements',
              'label'=>'№ доп. соглашения',
                'value' => function($model){
                  foreach ($model->additionalAgreements as $value){
                   return $value->number.' '.'('.$value->date.')';
                  }
                }
            ],
            //'add_agrement_id',
            //'step_number'
            ['attribute' => 'step_number',
                'label' => '№ этапа',
                'value' => function($model){
                  return $model->step_number.' '.'('.$model->date_start.'-'.$model->date_end.')';
                }
            ],
            ['attribute' => 'curator',
                'label' => 'Куратор',
                'value' => function($model){
                    if(!empty($model->agreements[0]->curator->last_name)) {
                        return $model->agreements[0]->curator->last_name . ' ' . $model->agreements[0]->curator->first_name;
                    }
                }
            ],
            [ 'attribute'=>'executor',
                'label' => 'Исполнитель',
                'value' => function($model){
                    if(!empty($model->agreements[0]->executor->last_name)) {
                        return $model->agreements[0]->executor->last_name . ' ' . $model->agreements[0]->executor->first_name;
                    }
                }
            ],
            //'date_start',
            //'date_end',
            //'report:ntext',
            ['attribute' => 'report',
                'label' => 'Наименование этапа работы',
                'value' => function($model){
                 return $model->report;
                },
                'options' => ['style' => 'width: 360px;'],
                'contentOptions' => ['style' => 'width: 360px;' ],
            ],

            //'is_has_aktT',
            //'aktt_path',
            //'is_has_aktE',
            //'akte_path',
            //'aktt_year_path',
            //'reportf_path',
            //'price',
            //'phase:ntext',
            //'excerpt_number',
            //'date_excerpt',
            //'excerpt_path',
            //'date_notification',
            //'notification_path',
            //'note',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'plans',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => (!empty($model->agreements))? 'Календарный план к договору № '.$model->agreements[0]->number: "" ,
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'calendar-plans-update-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактироние календарного плана: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'calendar-plans',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, CalendarPlans $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
