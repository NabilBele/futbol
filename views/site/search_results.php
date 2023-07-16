<?php

use yii\helpers\Html;
use yii\widgets\ListView;

/** @var yii\web\View $this */
/** @var app\models\Campos $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Search Results';
?>

<div class="body-content">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row mt-4">
        <div class="col-md-12">
            <?= ListView::widget([
                'dataProvider' => $dataProvider,
                'itemView' => '_campo',
                'layout' => "{items}\n{pager}",
            ]) ?>
        </div>
    </div>
</div>