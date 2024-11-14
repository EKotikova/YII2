<?php

namespace backend\controllers;

use app\models\CostCreatingMaps;
use app\models\MapPropertyRecords;
use app\models\SeachMapPropertyRecords;
use yii\base\Model;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kartik\mpdf\Pdf;
use yii\web\UploadedFile;


/**
 * MapPropertyRecordController implements the CRUD actions for MapPropertyRecords model.
 */
class MapPropertyRecordsController extends Controller
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
     * Lists all MapPropertyRecords models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new SeachMapPropertyRecords();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single MapPropertyRecords model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        //$model_const = $this->findModel($id);

        if(\Yii::$app->request->isAjax){
            \Yii::$app->assetManager->bundles=[
                'yii\bootstrap\BoostrapAsset' => false,
            ];
            return $this->renderAjax('view',['model'=>$model]);
        }
        else{
            return $this->render('view',['model'=>$model]);
        }
    }

    /**
     * Creates a new MapPropertyRecords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new MapPropertyRecords();
        $model_const = new CostCreatingMaps();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) &&
                $model_const->load($this->request->post())  && Model::validateMultiple([$model,$model_const])) {
                  $model->save(false);
                 $model_const->map_id=$model->id;
                 $model->files = UploadedFile::getInstances($model, 'files');
                 if(!empty($model->files)){
                    foreach ($model->files as $file){
                        $dir_resource_path ='upload/map_property_records';
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

                $model_const->save(false);
                if (\Yii::$app->request->isAjax){
                    \Yii::$app->end();
                }
                else{
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
            $model_const->loadDefaultValues();
        }
        if (\Yii::$app->request->isAjax) {
            \Yii::$app->assetManager->bundles = [
                'yii\bootstrap\BootstrapAsset' => false,
            ];
            return $this->renderAjax('create', [
                'model' => $model,
                'model_const' => $model_const,
            ]);
        }
        else {
            return $this->render('create', [
                'model' => $model,
                'model_const' => $model_const,
            ]);
        }
    }

    /**
     * Updates an existing MapPropertyRecords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        $model = MapPropertyRecords::findOne(['id' => $id]);
        $model_const = CostCreatingMaps::findOne(['map_id' => $id]);

        if (!isset($model)) {
            throw new NotFoundHttpException("The user was not found.");
        }
        $model->scenario = 'update';
        $model_const->scenario = 'update';

        if ($this->request->isPost && $model->load($this->request->post()) &&
            $model_const->load($this->request->post()))  {

            $isValid = $model->validate();
            $isValid = $model_const->validate() && $isValid;

                if (\Yii::$app->request->isAjax) {
                    if($isValid) {
                        $model->save(false);
                        $model_const->save(false);
                    }
                    \Yii::$app->end();
                } else {
                    return $this->redirect(['index']);
                }

            $model->files = UploadedFile::getInstances($model, 'files');
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

        }
        if(\Yii::$app->request->isAjax){
            \Yii::$app->assetManager->bundles=[
                'yii\bootstrap\BootstrapAsset'=>false,
            ];
            return  $this->renderAjax('update',[
                'model'=>$model,
                'model_const'=>$model_const,
            ]);
        }
        else {
            return $this->render('update', [
                'model' => $model,
                'model_const'=>$model_const,
            ]);
        }
    }

    /**
     * Deletes an existing MapPropertyRecords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        if (isset($model) && isset($model_const)) {
            $model->delete();
            $model_const->ddelete();
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
     * Finds the MapPropertyRecords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return MapPropertyRecords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = MapPropertyRecords::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }


}
