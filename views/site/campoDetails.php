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

                <?= Html::a('Reservar Ahora', ['reserve', 'id' => $model->id, 'userid' => Yii::$app->user->id], ['class' => 'btn btn-danger']) ?>

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
                <div class="modal-body">
                    <?php $form = ActiveForm::begin(['action' => ['site/rate', 'id' => $model->id]]); ?>

                    <?= $form->field($ratingModel, 'rate')->widget(\kartik\rating\StarRating::class, [
                                'name' => 'rating_21',
                                'pluginOptions' => [
                                    'min' => 0,
                                    'max' => 5,
                                    'step' => 1,
                                    'size' => 'lg',
                                    'starCaptions' => [
                                        1 => 'Very Bad',
                                        2 => 'Bad',
                                        3 => 'Average',
                                        4 => 'Good',
                                        5 => 'Excellent',
                                    ],
                                    'starCaptionClasses' => [
                                        1 => 'text-danger',
                                        2 => 'text-warning',
                                        3 => 'text-info',
                                        4 => 'text-primary',
                                        5 => 'text-success',
                                    ],
                                ],
                            ])->label('Rate this campo') ?>

                    <?= $form->field($ratingModel, 'comment')->textarea(['rows' => 3])->label('Comment') ?>

                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php include('rateScript/RatingDetails.php') ?>

    <div class="comments-section">
        <div class="comment-form">
            <?php $newComment = new Comments(); ?>
            <?php $form = ActiveForm::begin(['action' => ['comments/add', 'id' => $model->id]]); ?>

            <?= $form->field($newComment, 'comment')->textarea(['rows' => 4, 'placeholder' => 'Add your comment'])->label(false) ?>
            <?= $form->field($newComment, 'userId')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
            <?= $form->field($newComment, 'postId')->hiddenInput(['value' => $model->id])->label(false) ?>

            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

            <?php ActiveForm::end(); ?>
        </div>

        <?php if (empty($comments)): ?>
        <p>No comments yet. Be the first to comment!</p>
        <?php endif; ?>

        <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <div class="comment-header">
                <p class="comment-author"><?= Html::encode($comment->user->nombre) ?></p>
                <div class="comment-actions">
                    <?php if ($comment->userId === Yii::$app->user->id): ?>
                    <i class="fas fa-ellipsis-v comment-menu"></i>
                    <div class="comment-menu-options">
                        <?= Html::a('Delete', ['/comments/deletecomment', 'id' => $comment->id, 'campo' => $model->id], [
                            'class' => 'comment-menu-option delete-comment',
                            'data' => [
                                'confirm' => 'Are you sure you want to delete this comment?',
                                'method' => 'post',
                            ],
                        ]) ?>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <p class="comment-content"><?= Html::encode($comment->comment) ?></p>
            <p class="comment-actions">
                <?php foreach ($comment->likes as $like): ?>
                <span class="like-comment">Like (<?= Html::encode($like->user->nombre) ?>)</span>
                <?php endforeach; ?>
                <span class="reply-comment">Reply</span>
            </p>

            <div id="reply-container" class="reply-form" style="display: none;">
                <?php $newReply = new Replies(); ?>
                <?php $form = ActiveForm::begin(['action' => ['replies/add', 'id' => $comment->id]]); ?>

                <?= $form->field($newReply, 'replyText')->textarea(['rows' => 2, 'placeholder' => 'Add your reply'])->label(false) ?>
                <?= $form->field($newReply, 'userId')->hiddenInput(['value' => Yii::$app->user->id])->label(false) ?>
                <?= $form->field($newReply, 'commentId')->hiddenInput(['value' => $comment->id])->label(false) ?>

                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>

                <?php ActiveForm::end(); ?>
            </div>

            <?php foreach ($comment->replies as $reply): ?>
            <div class="reply">
                <div class="reply-header">
                    <p class="reply-author"><?= Html::encode($reply->user->nombre) ?></p>
                    <div class="reply-actions">
                        <?php if ($reply->userId === Yii::$app->user->id): ?>
                        <i class="fas fa-ellipsis-v reply-menu"></i>
                        <div class="reply-menu-options">
                            <?= Html::a('Delete', ['/replies/deletereply', 'id' => $reply->id, 'campo' => $model->id], [
                                    'class' => 'reply-menu-option delete-reply',
                                    'data' => [
                                        'confirm' => 'Are you sure you want to delete this reply?',
                                        'method' => 'post',
                                    ],
                                ]) ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="reply-bubble">
                    <p class="reply-content"><?= Html::encode($reply->replyText) ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php include('styles/CampoDetails.php') ?>