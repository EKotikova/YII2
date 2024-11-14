<?php

use app\models\Participants;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\SeachParticipant $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Participants');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="participants-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <div class="btn-search">
        <?= Html::a('Добавить','#',[
                'class' => 'submitbutton activity-create-link btn-grid',
                'pjax-container' => 'participants',
                 'data-url' =>Yii::$app->urlManager->createUrl('participant/create'),
                  'title'=>Yii::t('yii','Добавить куратора'),
                   'data-title' => 'Добавление куратора',
                   'data-pjax' => '0']); ?>
    </div>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
           /* ['class' => 'yii\grid\SerialColumn'],*/
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->user_id];
                }
            ],
            //'id',
            'user_id',
            'participants_type_id',
            'program_id',
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
                            'data-title' => 'Данные куратора: ',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактировать данные куратора: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'participants',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, Participants $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
