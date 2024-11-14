<?php

use app\models\MapPropertyRecords;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SeachMapPropertyRecords $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');


$this->title = Yii::t('app', 'Map Property Records');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="map-property-records-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'additional-agreements',
            'data-url' => Yii::$app->urlManager->createUrl('map-property-records/create'),
            'title' => Yii::t('yii', 'Добавить карту имущества'),
            'data-title' => 'Добавление карты имущества: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>
    <?php Pjax::begin(['id'=>'map-property-records']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
          //  ['class' => 'yii\grid\SerialColumn'],

           // 'id',
           // 'kod_egr',
            ['attribute' => 'kod_egr',
              'label' => '№ плательщика',
                'value' => function($model){
                    return $model->kod_egr;
                }
             ],
             [ 'attribute' => 'fullname',
                 'label' => 'Наименование имущества',
                 'value' => function($model){
                    return $model->fullname;
                 }
             ],
            ['attribute' => 'agreement_number',
                'label' =>'№ договора',
                'value' => function($model){
                    return $model->agreement[0]->number;
                }

            ],
            ['attribute' => 'date_acquisition',
                'label' => 'Дата создаия',
                'value' => function($model){
                     return $model->date_acquisition;
                }
            ],
            //'fullname',
           // 'count',
           // 'characterization',
            //'area',

           // 'agreement_id',
            //'create_than',
            //'date_acquisition',
            ['attribute' => 'curator',
                'label' => 'Куратор',
                'value' => function($model){
                    if(!empty($model->agreement[0]->curator->last_name)) {
                        return $model->agreement[0]->curator->last_name . ' ' . $model->agreement[0]->curator->first_name;
                    }
                }
            ],
            //'using',
            //'resource_path',
            [
                    'attribute' => 'resource_path',
                     'label' => 'Resource Path',
                      'value' => function($model,$key){
                          return '<div id="divmap-1">'.Html::a($model->resource_path,'@web/downland?id='.$key.'&'.$model->resource_path).'</div>';
                      },
                      'format' => 'raw',

            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'map_records',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Карты имущества',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'map_records-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактирование карты имущества: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'map-property-records',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, MapPropertyRecords $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
