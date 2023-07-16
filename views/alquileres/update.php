<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alquileres $model */
/** @var array $fechas */

$this->title = 'Update Alquileres: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Alquileres', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="alquileres-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formUpdate', [
        'model' => $model
    ]) ?>

</div>