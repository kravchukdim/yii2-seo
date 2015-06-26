<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoModel */

$this->title = Yii::t('app', 'Create {modelClass}', [
    'modelClass' => 'Seo',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Seo'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seo-create">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
