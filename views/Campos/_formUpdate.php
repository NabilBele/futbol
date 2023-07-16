<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/** @var yii\web\View $this */
/** @var app\models\Campos $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="campos-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'aforo')->textInput() ?>

    <?= $form->field($model, 'precio')->textInput() ?>

    <?= $form->field($model, 'direccion')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telefono')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tipo')->textInput(['maxlength' => true]) ?>


    <?= 
     $form->field($model, 'archivo')->widget(FileInput::class, [
    'name' => 'attachment_53',
    'pluginOptions' => [
        'showCaption' => false,
        'showRemove' => false,
        'showUpload' => false,
        'browseClass' => 'btn btn-primary btn-block',
        'browseIcon' => '<i class="fas fa-camera"></i> ',
        'browseLabel' =>  'Select Photo',
        'initialPreview' => [
            Html::img('@web/imgs/campos/'.$model->foto, ['class' => 'file-preview-image', 'alt' => 'nophoto']),
        ],
        'initialPreviewConfig' => [
            [
                'caption' => $model->foto, // File name
                'size' => file_exists(Yii::getAlias('@web/imgs/campos/'.$model->foto)) ? filesize(Yii::getAlias('@web/imgs/campos/'.$model->foto)) : 1,
            ],
        ],
    ],
    'options' => [
        'accept' => 'image/*',
    ]
]) ?>

    <?php
$file = Yii::getAlias('@web/imgs/campos/'.$model->foto);
echo "File path: " . $file;
?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>