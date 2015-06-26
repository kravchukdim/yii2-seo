<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoCategoryModel */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo Category',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-category-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
