<?php

namespace kravchukdim\yii2seo\controllers;

use Yii;
use kravchukdim\yii2seo\models\SeoCategoryModel;
use kravchukdim\yii2seo\models\search\SeoCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii2mod\editable\EditableAction;
use yii2mod\toggle\actions\ToggleAction;

/**
 * Class SeoCategoryController
 * SeoController implements the CRUD actions for SeoCategoryModel model.
 * @author Kravchuk Dmitry
 * @package kravchukdim\yii2seo\controllers
 */
class SeoCategoryController extends Controller
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
            'edit-category-name' => [
                'class' => EditableAction::className(),
                'modelClass' => SeoCategoryModel::className(),
                'forceCreate' => false
            ],
            'toggle' => [
                'class' => ToggleAction::className(),
                'modelClass' => SeoCategoryModel::className(),
            ]
        ];
    }

    /**
     * Lists all SeoCategoryModel models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SeoCategorySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@vendor/yii2mod/yii2-seo/views/seoCategory/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new SeoCategoryModel model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SeoCategoryModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seo Category has been created.');
            return $this->redirect(['index']);
        }

        return $this->render('@vendor/yii2mod/yii2-seo/views/seoCategory/create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing SeoCategoryModel model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Seo Category has been saved.');
            return $this->redirect(['index']);
        }

        return $this->render('@vendor/yii2mod/yii2-seo/views/seoCategory/update', [
            'model' => $model,
        ]);

    }

    /**
     * Deletes an existing SeoCategoryModel model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'Seo Category has been deleted.');
        return $this->redirect(['index']);
    }

    /**
     * Finds the SeoCategoryModel model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SeoCategoryModel the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SeoCategoryModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
