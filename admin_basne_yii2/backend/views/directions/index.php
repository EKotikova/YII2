<?php

use app\models\Directions;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\DirectionsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */


$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Directions');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="directions-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'directions',
            'data-url' => Yii::$app->urlManager->createUrl('directions/create'),
            'title' => Yii::t('yii', 'Добавить направления'),
            'data-title' => 'Добавление направление: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php Pjax::begin(['id' => 'directions']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'number',
            'name:ntext',
           // 'note:ntext',
           // 'program_id',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Направление: ',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактирование направления: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'directions',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, Directions $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
