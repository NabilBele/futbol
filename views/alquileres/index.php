<?php

use app\models\Alquileres;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Alquileres';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="alquileres-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Alquileres', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            

            'id',
  [
            'attribute' => 'idSocio',
            'value' => function ($model) {
                return $model->idSocio0->nombre." ".$model->idSocio0->apellidos; // Access the related `Campos` model and retrieve the `nombre` attribute
            },
        ],
               [
            'attribute' => 'idCampo',
            'value' => function ($model) {
                return $model->idCampo0->nombre; // Access the related `Campos` model and retrieve the `nombre` attribute
            },
        ],
            'fechaHora',
            'horas',
            
            //'personas',
            //'precioTotal',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Alquileres $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>