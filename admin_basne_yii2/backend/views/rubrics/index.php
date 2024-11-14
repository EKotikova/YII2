<?php

use app\models\Rubrics;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\RubricsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Rubrics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="rubrics-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn-search">
        <?= Html::a('Добавить','#',[
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container' => 'rubrics',
            'data-url' =>Yii::$app->urlManager->createUrl('rubrics/create'),
            'title'=>Yii::t('yii','Добавить рубриу'),
            'data-title' => 'Добавление рубрики',
            'data-pjax' => '0']); ?>
    </div>
    </p>

    <?php Pjax::begin(['id'=>'rubrics']); ?>
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
                    return ['value' => $model->code];
                }
            ],
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'code',
            'name',
            //'parent_id',
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
                            'data-title' => 'О  рубрике: ',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-title' => 'Редактировать данные рубрики: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'rubrics',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, Rubrics $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
