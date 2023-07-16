 <?php
 use app\models\Comments;
 use app\models\Replies;
 use yii\helpers\Html;
 use yii\widgets\ActiveForm;
 
 ?>
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