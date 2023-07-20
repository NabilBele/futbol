<?php 
use app\models\Rates;
use kartik\rating\StarRating;
?>
<div class="container rating">
    <header>
        <h1>your opinion matters</h1>
    </header>
    <hr />
    <div class="main">
        <h2>Reviews</h2>
        <h4 class="bd1"></h4>

        <!-- Main Rate -->

        <div class="row m-2">
            <div class="col-lg-4 Larea">
                <p><span class="overall"><?=$model->average?></span> <span>/5</span></p>
                <?php 
   echo StarRating::widget([
    'name' => 'rating_35',
    'value' => $model->average,
    'pluginOptions' => ['displayOnly' => true]
]);
?>
                <p>Votes <i class="votes"><?php echo count($model->votes); ?></i></p>
                <button class="btn rate-btn" data-toggle="modal" data-target="#ratingModal">
                    Rate this campo
                </button>
            </div>
            <div class="Rarea col-lg-8">
                <?php
for ($i = 5; $i > 0; $i--) {
    $votesCount = Rates::find()->where(["idCampo" => $model->id])
        ->andWhere(["rate" => $i])->all();

    echo '<div class="row align-items-center m-2">';
    echo '<div class="col-lg-3">';
    echo StarRating::widget([
        'name' => 'rating_35',
        'value' => $i,
        'pluginOptions' => ['displayOnly' => true, 'size' => 'sm']
    ]);
    echo '</div>';
    echo '<div class="col">';
    echo '<div class="progress">';
    echo '<div class="progress-bar" role="progressbar" style="width: 0%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>';
    echo '</div>';
    echo '</div>';
    echo '<div class="col-lg-2 this-votes-count">';
    echo '<p class="votes-count">' . count($votesCount) . ' </p>';
    echo '</div>';
    echo '</div>';
}
?>