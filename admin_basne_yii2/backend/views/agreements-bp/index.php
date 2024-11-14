<?php

use app\models\AgreementsBp;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\AgreementsBpSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Agreements Bps');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="agreements-bp-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'agreements',
            'data-url' => Yii::$app->urlManager->createUrl('agreements-bp/create'),
            'title' => Yii::t('yii', 'Добавить договор безвозмездного пользования имуществом'),
            'data-title' => 'Добавление договора безвозмездного пользования имуществом: ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php Pjax::begin(['id'=>'agreements-bp']); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->number];
                }
            ],
          /*  'pager' => [
                'lastPageLabel' => '»»',
            ],*/
           // ['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'number',
            ['attribute' => 'number',
                'label' => '№ Договора',
                'value' => function($model){
                  return $model->number;
                }
            ],
            ['attribute' => 'agreement',
                'label' => 'Договор о создании НТП',
                'value' => function($model){
                  return $model->agreement[0]->number;
                }
            ],
            //'date',
            ['attribute'=>'lender',
              'label' => 'Организация-Ссудодатель',
                'value' => function($model){
                  return $model->lender->shortname;
                }
            ],
            ['attribute'=>'precipient',
                'label' => 'Организация-Ссудополучатель',
                'value' => function($model){
                    if(isset($model->precipient->shortname)) {
                        return $model->precipient->shortname;
                    }
                }
            ],
            //'id_organization_lender',
            //'id_organization_recipient',
            //'id_agreements',
            //'list:ntext',
            //'agreement_path',
            //'list_path',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'agreements-bp_view',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Договор №: '.$model->number.' от '.date("d.m.Y", strtotime($model->date)),
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'agreements-bp-update-link',
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
                                'pjax-container' => 'agreements-bp',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, AgreementsBp $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
