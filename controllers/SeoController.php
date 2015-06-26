<?php

namespace kravchukdim\yii2seo\controllers;

use Yii;
use kravchukdim\yii2seo\models\SeoModel;
use kravchukdim\yii2seo\models\search\SeoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2mod\editable\EditableAction;

/**
 * Class SeoController
 * SeoController implements the CRUD actions for SeoModel model.
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\controllers
 */
class SeoController extends Controller
{
   /**
    * Behaviors
    * @return array
    */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Declares external actions for the controller.
     * This method is meant to be overwritten to declare external actions for the controller.
     * @return array
     */
    public function actions()
    {
        return [
            'edit-seo-name' => [
                'class' => EditableAction::className(),
                'modelClass' => SeoModel::className(),
                'forceCreate' => false
            ],
            'edit-seo-category' => [
                'class' => EditableAction::className(),
                'modelClass' => SeoModel::className(),
                'forceCreate' => false
            ],
            'edit-seo-status' => [
                'class' => EditableAction::className(),
                'modelClass' => SeoModel::className(),
                'forceCreate' => false
            ],
        ];
    }

    /**
     * Lists all SeoModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@vendor/yii2mod/yii2-seo/views/seo/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SeoModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeoModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seo has been created.');
            return $this->redirect(['index']);
        }

        return $this->render('@vendor/yii2mod/yii2-seo/views/seo/create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing SeoModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seo has been saved.');
            return $this->redirect(['index']);
        }

        return $this->render('@vendor/yii2mod/yii2-seo/views/seo/update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing SeoModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Seo has been deleted.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the SeoModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeoModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeoModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
