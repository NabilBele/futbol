<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Socios $model */

$this->title = 'Create Socios';
$this->params['breadcrumbs'][] = ['label' => 'Socios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="socios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_formInsert', [
        'model' => $model,
    ]) ?>

</div>