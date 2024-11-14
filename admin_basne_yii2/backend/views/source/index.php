<?php

use app\models\Source;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\SeachSource $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Sources');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="source-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'source',
            'data-url' => Yii::$app->urlManager->createUrl('source/create'),
            'title' => Yii::t('yii', 'Добавить Ресурс'),
            'data-title' => 'Добавление ресурса: ',
            'data-pjax' => '0']);?>
    </div>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id'=>'source']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
           /* ['class' => 'yii\grid\SerialColumn'],*/

           // 'id',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->name];
                }
            ],
            //'name',
            [
              'attribute' => 'name',
               'format' =>'raw',
                'value' => function($model){
                    return Html::a(Html::encode($model->name),'#',
                        [ 'class' => 'activity-view-link',
                            'data-pjax' => '0',
                            'data-title' => 'Данные ресурса: ',
                            'data-url'=>Url::to(['view', 'id'=>$model->id])]);
                }
            ],
            //'value',
            ['attribute' => 'value',
              'format' => 'raw',
               'value' =>  function($model){
                   return Html::a(Html::encode($model->value),'#',
                       [ 'class' => 'activity-view-link',
                           'data-pjax' => '0',
                           'data-title' => 'Доп. информация: ',
                           'data-url'=>Url::to(['view', 'id'=>$model->id])]);
               }

            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                 'buttons' =>[
                     'view' => function($url,$model,$key){
                         return Html::a('<span class="bi bi-eye-fill eye"></span>', '#', [
                             'data-url' => $url,
                             'title' => Yii::t('yii', 'Просмотреть'),
                             'class' => 'activity-view-link',
                             'data-id' => $key,
                             'data-pjax' => '0',
                             'data-title' => 'Доп. информация: ',
                         ]);

                     },

                'update'=> function($url,$model,$key){
                    return Html::a('<span class="bi bi-pencil-fill pencil"></span>','#',[
                        'data-url' => $url,
                        'title' => Yii::t('yii', 'Редактировать'),
                        'class' => 'update_source',
                        'data-id' => $key,
                        'data-pjax' => '0',
                        'data-title' => 'Редактирование ресурса: ',
                    ]);
                },
                     'delete' => function ($url) {
                         return (Html::a('<span class="bi bi-trash3-fill trash"></span>', false, [
                                 'class' => 'ajaxDelete',
                                 'title' => Yii::t('yii', 'Удалить'),
                                 'delete-url' => $url,
                                 'pjax-container' => 'source',
                                 'data-pjax' => '0',
                             ]
                         ));
                     }
                 ],
                'urlCreator' => function ($action, Source $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
