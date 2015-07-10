<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use kravchukdim\yii2seo\models\enumerable\SeoCategoryStatus;

/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoCategoryModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'pageContent')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaTitle')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaDescription')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaKeywords')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'status')->dropDownList(SeoCategoryStatus::$list); ?>

    <?php echo $form->field($model, 'position')->textInput() ?>

    <?php echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
