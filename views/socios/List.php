<?php

use yii\helpers\Html;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var array $reservesList */

$this->title = 'Reservations List';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $reservesList,
            'pagination' => false, // Disable pagination if needed
        ]),
        'columns' => [
            'id',
            [
            'attribute' => 'Nombre',
            'value' => function ($model) {
                return $model->idSocio0->nombre." ".$model->idSocio0->apellidos;
            },
        ],
              [
            'attribute' => 'Campo',
            'value' => function ($model) {
                return $model->idCampo0->nombre;
            },
        ],  
            'fechaHora',
            'horas',
            'personas',
            'precioTotal',
            // Add more columns as needed
        ],
    ]); ?>

</div>