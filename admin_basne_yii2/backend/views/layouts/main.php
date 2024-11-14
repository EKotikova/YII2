<?php

/** @var \yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use common\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\bootstrap5\Modal;
use app\models\Programs;

use \yii\helpers\ArrayHelper;
AppAsset::register($this);
$ssesion = Yii::$app->session;
$ssesion->open();
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>
    <div class="bottom_header">
        <div class="bottom_header_programm">
            <label id="myprograms">Выберите Программу</label>
            <?php echo Html::beginForm(Yii::$app->urlManager->createUrl('/')); ?>
            <?php echo Html::dropDownList(
                'Program',
                null,
                ArrayHelper::map(Programs::find()->all(),'id','name'),
                [(isset($_SESSION['program_id']))?$_SESSION['program_id']:1=>['selected'=>true],'id'=>'Program_id','onChange' => 'javascript: localStorage.setItem("Program",$(this).val());;jQuery(this).parent().submit();']
            ); ?>
            <?php
            if($ssesion->isActive){
                if(isset($_POST['Program'])) {
                    $ssesion->set('program_id', $_POST['Program']);
                }

                $ssesion->close();
            }

            ?>
            <?php echo Html::endForm();?>
        </div>
    </div>
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
        ],
    ]);
    $menuItems = [
        ['label' => Yii::t('app','Home'), 'url' => ['/site/index']],
        ['label' => Yii::t('app','Contributors'),
            'options' => ['id' => 'down_menu'],
            'items' =>[
                 ['label' => Yii::t('app','Organizations'), 'url' => ['/organization/index']],
                 ['label' => Yii::t('app','Participants'), 'url' => ['/user-profile/index','participants_type_id'=>1]],
                 ['label' => Yii::t('app','Executors'), 'url' => ['/user-profile/index','participants_type_id'=>2]],
                # ['label' => Yii::t('app','Experts'), 'url' => ['/user-profile/index','participants_type_id'=>3]],
                 ['label' => Yii::t('app','Directory'), 'url' => ['/user-profile/index','participants_type_id'=>4]],
                ['label' => Yii::t('app','OrganizationBp'), 'url' => ['/organization-bp/index']],

            ]],
        ['label' => Yii::t('app','Contracts'),
            'options' => ['id' => 'down_menu'],
            'items' =>[
                ['label' => Yii::t('app','Agreements'), 'url' => ['/agreements/index']],
                ['label' => Yii::t('app','Additional Agreements'), 'url' => ['/additional-agreements/index']],
                ['label' => Yii::t('app','Calendar Plans'), 'url' => ['/calendar-plans/index']],
            ]],
        ['label' => Yii::t('app','Finances'),
            'options' => ['id' => 'down_menu'],
            'items' =>[
                ['label' => Yii::t('app','Map Property Records'), 'url' => ['/map-property-records/index']],
                ['label' => Yii::t('app','Agreements Bps'), 'url' => ['/agreements-bp/index']],
                ['label' => Yii::t('app','Additional Agreementsbps'), 'url' => ['/additional-agreementsbp/index']],


            ]],
        ['label' => Yii::t('app','Settings'),
            'options' => ['id' => 'down_menu'],
            'items' => [
                ['label' => Yii::t('app','Rubrics'), 'url' => ['/rubrics/index']],
                ['label' => Yii::t('app','Programs'), 'url' => ['/programs/index']],
                ['label' => Yii::t('app','Directions'), 'url' => ['/directions/index']],
                ['label' => Yii::t('app','Arangements'), 'url' => ['/arangements/index']],
                ['label' => Yii::t('app','Source'), 'url' => ['/source/index']],

            ]]
    ];

    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
    }     
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
        'items' => $menuItems,
    ]);
    if (Yii::$app->user->isGuest) {
        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    } else {
        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
            . Html::submitButton(
                'Logout (' . Yii::$app->user->identity->username . ')',
                ['class' => 'btn btn-link logout text-decoration-none']
            )
            . Html::endForm();
    }
    NavBar::end();
    ?>
</header>

<main role="main" class="flex-shrink-0">
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?=$content ?>
    </div>
</main>

<footer class="footer mt-auto py-3 text-muted">
    <div class="container">
        <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
        <p class="float-end"><?= Yii::powered() ?></p>
    </div>
</footer>


<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader'],
    'id' => 'mymodal',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

Modal::end();
?>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader_agreements'],
    'id' => 'mymodal_agreements',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

Modal::end();
?>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader_additional'],
    'id' => 'mymodal_additional',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

Modal::end();
?>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader_calendar'],
    'id' => 'mymodal_calendar',
    'size' => 'modal-lg',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

Modal::end();
?>







<?php
Modal::begin([
    'headerOptions' => ['id' => 'modalHeader_child'],
    'id' => 'mymodal_child',
    'size' => 'modal-md',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE]
]);

Modal::end();
?>

<?php
Modal::begin([
    'headerOptions' => ['id' => 'messageHeader'],
    'id' => 'mymodalmessage',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],

]);
Modal::end();
?>
<?php
Modal::begin([
    'headerOptions' => ['id' => 'messageHeader'],
    'id'     => 'modal-confirm',
    'clientOptions' => ['backdrop' => 'static', 'keyboard' => FALSE],
]);?>

<div class="message"></div>
<div class="butt_center_message">
    <?php
    echo Html::a('Да', '#', ['class' => 'btn btn-success me-md-2', 'id' => 'confirm_ok', 'data-pjax' => '0']);
    echo Html::a('Отмена', '', ['class' => 'btn btn-danger me-md-2', 'id' => 'confirm_cancle']);
    ?>
</div>
<?php
Modal::end();
?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
