<?php
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\YiiAsset;

// Register YiiAsset to include necessary JavaScript and CSS files
YiiAsset::register($this);
?>

<style>
.card-img-height {
    height: 200px;
    object-fit: cover;
}

.card {
    padding: 10px;
    position: relative;
    transition: transform 0.3s ease;
}

.card-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 10px;
}

.card:hover {
    transform: scale(1.05);
    z-index: 1;
}

.login-message {
    margin-top: 10px;
    font-size: 14px;
    color: red;
}
</style>

<div class="card-container">
    <div class="card">
        <img src="<?= Yii::getAlias('@web') . '/imgs/campos/' . $model->foto ?>" class="card-img-top card-img-height"
            alt="Campo Image">
        <div class="card-body">
            <h5 class="card-title"><?= $model->nombre ?></h5>
            <p><?= $model->direccion ?></p>
            <?php
                       echo StarRating::widget([
    'name' => 'rating_35',
    'value' => $model->average,
    'pluginOptions' => ['displayOnly' => true,"size"=>'sm']
]);
?>
        </div>
        <div class="card-footer">
            <?php if (Yii::$app->user->isGuest) : ?>
            <?= Html::a('View Details', ['viewcampo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reservar Ahora', ['site/login'], ['class' => 'btn btn-danger']) ?>
            <?php else : ?>
            <?= Html::a('View Details', ['viewcampo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reservar Ahora',
             ['reserve', 'id' => $model->id, 'userid' => Yii::$app->user->id], ['class' => 'btn btn-danger']) ?>
            <?php endif; ?>
        </div>
    </div>
</div>