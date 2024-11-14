<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\OrganizationBp $model */

$this->title = Yii::t('app', 'Create Organization Bp');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Organization Bps'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organization-bp-create">

    <!--h1><!?= Html::encode($this->title) ?></h1-->

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
