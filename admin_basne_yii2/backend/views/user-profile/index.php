<?php

use app\models\UserProfile;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;


/** @var yii\web\View $this */
/** @var app\models\SearchUserProfile $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->registerJs('$("#Program_id").val(localStorage.getItem("Program"));');

if(isset($_GET['participants_type_id'])){
    $ssesionUser = Yii::$app->session;
    $ssesionUser->open();
    $ssesionUser->set("participants_type",$_GET['participants_type_id']);
    $ssesionUser->close();
    if($_GET['participants_type_id'] == 1) {
        $this->title = Yii::t('app', 'Participants');
    }
    elseif ($_GET['participants_type_id'] == 2 ){
        $this->title = Yii::t('app', 'Executors');
    }
    elseif ($_GET['participants_type_id'] == 3 ){
        $this->title = Yii::t('app', 'Experts');
    }
    elseif ($_GET['participants_type_id'] == 4 ){
        $this->title = Yii::t('app', 'Directory');
    }

}
else {
    $this->title = Yii::t('app', 'User Profiles');
}
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    <div class="btn_search">
        <?= Html::a('Добавить', "#", [
            'class' => 'submitbutton activity-create-link btn-grid',
            'pjax-container'=> 'user-profile',
            'data-url' => Yii::$app->urlManager->createUrl('user-profile/create'),
            'title' => Yii::t('yii', 'Добавить участника'),
            'data-title' => 'Добавление участника : ',
            'data-pjax' => '0'
        ]);?>
    </div>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(['id' => 'user-profile']); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'pager' => [
            'firstPageLabel' => '««',
            'lastPageLabel' => '»»',
        ],
        'columns' => [
           // ['class' => 'yii\grid\SerialColumn'],
            [
                'class' => 'yii\grid\CheckboxColumn',
                'checkboxOptions' => function($model,$key,$index,$column){
                    return ['value' => $model->first_name];
                }
            ],
           // 'id',
           // 'user_id',
           // 'first_name',
           // 'last_name',
            //'middle_name',
            [
                    'label'=>'ФИО',
                     'attribute'=>'last_name_first_name_middle_name',
                      'value' => function($model){
                       return $model->last_name.' '.$model->first_name.' '.$model->middle_name;
                      }

            ],

            [    'label' => 'Организация, должность',
                'attribute'=>'organization',
                'value'=>function($model){
                     if ($model->position) {
                         return $model->organization->fullname.' (' . $model->position . ')';
                     }
                     else{
                         return $model->organization->fullname;
                     }
                },
            ],
            'emails:email',
            [
               'label'=>'Телефон(ы)/факс',
               'value'=>function($model){
                   $fax=$model->fax;
                if(!empty($model->mobile_phone) && !empty($model->other_phone))
                   {
                       return $fax ? $model->mobile_phone . '; ' . $model->other_phone . '; ' . ' факс: ' . $fax
                           : $model->mobile_phone . '; ' . $model->other_phone . '; ';
                   }
                else{
                    if($model->mobile_phone){
                        return $fax ? $model->mobile_phone . '; '. ' факс: ' . $fax
                            : $model->mobile_phone . '; ';
                    }
                    else{
                        if($model->other_phone) {
                            return $fax ? $model->other_phone . '; '.' факс: ' . $fax : $model->other_phone . '; ';
                        }
                    }
                }

               },
                'filter' => false
            ],
            //'other_phone',
            //'fax',
            //'organization_id',
            //'degree',
            //'position',
            //'image_path',
            //'post_code',
            //'country',
            //'city',
            [
                'attribute'=>'address',
                'value' => function($model){
                  if($model->post_code ) {
                      if(isset($model->country_name->name) and isset($model->source_city->value)) {
                          return $model->post_code . ', ' . $model->address .
                              ',' . $model->country_name->name . ',' . $model->source_city->value;
                      }
                      return $model->post_code . ', ' . $model->address;
                  }
                  else{
                      if($model->address) {
                          if(isset($model->country_name->name) and isset($model->source_city->value)) {
                              return $model->address . ',' . $model->country_name->name .
                                  ',' . $model->source_city->value;
                          }
                          return $model->address;
                      }
                      else{
                          if(isset($model->country_name->name) and isset($model->source_city->value)) {
                              return ',' . $model->country_name->name . ','
                                  . $model->source_city->value;
                          }
                      }
                  }

                },
                'filter' => false
            ],
            //'address',
            //'web_site',
            //'progress:ntext',
            //'expertise:ntext',
            //'experience:ntext',
            //'is_reviewing_books',
            //'is_disertation',
            //'is_assessment_of_projects',
            [
                'class' => ActionColumn::className(),
                'template' => '{view} {update} {delete}',
                'buttons' =>[
                    'view' => function($url,$model,$key){
                        return Html::a('<span class="bi-eye-fill eye"></span>', '#', [
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Просмотреть'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Участник: ',
                        ]);

                    },
                    'update'=> function($url,$model,$key){
                        return Html::a('<span class="bi-pencil-fill  pencil"></span>','#',[
                            'data-url' => $url,
                            'title' => Yii::t('yii', 'Редактировать'),
                            'class' => 'activity-view-link',
                            'data-id' => $key,
                            'data-pjax' => '0',
                            'data-title' => 'Редактирование участника: ',
                        ]);
                    },

                    'delete' => function ($url) {
                        return (Html::a('<span class="bi-trash3-fill trash"></span>', false, [
                                'class' => 'ajaxDelete',
                                'title' => Yii::t('yii', 'Удалить'),
                                'delete-url' => $url,
                                'pjax-container' => 'user-profile',
                                'data-pjax' => '0',
                            ]
                        ));
                    }
                ],
                'urlCreator' => function ($action, UserProfile $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>
</div>
