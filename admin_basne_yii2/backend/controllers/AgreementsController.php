<?php

namespace backend\controllers;

use app\models\Agreements;
use app\models\AgreementsSearch;
use app\models\ArangementAgreementMapping;
use app\models\Arangements;
use app\models\RubricsMapping;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * AgreementsController implements the CRUD actions for Agreements model.
 */
class AgreementsController extends Controller
{
    public function init()
    {
        parent::init();

        \Yii::$app->language = 'ru-Ru'; //например выставляем язык

    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Agreements models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AgreementsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Agreements model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if(\Yii::$app->request->isAjax){
            \Yii::$app->assetManager->bundles=[
                'yii\bootstrap\BoostrapAsset' => false,
            ];
            return $this->renderAjax('view',['model'=>$model,]);
        }
        else{
            return $this->render('view',['model'=>$model,]);
        }
    }

    /**
     * Creates a new Agreements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Agreements();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())  ) {

                $model->program_id = $_SESSION['program_id'];

                $model->save();

                if(!empty($model->agreement_rubric)) {
                    foreach ($model->agreement_rubric as $idrubric) {
                        $rubricMapping = new RubricsMapping();
                        $rubricMapping->id_rubric = $idrubric;
                        $rubricMapping->type_entity = "agreement";
                        $rubricMapping->id_entity = $model->id;

                        $rubricMapping->save();
                    }
                }
                if(!empty($model->arangement)) {
                    $arangement = new ArangementAgreementMapping();
                    $arangement->arangement_id = $model->arangement;
                    $arangement->agreement_id = $model->id;
                }

                $model->files = UploadedFile::getInstances($model, 'files');
                $model->zadanie = UploadedFile::getInstances($model, 'zadanie');
                $model->techzad = UploadedFile::getInstances($model, 'techzad');
                if(!empty($model->files)){
                    foreach ($model->files as $file){
                        $dir_resource_path ='upload/resource_path';
                        if(!is_dir($dir_resource_path)){
                            mkdir($dir_resource_path);
                        }
                        $filename = date('d.m.Y ').'-'.$file->baseName.'.'.$file->extension;
                        $model->files = $filename;
                        $path=$dir_resource_path.'/'. $filename;
                        $file->saveAs($path);
                        // $model->files = $path;
                        $model->resource_path=$path;
                        // var_dump($model->files);
                        //die();
                        $model->save();
                    }
                }
                if(!empty($model->zadanie)){
                    foreach ($model->zadanie as $zfile){
                        $dir_resource_path ='upload/zadanie_path';
                        if(!is_dir($dir_resource_path)){
                            mkdir($dir_resource_path);
                        }
                        $filename = date('d.m.Y ').'-'.$zfile->baseName.'.'.$zfile->extension;
                        $model->zadanie = $filename;
                        $zpath=$dir_resource_path.'/'. $filename;
                        //  var_dump($zpath);
                        // die();
                        $zfile->saveAs($zpath);
                        //$model->zadanie = $zpath;
                        $model->zadanie_path=$zpath;
                        $model->save();
                    }
                }
                if(!empty($model->techzad)){
                    foreach ($model->techzad as $techfile){
                        $dir_resource_path ='upload/techzad_path';
                        if(!is_dir($dir_resource_path)){
                            mkdir($dir_resource_path);
                        }
                        $filename = date('d.m.Y ').'-'.$techfile->baseName.'.'.$techfile->extension;
                        $model->techzad = $filename;
                        $techpath=$dir_resource_path.'/'. $filename;
                        $techfile->saveAs($techpath);
                        //$model->techzad = $techpath;
                        $model->techzad_path=$techpath;
                        $model->save();
                    }
                }

                if (\Yii::$app->request->isAjax){
                    \Yii::$app->end();
                }
                else{
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        if (\Yii::$app->request->isAjax) {
            \Yii::$app->assetManager->bundles = [
                'yii\bootstrap\BootstrapAsset' => false,
            ];
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Agreements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if(!empty($model->rubrics)) {
            $rubric_mas[] = $model->rubrics;
            $i = 0;
            foreach ($rubric_mas as $rubric) {
                while ($i < sizeof($rubric)) {
                     $id_rub[]= $rubric[$i]->id;
                    $i++;
                }

            }
            $model->agreement_rubric=$id_rub;
        }
        else{
            $rubricMapping=new RubricsMapping();
        }

        if(!empty($model->arangements)) {
            foreach ($model->arangements as $v_arangement) {
                $model->arangement=$v_arangement->id;
            }
        }
        else{
            $arangement_map = new ArangementAgreementMapping();
        }
        $oldrub =$model->agreement_rubric;

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {
            $res= array_diff($oldrub ,$model->agreement_rubric);
            $res1= array_diff($model->agreement_rubric,$oldrub );
            if(!empty($res)){
                foreach ($res as $val){
                    RubricsMapping::deleteAll(['id_rubric'=>$val,'id_entity'=>$model->id]);
                }
            }
            if(!empty($res1)){
                foreach ($res1 as $val){
                    $rubricMapping = new RubricsMapping();
                    $rubricMapping->id_rubric = $val;
                    $rubricMapping->type_entity = "agreement";
                    $rubricMapping->id_entity = $model->id;

                    $rubricMapping->save();
                }
            }

            $model->files = UploadedFile::getInstances($model, 'files');
            $model->zadanie = UploadedFile::getInstances($model, 'zadanie_path');
            $model->techzad = UploadedFile::getInstances($model, 'techzad_path');

            if(!empty($model->files)){
                foreach ($model->files as $file){
                    $dir_resource_path ='upload/resource_path';
                    if(!is_dir($dir_resource_path)){
                        mkdir($dir_resource_path);
                    }
                    $filename = date('d.m.Y ').'-'.$file->baseName.'.'.$file->extension;
                    //$model->files = $filename;
                    $path=$dir_resource_path.'/'. $filename;
                    $file->saveAs($path);
                    $model->resource_path=$path;
                    $model->save();
                }
            }
            if(!empty($model->zadanie)){
                foreach ($model->zadanie as $zfile){
                    $dir_resource_path ='upload/zadanie_path';
                    if(!is_dir($dir_resource_path)){
                        mkdir($dir_resource_path);
                    }
                    $filename = date('d.m.Y ').'-'.$zfile->baseName.'.'.$zfile->extension;
                    $model->zadanie = $filename;
                    $zpath=$dir_resource_path.'/'. $filename;
                    $zfile->saveAs($zpath);
                    // $model->zadanie = $zpath;
                    $model->zadanie_path=$zpath;
                    //var_dump($this->request->post());
                    //  die();
                    $model->save();
                }
            }
            if(!empty($model->techzad)){
                foreach ($model->techzad as $techfile){
                    $dir_resource_path ='upload/techzad_path';
                    if(!is_dir($dir_resource_path)){
                        mkdir($dir_resource_path);
                    }
                    $filename = date('d.m.Y ').'-'.$techfile->baseName.'.'.$techfile->extension;
                    $model->techzad = $filename;
                    $techpath=$dir_resource_path.'/'. $filename;
                    $techfile->saveAs($techpath);
                    //$model->techzad = $techpath;
                    $model->techzad_path=$techpath;
                    // var_dump($this->request->post());
                    //die();
                    $model->save();
                }
            }
            $model->program_id=$_SESSION['program_id'];

            if(!empty($model->agreement_rubric)) {
                foreach ($model->agreement_rubric as $idrubric) {
                    $rubricMapping =new RubricsMapping();
                    $rubricMapping->id_rubric =$idrubric;
                    $model->agreement_rubric = $idrubric;
                    $rubricMapping->type_entity= "agreement";
                    $rubricMapping->id_entity=$model->id;
                    $rubricMapping->save();

                }
            }
            $arangement_map = new ArangementAgreementMapping();
            $arangement_map->arangement_id=$model->arangement;
            $arangement_map->agreement_id=$model->id;
            $arangement_map->save();

            if($model->validate()) {
                $model->save();
            }
            if(\Yii::$app->request->isAjax){
                \Yii::$app->end();
            }
            else {
                return $this->redirect(['index']);
            }
        }
        if(\Yii::$app->request->isAjax){
            \Yii::$app->assetManager->bundles=[
                'yii\bootstrap\BootstrapAsset'=>false,
            ];
            return  $this->renderAjax('update',[
                'model'=>$model
            ]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Agreements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (isset($model)) {
            RubricsMapping::deleteAll(['id_entity'=>$model->id]);
            $model->delete();
            if (\Yii::$app->request->isAjax) {
                \Yii::$app->end();
            } else {
                return $this->redirect(['index']);
            }
        }
        else{
            return $this->redirect(['index']);
        }
    }

    public function actionName($id)
    {
        if(\Yii::$app->request->isAjax) {

            $id = (int)$id;
            $arangement_name = Arangements::find()->select(['name'])->where(['id' => $id])->all();
        }
        return $arangement_name[0]['name'];

    }

    /**
     * Finds the Agreements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Agreements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Agreements::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }


}
