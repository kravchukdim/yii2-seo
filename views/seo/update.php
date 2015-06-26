<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoModel */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Seo',
]) . ' ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="seo-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
