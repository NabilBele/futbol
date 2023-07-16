<?php

use app\models\Campos;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Campos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campos-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Campos', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'aforo',
            'precio',
            'direccion',
            //'telefono',
            //'tipo',
              [
            'label' => 'Reservations List', // Add the label for the column
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('Reservations List', ['/campos/reservations', 'id' => $model->id], ['class' => '']);
            },
        ],
              [
                'attribute' => 'foto',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::img('@web/imgs/campos/' . $model->foto, ['class' => 'col-lg-2']);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Campos $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>