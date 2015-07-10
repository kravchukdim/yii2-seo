<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\grid\GridView;

use yii2mod\editable\EditableColumn;
use kravchukdim\seo\models\SeoCategoryModel;
use kravchukdim\seo\models\enumerable\SeoStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\components\seo\models\search\SeoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seo pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(['enablePushState' => false,'timeout' => 10000]); ?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'url',
            'urlRule',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'name',
                'url' => ['edit-seo-name'],
            ],
            [
                'class' => EditableColumn::className(),
                'url' => ['edit-seo-status'],
                'type' => 'select',
                'editableOptions' => function ($model) {
                    return [
                        'source' => Json::encode(SeoStatus::$editList),
                        'value' => $model->status,
                    ];
                },
                'filterInputOptions' => ['prompt' => 'Select Status', 'class' => 'form-control'],
                'attribute' => 'status',
                'value' => function ($model) {
                    return SeoStatus::getLabel($model->status);
                },
                'filter' => SeoStatus::$list,
            ],
            [
                'class' => EditableColumn::className(),
                'url' => ['edit-seo-category'],
                'type' => 'select',
                'editableOptions' => function ($model) {
                    return [
                        'source' => Json::encode(ArrayHelper::map(SeoCategoryModel::find()->active()->all(),'id', 'name')),
                        'value' => $model->categoryId,
                    ];
                },
                'filterInputOptions' => ['prompt' => 'Select Category', 'class' => 'form-control'],
                'attribute' => 'categoryId',
                'value' => function ($model) {
                    $categoryModel = SeoCategoryModel::findOne($model->categoryId);
                    return !empty($categoryModel)? $categoryModel->name : '';
                },
                'filter' => ArrayHelper::map(SeoCategoryModel::find()->order()->all(),'id', 'name'),
            ],
            // 'seoPageClass',
            // 'createdAt',
            // 'updatedAt',
            // 'comment:ntext',
            // 'pageContent:ntext',
            // 'metaTitle:ntext',
            // 'metaDescription:ntext',
            // 'metaKeywords:ntext',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view}{update}{delete}',
                'buttons' => [
                    'view' => function ($url, $model) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', Url::to($model->url, true),
                            ['title' => 'View', 'data-pjax' => 0, 'target' => '_blank']);
                    }
                ],
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
