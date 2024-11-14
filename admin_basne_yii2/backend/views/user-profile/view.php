<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var yii\web\View $this */
/** @var app\models\UserProfile $model */

//$this->title = $model->last_name.' '.$model->first_name.' '.$model->middle_name.' ('.$model->position.') ';
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

( isset($_POST['participants_type_id'] ) ) ? $nType = $_POST['participants_type_id']: $nType=0;

?>
<div class="user-profile-view">

    <div class="details-block participant-detail">
        <div class="organization-row">
            <div class="name">
                <span><?php echo "{$model->last_name} {$model->first_name} {$model->middle_name} ({$model->position})"; ?></span>
            </div>
        </div>
        <div class="custom-table-participant">
            <div class="organization custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Организация:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->organization->shortname} ({$model->organization->fullname})"; ?></span>
            </div>
            <div class="adress custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Адрес:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->post_code},".$model->country_name->name .", г." . $model->source_city->value . ", {$model->address}"; ?></span>
            </div>
            <div class="emails custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'E-mail:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->emails}"; ?></span>
            </div>
            <div class="phone custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Телефоны:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "мобильный: {$model->mobile_phone}<br> рабочий: {$model->other_phone}<br> факс:{$model->fax}"; ?></span>
            </div>
            <?php if( $nType == 3 ) : ?>
                <div class="phone custom-table-row">
                    <span class="title-block custom-table-cell"><?php //echo Yii::t('app', 'Темы:'); ?></span>
                    <span class="content-block custom-table-cell"><?php //echo DataHelper::getManyToManyForDetailView($oData->expert_themes, 'theme'); ?></span>
                </div>
                <div class="phone custom-table-row">
                    <span class="title-block custom-table-cell"><?php //echo Yii::t('app', 'Договора:'); ?></span>
                    <span class="content-block custom-table-cell"><?php //echo DataHelper::getManyToManyForDetailView($oData->expert_agreements, 'number'); ?></span>
                </div>
                <div class="phone custom-table-row">
                    <span class="title-block custom-table-cell"><?php //echo Yii::t('app', 'Рубрики:'); ?></span>
                    <span class="content-block custom-table-cell"><?php //echo RubricHelper::getListHtml(CHtml::listData( $oData->expert_rubrics, 'code', 'name' )); ?></span>
                </div>
            <?php endif; ?>
            <div class="degree custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Ученая степень:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo (is_null($model->source_deg->value))?  "-" : $model->source_deg->value; ?></span>
            </div>
            <div class="web_site custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Web-сайт:'); ?></span>
                <span class="content-block custom-table-cell"><?php $web = $model->web_site; echo($web=="")? "-" : $web; ?></span>
            </div>
            <div class="progress custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Достижения:'); ?></span>
                <span class="content-block custom-table-cell"><?php $progress = $model->progress; echo ($progress == "")? "-" : ""/*DataHelper::getMultiValuesFieldTemplateForDetailView($oData->profile, 'progress')*/; ?></span>
            </div>
            <div class="expertise custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Область компетенции:'); ?></span>
                <span class="content-block custom-table-cell"><?php $expertise = $model->expertise; echo ($expertise == "")? "-" : ""/*DataHelper::getMultiValuesFieldTemplateForDetailView($oData->profile, 'expertise')*/; ?></span>
            </div>
            <div class="experience custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Опыт работы:'); ?></span>
                <span class="content-block custom-table-cell"><?php $experience = $model->experience; echo ($experience == "")? "-" : ""/*DataHelper::getMultiValuesFieldTemplateForDetailView($oData->profile, 'experience')*/; ?></span>
            </div>
            <div class="is_reviewing_books custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Рецензирование книг:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->is_reviewing_books}"; ?></span>
            </div>
            <div class="is_disertation custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Оппонирование диссертаций:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->is_disertation}"; ?></span>
            </div>
            <div class="is_assessment_of_projects custom-table-row">
                <span class="title-block custom-table-cell"><?php echo Yii::t('app', 'Экспертиза проектов:'); ?></span>
                <span class="content-block custom-table-cell"><?php echo "{$model->is_assessment_of_projects}"; ?></span>
            </div>

        </div>

    </div>






    <!--    <h4 class="header_h4">--><?php //= Html::encode($this->title) ?><!--</h4>-->
<!--    --><?php //= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//          //  'id',
//          //  'user_id',
//          //  'first_name',
//          //  'last_name',
//          //  'middle_name',
//            [
//                'attribute' => 'organization',
//                'label' => 'Организация',
//                'value' => function($model){
//                    return $model->organization->fullname;
//                }
//            ],
//            'address',
//            'emails:email',
//            'mobile_phone',
//            'other_phone',
//            'fax',
//
//            //'organization_id',
//            [
//                'attribute' => 'source_deg' ,
//                'label' => 'Ученая степень',
//                'value' => function($model){
//                  if(!empty($model->source_deg)) {
//                      return $model->source_deg->value;
//                  }
//                },
//            ],
//            //'degree',
//            'position',
//            //'image_path',
//            'post_code',
//            [
//                'attribute' => 'country_name' ,
//                'label' => 'Страна',
//                'value' => function($model){
//                    if(!empty($model->country_name)) {
//                        return $model->country_name->name;
//                    }
//                },
//            ],
//
//            //'country',
//            //'city',
//            [
//                'attribute' => 'source_city' ,
//                'label' => 'Город',
//                'value' => function($model){
//                 if(!empty($model->source_city)) {
//                     return $model->source_city->value;
//                 }
//                }
//            ],
//            'web_site',
//            'progress:ntext',
//            'expertise:ntext',
//            'experience:ntext',
//            'is_reviewing_books',
//            'is_disertation',
//            'is_assessment_of_projects',
//        ],
//    ]) ?>

</div>
