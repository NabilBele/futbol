<?php

/** @var yii\web\View $this */

$this->title = 'Futbol Campos';
?>
<div class="body-content">
    <div class="container">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card-container">
                    <?php
                    foreach ($campos as $model) {
                        echo $this->render("_campo", [
                            "model" => $model
                        ]);
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>