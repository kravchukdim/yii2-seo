<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;

use kartik\select2\Select2;

use kravchukdim\seo\models\enumerable\SeoStatus;
use kravchukdim\seo\models\SeoCategoryModel;
use kravchukdim\seo\components\SeoHelper;



/* @var $this yii\web\View */
/* @var $model app\components\seo\models\SeoModel */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="seo-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'url')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'urlRule')->widget(Select2::classname(), [
        'data' => SeoHelper::getRoutersList(),
        'options' => ['placeholder' => 'Select a url rule'],
        'pluginOptions' => [
            'allowClear' => true
        ],
    ]); ?>

    <?php echo $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'pageContent')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaTitle')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaDescription')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'metaKeywords')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'comment')->textarea(['rows' => 6]) ?>

    <?php echo $form->field($model, 'categoryId')->dropDownList(ArrayHelper::map(SeoCategoryModel::find()->active()->all(), 'id', 'name')); ?>

    <?php echo $form->field($model, 'status')->dropDownList(SeoStatus::$editList); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
