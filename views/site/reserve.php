<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alquileres $model */
/** @var array $socio */
/** @var array $campo */
/** @var array $fechas */

$this->title = 'Create Alquileres';
$this->params['breadcrumbs'][] = [
    'label' => 'Alquileres',
    'url' => ['/site/reserved', 'id' => $model->id],
];

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alquileres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formReserve', [
        'model' => $model,
        'socio' => $socio,
        'campo' => $campo,
        "fechas"=>$fechas,
    ]) ?>

</div>