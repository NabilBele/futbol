<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\View;

/** @var View $this */
/** @var array $model */

$this->title = 'Reservations List';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php 
$alertDisplayed = false;
foreach ($model as $reserve ) {
    $fecha = strtotime($reserve->fechaHora);
    if ($fecha - time() < (24 * 60 * 60) && !$alertDisplayed) {
        echo Html::tag('div', 'You can\'t update or cancel your reservation 24 hours before the specified date', [
            'class' => 'alert alert-danger',
            'role' => 'alert',
        ]);
    }
    $alertDisplayed = true; 
}
?>


<div class="list-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => new \yii\data\ArrayDataProvider([
            'allModels' => $model,
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
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update} {delete}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('View', ['reserved', 'id' => $model['id']], [
                            'class' => 'btn btn-success',
                        ]);
                    },
                     'update' => function ($url, $model, $key) {
                        $deleteTime = strtotime($model['fechaHora']);
                        $currentTime = time();
                        $isUpdateable = ($deleteTime - $currentTime) > (24 * 60 * 60); 

                        if ($isUpdateable) {
                            return Html::a('Update', ['update', 'id' => $model['id']], [
                                'class' => 'btn btn-primary',
                            ]);
                        } else {
                            $checkDate=false;
                            return '';
                        }
                    },
                    'delete' => function ($url, $model, $key) {
                        $deleteTime = strtotime($model['fechaHora']);
                        $currentTime = time();
                        $isDeletable = ($deleteTime - $currentTime) > (24 * 60 * 60); // Check if more than 24 hours remaining

                        if ($isDeletable) {
                            return Html::a('Delete', ['delete', 'id' => $model['id']], [
                                'class' => 'btn btn-danger deleteBtn',
                                'data-toggle' => 'modal',
                                'data-target' => '#confirmationModal',
                            ]);
                        } else {
                            return '';
                        }
                    },
                ],
            ],
        ],
    ]); ?>

</div>
<?php include('styles/myreservationScript.php') ?>