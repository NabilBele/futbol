<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Replies $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="replies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'replyText')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'userId')->textInput() ?>

    <?= $form->field($model, 'commentId')->textInput() ?>

    <?= $form->field($model, 'parentCommentId')->textInput() ?>

    <?= $form->field($model, 'parentReplyId')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
