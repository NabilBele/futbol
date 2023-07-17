<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $model->nombre;
?>

<div class="campo-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= Html::img(Url::to(['imgs/campos/' . $model->foto]), ['class' => 'campo-image img-fluid']) ?>
        </div>
        <div class="col-lg-6">
            <div class="campo-details">
                <p><strong>Aforo:</strong> <?= Html::encode($model->aforo) ?></p>
                <p><strong>Precio por hora:</strong> <?= Html::encode($model->precio) ?></p>
                <p><strong>Teléfono:</strong> <?= Html::encode($model->telefono) ?></p>
                <p><strong>Tipo:</strong> <?= Html::encode($model->tipo) ?></p>
                <p><strong>Dirección:</strong>
                    <a href="https://www.google.com/maps/search/?api=1&query=<?= urlencode($model->nombre." ".$model->direccion) ?>"
                        target="_blank">
                        <?= Html::encode($model->direccion) ?>
                    </a>
                </p>
                <?= Html::a('Reserve Now', ['reserve', 'id' => $model->id, 'userid' => Yii::$app->user->id], ['class' => 'btn btn-danger']) ?>
            </div>
        </div>
    </div>
</div>

<hr>

<!-- Rating Modal -->
<?php include('styles/_rateModal.php') ?>

<!-- Rating details -->
<?php include('rateScript/RatingDetails.php') ?>

<!-- Comment Section -->
<?php include('styles/_CommmentSection.php') ?>
</div>

<?php include('styles/CampoDetails.php') ?>