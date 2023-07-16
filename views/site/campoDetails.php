<?php
use app\models\Comments;
use app\models\Replies;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;

$this->title = $model->nombre;
?>

<div class="campo-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-6">
            <?= Html::img(Url::to(['imgs/campos/' . $model->foto]), ['class' => 'campo-image']) ?>
        </div>
        <div class="col-lg-6">
            <div class="campo-details">
                <p><strong>Aforo:</strong> <?= Html::encode($model->aforo) ?></p>
                <p><strong>Precio por hora:</strong> <?= Html::encode($model->precio) ?></p>
                <p><strong>Dirección:</strong>
                    <?= Html::a(Html::encode($model->direccion), '#', ['target' => '_blank']) ?></p>
                <p><strong>Teléfono:</strong> <?= Html::encode($model->telefono) ?></p>
                <p><strong>Tipo:</strong> <?= Html::encode($model->tipo) ?></p>

                <?= Html::a('Reserve Now', ['reserve', 'id' => $model->id, 'userid' => Yii::$app->user->id], ['class' => 'btn btn-danger']) ?>

            </div>
        </div>
    </div>

    <div class="modal" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ratingModalLabel">Rate this campo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Rating Modal -->
                <?php include('styles/_rateModal.php') ?>

                <!-- Rating details -->
                <?php include('rateScript/RatingDetails.php') ?>

                <!-- Comment Section -->
                <?php include('styles/_CommmentSection.php') ?>
            </div>

            <?php include('styles/CampoDetails.php') ?>