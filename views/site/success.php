<?php

use yii\helpers\Html;

$this->title = 'Registration Successful';
$this->params['breadcrumbs'][] = $this->title;
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php if (!empty($nombre)): ?>
<p>Hola <?= Html::encode($nombre) ?>,</p>
<?php endif; ?>

<p>Your registration was successful!</p>

<?= Html::a('Go to Login', ['site/login'], ['class' => 'btn btn-primary']) ?>