<?php

use yii\helpers\Html;
use yii\grid\GridView;

use yii2mod\editable\EditableColumn;
use yii2mod\toggle\ToggleColumn;
use kravchukdim\yii2seo\models\enumerable\SeoCategoryStatus;

/* @var $this yii\web\View */
/* @var $searchModel app\components\seo\models\search\SeoCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Seo Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-category-index">

    <h1><?php echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?php echo Html::a(Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo Category',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php \yii\widgets\Pjax::begin(['enablePushState' => false,'timeout' => 3000]); ?>
    <?php echo GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            [
                'class' => EditableColumn::className(),
                'attribute' => 'name',
                'url' => ['edit-category-name'],
            ],
            'comment:ntext',
            [
                'class' => ToggleColumn::className(),
                'attribute' => 'status',
                'filter' => SeoCategoryStatus::listData(),
                'filterInputOptions' => ['prompt' => 'Select Status', 'class' => 'form-control'],
            ],
            'position',
            // 'createdAt',
            // 'updatedAt',
            [
                'header' => 'Action',
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}{delete}',
            ],
        ],
    ]);
    ?>
    <?php \yii\widgets\Pjax::end(); ?>

</div>
