<?php
use yii\helpers\Html;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

$qrCode = new QrCode(Html::encode($model->idSocio0->nombre." ".$model->idSocio0->apellidos.
"\n Campo : ".$model->idCampo0->nombre."\n Fecha : ".$model->fechaHora.
"\n Tiempo : ".$model->horas."\n Pricio : ".$model->precioTotal));

$qrCode->setSize(200); 


$writer = new PngWriter();


$qrCodeImageString = $writer->write($qrCode)->getString();


$qrCodeFormat = 'image/png'; 


$qrCodeDataUri = 'data:' . $qrCodeFormat . ';base64,' . base64_encode($qrCodeImageString);
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.3.2/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<div class="reserveCard">
    <div class="card">
        <?php if ($model->idCampo0->foto): ?>
        <?= Html::img("@web/imgs/campos/".$model->idCampo0->foto, ['class' => 'card-img-top']) ?>
        <?php endif; ?>
        <div class="card-body">
            <h5 class="card-title">Reservation Details</h5>
            <p class="card-text">
                <strong class="strong"><?= Html::encode($model->idSocio0->nombre
                    ." ".$model->idSocio0->apellidos) ?></strong>
                <br>
            </p>

            <img src="<?= $qrCodeDataUri ?>" alt="QR Code" class="qr-code">
            <div class="reservation-details">
                <strong>Fecha:</strong> <?= Html::encode($model->fechaHora) ?><br>
                <strong>tiempo:</strong> <?= Html::encode($model->horas)." Horas" ?><br>
                <strong>campo:</strong> <?= Html::encode($model->idCampo0->nombre) ?><br>
                <strong>Location:</strong> <?= Html::encode($model->idCampo0->direccion) ?><br>
                <strong>Precio Total:</strong> <?= Html::encode($model->precioTotal)." €" ?><br>
            </div>
        </div>
    </div>
    <button id="downloadButton" class="btn btn-primary mt-3">Download PDF</button>
</div>
<?php include("styles/cardStyle.php") ?>