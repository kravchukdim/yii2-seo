<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\components\seo\models\search\SeoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($model, 'id') ?>

    <?php echo $form->field($model, 'url') ?>

    <?php echo $form->field($model, 'name') ?>

    <?php echo $form->field($model, 'comment') ?>

    <?php echo $form->field($model, 'pageContent') ?>

    <?php // echo $form->field($model, 'metaTitle') ?>

    <?php // echo $form->field($model, 'metaDescription') ?>

    <?php // echo $form->field($model, 'metaKeywords') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'categoryId') ?>

    <?php // echo $form->field($model, 'seoPageClass') ?>

    <?php // echo $form->field($model, 'createdAt') ?>

    <?php // echo $form->field($model, 'updatedAt') ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
