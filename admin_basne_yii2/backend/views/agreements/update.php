<?php

/** @var yii\web\View $this */
/** @var app\models\Agreements $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Agreements'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');


$res= (isset($model->arangements[0]->name))? $model->arangements[0]->name : "";
$this->registerJs("$('#namearangement').text('".$res."')");

?>
<div class="agreements-update">

    <?= $this->renderAjax('_form', [
        'model' => $model,
    ]) ?>

</div>
