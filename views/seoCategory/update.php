<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoCategoryModel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Seo Category',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seo-category-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
