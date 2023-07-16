<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Replies $model */

$this->title = 'Create Replies';
$this->params['breadcrumbs'][] = ['label' => 'Replies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="replies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
