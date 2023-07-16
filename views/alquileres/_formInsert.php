<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/** @var yii\web\View $this */
/** @var app\models\Alquileres $model */
/** @var yii\widgets\ActiveForm $form */
$this->registerJs('jQuery(document).ready(function($){});');
?>
<style>
</style>

<div class="alquileres-form">
    <?php $form = ActiveForm::begin(); ?>



    <?= $form->field($model, 'idSocio')->dropDownList($model->socios) ?>

    <?= $form->field($model, 'idCampo')->dropDownList($model->campos) ?>

    <?php $fechas; ?>

    <?= $form->field($model, 'fechaHora')->widget(DateTimePicker::class, [
        'id' => 'datetimepicker',
        'options' => ['placeholder' => 'Select date and time...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd hh',
            'todayHighlight' => true,
            'autoclose' => true,
            'minView' => 1,
            'maxView' => 1,
            'startView' => 2,
            'hoursDisabled' => '0,1,2,3,4,5,6,7,8,22,23',
            'startDate' => "+0d",
            'endDate' => "+7d",
            'showMeridian' => true,
            'value' => date('Y-m-d H:i:s'),
        ],
    ]) ?>




    <?= $form->field($model, 'horas')->dropDownList(["1" => 1, "2" => 2], ['id' => 'horas-field']) ?>

    <?= $form->field($model, 'personas')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>