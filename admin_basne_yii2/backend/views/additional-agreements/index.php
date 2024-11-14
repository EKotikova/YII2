<?php

use app\models\AdditionalAgreements;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\AdditionalAgreementsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Additional Agreements');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="additional-agreements-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'additional-agreements',
            'data-url' => Yii::$app->urlManager->createUrl('additional-agreements/create'),
            'title' => Yii::t('yii', 'Добавить дополнительное соглашение'),
            'data-title' => 'Добавление дополнительного соглашения: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php Pjax::begin(['id'=>'additional-agreements']); ?>

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
            'number',
            'date',
            //'subject:ntext',
             [ 'attribute'=>'agreements',
                'label'=>'Договор',
                 'value'=> function($model){
                  return $model->agreements[0]->number.' '.$model->agreements[0]->organization->shortname;
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
            ['attribute' => 'curator',
              'label' => 'Куратор',
               'value' => function($model){
                 if(!empty($model->agreements[0]->curator->last_name)) {
                     return $model->agreements[0]->curator->last_name . ' ' . $model->agreements[0]->curator->first_name;
                 }
               }
            ],
           // 'resource_path',
            //'note:ntext',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'addagreements',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Дополнительное соглашение: № '.$model->number.' от '.date("d.m.Y", strtotime($model->date)),
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'additional-update-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактирование дополнительного соглашения: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'additional-agreements',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, AdditionalAgreements $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
