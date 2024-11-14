<?php

namespace backend\controllers;

use app\models\ArangementAgreementMapping;
use app\models\Arangements;
use app\models\ArangementsSearch;
use app\models\Directions;
use app\models\OrganizationProgramMapping;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ArangementsController implements the CRUD actions for Arangements model.
 */
class ArangementsController extends Controller
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
     * Lists all Arangements models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ArangementsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Arangements model.
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
     * Creates a new Arangements model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Arangements();
         $derection = new Directions();
        $maping = new ArangementAgreementMapping();
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) ) {
               // $derection->program_id=$_SESSION['program_id'];
                //$derection->save();
                $model->save();
                $maping->arangement_id=$model->id;
                $maping->save();
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
     * Updates an existing Arangements model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $derection = new Directions();
        $maping = new ArangementAgreementMapping();

       if ($this->request->isPost && $model->load($this->request->post())) {
           ///$derection->program_id=$_SESSION['program_id'];
          // $derection->save();
           //$model->direction_id=$derection->id;
           $model->save();
           $maping->arangement_id=$model->id;
           $maping->save();
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
     * Deletes an existing Arangements model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $derection = new Directions();
        $maping = new ArangementAgreementMapping();

        if (isset($model) and isset ($derection)) {
            $derection->program_id=null;
            $maping->arangement_id=null;
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
     * Finds the Arangements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Arangements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Arangements::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(\Yii::t('app', 'The requested page does not exist.'));
    }
}
