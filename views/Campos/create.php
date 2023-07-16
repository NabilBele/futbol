<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Campos $model */

$this->title = 'Create Campos';
$this->params['breadcrumbs'][] = ['label' => 'Campos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="campos-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formCreate', [
        'model' => $model,
    ]) ?>

</div>