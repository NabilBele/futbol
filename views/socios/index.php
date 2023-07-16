<?php

use app\models\Socios;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Socios';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socios-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Socios', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombre',
            'apellidos',
            'email:email',
            'telefono',
                  [
            'label' => 'Reservations List', // Add the label for the column
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a('Reservations', ['/socios/reservations', 'id' => $model->id], ['class' => '']);
            },
        ],
            //'fechahora',
            //'password',
            //'isAdmin',
                [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Socios $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ]
        ],
    ]); ?>


</div>