       <?php
       use app\models\Replies;
       use yii\helpers\Html;
       use yii\widgets\ActiveForm;
       ?>
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