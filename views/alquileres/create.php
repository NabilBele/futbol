<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Alquileres $model */
/** @var array $fechas */

$this->title = 'Create Alquileres';
$this->params['breadcrumbs'][] = ['label' => 'Alquileres', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alquileres-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formInsert', [
        'model' => $model
    ]) ?>

</div>