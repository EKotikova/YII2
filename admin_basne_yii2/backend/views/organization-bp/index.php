<?php

use app\models\OrganizationBp;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\OrganizationBpSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

$this->title = Yii::t('app', 'Organization Bps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-bp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'organizations-bp',
            'data-url' => Yii::$app->urlManager->createUrl('organization-bp/create'),
            'title' => Yii::t('yii', 'Добавить организацию БП'),
            'data-title' => 'Добавление организации БП: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php Pjax::begin(['id'=>'organizations-bp']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'fullname',
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->fullname];
                }
            ],
            [
                'attribute' => 'fullname',
                'format' =>'raw',
                'value' => function($model){
                    return Html::a(Html::encode($model->fullname),'#',
                        [ 'class' => 'activity-view-link',
                            'data-pjax' => '0',
                            'data-title' => 'Данные организации: ',
                            'data-url'=>Url::to(['view', 'id'=>$model->id])]);
                },
                'options' => ['style' => 'width: 360px;'],
                'contentOptions' => ['style' => 'width: 360px;' ],
            ],
            [
                'attribute'=> 'requisite',
                'value'=>'requisite',
                'options' => ['style' => 'width: 360px;'],
                'contentOptions' => ['style' => 'width: 360px;' ],
            ],
            //'shortname',
            //'chief',
            //'requisite:ntext',
            //'adress',
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
                            'data-title' => 'Судодатель/Ссудополучатель: ',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактирование организации БП: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'organizations-bp',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, OrganizationBp $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
