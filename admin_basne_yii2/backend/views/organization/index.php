<?php
use app\models\Organizations;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\SeachOrganization $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');
$this->title = Yii::t('app', 'Organizations');
$this->params['breadcrumbs'][] = $this->title;


echo  "<pre>";
//print_r($_SESSION);
echo  "</pre>";


?>
<div class="organizations-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'organizations',
            'data-url' => Yii::$app->urlManager->createUrl('organization/create'),
            'title' => Yii::t('yii', 'Добавить организацию'),
            'data-title' => 'Добавление организации: ',
            'data-pjax' => '0'
            ]);?>
    </div>
    </p>

     <?php Pjax::begin(['id' => 'organizations']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
         'pager' => [
                'firstPageLabel' => '««',
                'lastPageLabel' => '»»',
         ],
        'columns' => [
           /* [   'class' => 'yii\grid\SerialColumn'],*/
           // 'id',
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
                     return Html::a(Html::encode($model->fullname."(".$model->shortname.")"),'#',
                         [ 'class' => 'activity-view-link',
                             'data-pjax' => '0',
                             'data-title' => 'Организация: ',
                             'data-url'=>Url::to(['view', 'id'=>$model->id])]);
                },
                'options' => ['style' => 'width: 360px;'],
                'contentOptions' => ['style' => 'width: 360px;' ],
            ],
            //'shortname',
            //'requisite:ntext',
           // 'post_code',
            ["attribute" =>'chief',
                "value"=>function($model){
                return $model->chief."(".$model->post.")";
                }],
            //'chief',
            //'phone',
            //'emails:email',
            //'post',
            ['attribute' => 'adress',
             'value' => function($model){
                return (empty($model->source->value))? $model->post_code.','.$model->adress  : $model->post_code.','.$model->source->value.','.$model->adress;
             }
            ],
            //'note:ntext',
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
                                'data-title' => 'Организация: ',
                            ]);

                         },
                     'update'=> function($url,$model,$key){
                            return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                                   'data-url' => $url,
                                   'title' => Yii::t('yii', 'Редактировать'),
                                   'class' => 'activity-view-link',
                                   'data-id' => $key,
                                   'data-pjax' => '0',
                                   'data-title' => 'Редактирование организации: ',
                            ]);
                     },

                     'delete' => function ($url) {
                             return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                     'class' => 'ajaxDelete',
                                     'title' => Yii::t('yii', 'Удалить'),
                                     'delete-url' => $url,
                                     'pjax-container' => 'organizations',
                                     'data-pjax' => '0',
                                 ]
                             ));
                     }
                 ],
                'urlCreator' => function ($action, Organizations $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
