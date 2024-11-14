<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use phpnt\exportFile\ExportFile;


/** @var yii\web\View $this */
/** @var app\models\MapPropertyRecords $model */

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Map Property Records'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="map-property-records-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $isDenomination = (strtotime($model->date_acquisition) >= strtotime('2016-01-01')) ? 1 : 0;
    ?>
    <div class="map">
        <h1> КАРТА</h1>
        <p class="p_h1"> имущества, созданного и приобретенного за счет средств бюджета
            Союзного государства,  имущества,  переданного  государствами-
            участниками в   собственность  Союзного государства, и   иного
            имущества,     поступившего     в    собственность   Союзного
            государства, находящегося на территории  Республики Беларусь</p>

        <p>Полное наименование субъекта <span><?php echo $model->agreement[0]->organization->fullname; ?></span></p>

        <p>Учетный номер плательщика <span><?php echo Html::encode($model->kod_egr); ?></span></p>

        <p>Наименование имущества <span><?php echo Html::encode($model->fullname); ?></span></p>

        <p>Количество (ед.) <span><?php echo Html::encode($model->count); ?></span></p>

        <p>Характеристика, назначение имущества <span><?php echo Html::encode($model->characterization); ?></span></p>

        <p>Место нахождения имущества (почтовый индекс, адрес) <span><?php echo $model->area;/* echo $oData->agreement->organization->post_code.", "; echo Source::model()->getSourceValue($oData->agreement->organization->city).", "; echo $oData->agreement->organization->adress; */?></span></p>

        <p>Наименование программы, подпрограммы, проекта, мероприятия (вид, №,
            дата нормативного правового акта Союзного государства, которым они
            утверждены) <span>«Разработка космических и наземных средств обеспечения потребителей России и Беларуси информацией дистанционного зондирования Земли» («Мониторинг-СГ») постановление Совета Министров Союзного
    государства от 11.10.2013 г №4.</span></p>

        <p>Государственный заказчик-координатор <span> Федеральное космическое агентство РФ</span></p>

        <p>Государственный заказчик <span> Национальная академия наук Беларуси</span></p>

        <p>Имущество создано (приобретено) <span><?php echo Html::encode($model->create_than); ?></span></p>

        <p>Дата создания (приобретения) имущества <span><?php echo Html::encode($model->date_acquisition); ?></span></p>

        <p>Использование  имущества: <span><?php echo Html::encode($model->using); ?></span><br>
            (указать: используется по прямому назначению, не используется, находится на консервации, списано, передано третьим лицам, реализовано , прочее (указать)</p>
        <?php
        $isDenomination = (strtotime($model->date_acquisition) >= strtotime('2016-01-01')) ? 1 : 0;
        ?>
        <p>Затраты на создание (приобретение) имущества (<?php echo ($isDenomination)?"тыс.":"млн.";?>бел.руб.):</p>


        <table>
            <tr>
                <th>№ п/п</th>
                <th>Год</th>
                <th>Средства бюджета Союзного государства </th>
                <th>Средства Республики Беларусь </th>
                <th>Средства Федерального бюджета Российской Федерации</th>
                <th>Иные источники финансирования</th>
                <th>Итого</th>
            </tr>
            <?php
            $count=count($model->costcreatingmaps);
            $balans=0;

            for($j=0; $j<$count; $j++){
                $itog= $model->costcreatingmaps[$j]->finance_sg+$model->costcreatingmaps[$j]->finance_rb+$model->costcreatingmaps[$j]->finance_rf+$model->costcreatingmaps[$j]->finance_other;
                ?>
                <tr>
                    <td><?=$j+1; ?></td>
                    <td><?php echo  $model->costcreatingmaps[$j]->year; ?></td>
                    <td><?php echo  $model->costcreatingmaps[$j]->finance_sg; ?></td>
                    <td><?php echo  $model->costcreatingmaps[$j]->finance_rb; ?></td>
                    <td><?php echo  $model->costcreatingmaps[$j]->finance_rf; ?></td>
                    <td><?php echo  $model->costcreatingmaps[$j]->finance_other; ?></td>
                    <td><?php echo $itog;  ?></td>
                </tr>
                <?php  $balans = $balans+$itog; ?>
            <?php }
            $year_end = explode("-",$model->date_acquisition);
            ?>
        </table>

        <p>Балансовая стоимость имущества (<?php echo ($isDenomination)?"тыс.":"млн.";?>бел.руб.):</br>
            на дату создания (приобретения) <span><?=$balans; ?></span></br>
            на 1 января <?php echo $year_end[0]+1;?>  &nbsp;&nbsp;&nbsp;&nbsp;<span><?=$balans; ?></span></p><br><br>

        <?php //echo CHtml::link("Word", Yii::app()->createUrl("/admin/mappropertyrecords/wordcreate", array("id"=>$oData->id)), array("class" => "submitbutton")) ;?>

        <?php
       // if(!empty($model->resource_path)){
            //echo CHtml::link("Pdf", Yii::app()->createUrl("/admin/mappropertyrecords/download", array("id"=>$oData->id, "image"=>"map-1.pdf")), array("class" => "submitbutton pdf", "target"=> "_blank")) ;}?>

    </div>

</div>
