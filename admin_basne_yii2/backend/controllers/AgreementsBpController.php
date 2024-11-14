<?php

namespace backend\controllers;

use app\models\AgreementsBp;
use app\models\AgreementsBpSearch;
use app\models\ArangementAgreementMapping;
use app\models\RubricsMapping;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AgreementsBpController implements the CRUD actions for AgreementsBp model.
 */
class AgreementsBpController extends Controller
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
     * Lists all AgreementsBp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AgreementsBpSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AgreementsBp model.
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
     * Creates a new AgreementsBp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AgreementsBp();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())  ) {

                //$model->program_id = $_SESSION['program_id'];

                $model->save();

                $model->files = UploadedFile::getInstances($model, 'agreement_path');
                $model->listPath = UploadedFile::getInstances($model, 'list_path');
                if(!empty($model->files)){
                    foreach ($model->files as $file){
                        $dir_resource_path ='upload/agreement_path';
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
                if(!empty($model->listPath)){
                    foreach ($model->listPath as $lfile){
                        $dir_resource_path ='upload/list_path';
                        if(!is_dir($dir_resource_path)){
                            mkdir($dir_resource_path);
                        }
                        $filename = date('d.m.Y ').'-'.$lfile->baseName.'.'.$lfile->extension;
                        $model->listPath = $filename;
                        $zpath=$dir_resource_path.'/'. $filename;
                        //  var_dump($zpath);
                        // die();
                        $lfile->saveAs($zpath);
                        //$model->zadanie = $zpath;
                        $model->zadanie_path=$zpath;
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
     * Updates an existing AgreementsBp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->validate()) {

            $model->files = UploadedFile::getInstances($model, 'agreement_path');
            $model->listPath = UploadedFile::getInstances($model, 'list_path');
            if(!empty($model->files)){
                foreach ($model->files as $file){
                    $dir_resource_path ='upload/agreement_path';
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
            if(!empty($model->listPath)){
                foreach ($model->listPath as $lfile){
                    $dir_resource_path ='upload/list_path';
                    if(!is_dir($dir_resource_path)){
                        mkdir($dir_resource_path);
                    }
                    $filename = date('d.m.Y ').'-'.$lfile->baseName.'.'.$lfile->extension;
                    $model->listPath = $filename;
                    $zpath=$dir_resource_path.'/'. $filename;
                    //  var_dump($zpath);
                    // die();
                    $lfile->saveAs($zpath);
                    //$model->zadanie = $zpath;
                    $model->zadanie_path=$zpath;
                    $model->save();
                }
            }
            //$model->program_id=$_SESSION['program_id'];

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
     * Deletes an existing AgreementsBp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (isset($model)) {
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

    /**
     * Finds the AgreementsBp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AgreementsBp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AgreementsBp::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
