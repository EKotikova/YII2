<?php

use app\models\Agreements;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;



/** @var yii\web\View $this */
/** @var app\models\AgreementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');


$this->title = Yii::t('app', 'Agreements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'agreements',
            'data-url' => Yii::$app->urlManager->createUrl('agreements/create'),
            'title' => Yii::t('yii', 'Добавить договор'),
            'data-title' => 'Добавление договора: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php Pjax::begin(['id'=>'agreements']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->number];
                }
            ],

           // 'id',
            'number',
            //'date',
            'title',
            ['attribute'=>'organization',
                'label' => 'Организация-Исполнитель',
                'value' => function($model){
                        return$model->organization->fullname;
                }
            ],
            ['attribute' => 'curator_last_name',
                'label' => 'Куратор',
                'value' => function($model){
                   if(!empty($model->executor->last_name)) {
                       return $model->curator->last_name . ' ' . $model->curator->first_name;
                   }
                }
            ],

            ['attribute' => 'executor_last_name',
                'label' => 'Исполнитель',
                'value' => function($model){
                          if(!empty($model->executor->last_name)) {
                                   return $model->executor->last_name . ' ' . $model->executor->first_name;
                          }
                }
            ],
            //'theme:ntext',
            //'organization_id',
            //'curator_id',
            //'executor_id',
            //'additional_information:ntext',
            //'resource_path',
            //'zadanie_path',
            //'techzad_path',
            //'note',
            //'program_id',
            //'accomplice',
            //'renegotiation',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'agreements_view',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Договор №: '.$model->number.' от '.date("d.m.Y", strtotime($model->date)),
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'agreements-update-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактировать данные договора: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'agreements',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, Agreements $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
