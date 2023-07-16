<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
use kartik\date\DatePicker;

/** @var yii\widgets\ActiveForm $form */
/** @var array $fechas */
?>


<div class="Reservation">
    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'idSocio')->dropDownList([$model->idSocio0->id => $model->idSocio0->nombre ],
     ['readonly' => true]) ?>

    <?= $form->field($model, 'idCampo')->dropDownList([$model->idCampo0->id => $model->idCampo0->nombre],
     ['readonly' => true]) ?>

    <?= $form->field($model, 'fechaHora')->textInput([
    'readonly' => true,
    'maxlength' => 13,
    'placeholder' => 'fecha hora',
]) ?>

    <div id="fecha">
        <label for="check_issue_date">Fecha</label>
        <?= 
    DatePicker::widget([
        'name' => 'check_issue_date', 
        'options' => ['placeholder' => 'Select issue date ...', 'readonly' => true],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            'startDate' => "+0d",
            'endDate' => "+7d",
            'autoclose' => true,
        ]
    ]);
    ?>
    </div>
    <br>
    <div id="fecha_hora_container" class="d-none">
        <?php
echo DateTimePicker::widget([
    'name' => 'check_hora',
    'options' => ['id' => 'fecha_hora', 'placeholder' => 'Select date and time...', 'readonly' => true],
    'readonly' => true,
    'pluginOptions' => [
        'format' => 'hh',
        'todayHighlight' => true,
        'autoclose' => true,
        'minView' => 1,
        'maxView' => 0,
        'startView' => 1,
        'hoursDisabled' => '0,1,2,3,4,5,6,7,8,9,22,23',
    ],
]);
?>
    </div>



    <?= $form->field($model, 'horas')->dropDownList(["1" => 1, "2" => 2], ['id' => 'horas-field']) ?>

    <?= $form->field($model, 'personas')->textInput(['readonly' => true, 'value' => $model->idCampo0->aforo]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php include('styles/reservationConfirem.php'); ?>