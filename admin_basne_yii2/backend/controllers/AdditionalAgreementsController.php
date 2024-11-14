<?php

namespace backend\controllers;

use app\models\AdditionalAgreements;
use app\models\AdditionalAgreementsSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * AdditionalAgreementsController implements the CRUD actions for AdditionalAgreements model.
 */
class AdditionalAgreementsController extends Controller
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
     * Lists all AdditionalAgreements models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdditionalAgreementsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AdditionalAgreements model.
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
     * Creates a new AdditionalAgreements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new AdditionalAgreements();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {

                $model->resource_path = UploadedFile::getInstance($model,'resource_path');
                if(!empty($model->resource_path)){
                    foreach ($model->resource_path as $file){
                        $dir_resource_path ='upload/resource_path/copy';
                        if(!is_dir($dir_resource_path)){
                            mkdir($dir_resource_path);
                        }
                        $filename = time().'-'.$file->baseName.'.'.$file->extension;
                        $model->resource_path = $filename;
                        $path=$dir_resource_path.'/'. $filename;
                        $file->saveAs($path);
                        $model->resource_path=$path;
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
     * Updates an existing AdditionalAgreements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {

            $model->resource_path = UploadedFile::getInstance($model,'resource_path');

            if(!empty($model->resource_path)){
                foreach ($model->resource_path as $file){
                    $dir_resource_path ='upload/resource_path/copy';
                    if(!is_dir($dir_resource_path)){
                        mkdir($dir_resource_path);
                    }
                    $filename = time().'-'.$file->baseName.'.'.$file->extension;
                    $model->resource_path = $filename;
                    $path=$dir_resource_path.'/'. $filename;
                    $file->saveAs($path);
                    $model->resource_path=$path;
                    $model->save();
                }
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
     * Deletes an existing AdditionalAgreements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
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
     * Finds the AdditionalAgreements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return AdditionalAgreements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = AdditionalAgreements::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
