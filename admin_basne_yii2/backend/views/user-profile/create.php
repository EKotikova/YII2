<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\UserProfile $model */

$this->title = Yii::t('app', 'Create User Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'User Profiles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-create">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
