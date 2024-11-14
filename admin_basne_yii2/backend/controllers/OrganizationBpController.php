<?php

namespace backend\controllers;

use app\models\OrganizationBp;
use app\models\OrganizationBpSearch;
use app\models\OrganizationProgramMapping;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * OrganizationBpController implements the CRUD actions for OrganizationBp model.
 */
class OrganizationBpController extends Controller
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
     * Lists all OrganizationBp models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrganizationBpSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OrganizationBp model.
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
     * Creates a new OrganizationBp model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new OrganizationBp();
        $Org_mapping = new OrganizationProgramMapping();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                $Org_mapping->organization_id= \Yii::$app->db->lastInsertID;
                $Org_mapping->program_id=$_SESSION['program_id'];
                $Org_mapping->save();
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
     * Updates an existing OrganizationBp model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $Org_mapping = new OrganizationProgramMapping();

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $Org_mapping->program_id = $_SESSION['program_id'];
            $Org_mapping->organization_id=$model->id;
            $model->save();
            $Org_mapping->save();
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
     * Deletes an existing OrganizationBp model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $Org_mapping = new OrganizationProgramMapping();

        if (isset($model) and isset($Org_mapping)) {
            $Org_mapping->organization_id=null;
            $Org_mapping->program_id=null;
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
     * Finds the OrganizationBp model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return OrganizationBp the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = OrganizationBp::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
