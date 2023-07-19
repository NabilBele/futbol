 <?php
 use app\models\Comments;
 use app\models\Likes;
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

                 <?php
$hasLiked = Likes::find()
    ->where(['userId' => Yii::$app->user->id, 'commentId' => $comment->id])
    ->exists();

$form = ActiveForm::begin([
    'id' => 'like-form-' . $comment->id,
    'enableAjaxValidation' => true,
]);
?>

                 <button class="like-comment"
                     data-action="<?= Yii::$app->urlManager->createUrl(['site/togglelike', 'commentId' => $comment->id]) ?>">
                     <i class="<?= $hasLiked ? 'fas' : 'far' ?> fa-thumbs-up"></i>
                 </button>



                 <!-- Display the likes count -->
                 <span class="likes-count" id="likes-count-<?= $comment->id ?>"><?= count($comment->likes); ?></span>

                 <?php ActiveForm::end(); ?>



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



 <script>
$('.like-comment').on('click', function(event) {
    event.preventDefault();

    var likeButton = $(this);
    var likesCount = likeButton.siblings('.likes-count');

    $.post({
        url: likeButton.data('action'),
        data: likeButton.data('params'),
        success: function(response) {
            if (response === 'success') {
                // Toggle the like button's class and update the likes count
                likeButton.find('i').toggleClass('fas far');
                likesCount.text(parseInt(likesCount.text()) + (likeButton.find('i').hasClass(
                    'fas') ? 1 : -1));
                console.log('works, no need to reload. Stop here');
            }
        }
    });
});
 </script>

 <style>
.comments-section {
    margin-top: 20px;
}

.comment {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
    background-color: #f6f7f8;
}

.comment-author {
    font-weight: bold;
    margin: 0;
}

.comment-content {
    margin-top: 5px;
}

.comment-actions,
.reply-actions {
    margin-top: 5px;
    font-size: 12px;
    color: #888;
}

.comment-actions span {
    cursor: pointer;
    margin-right: 10px;
}

.reply-form {
    padding: 10px;
    background-color: #f6f7f8;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-top: 10px;
}

.reply-form input[type="text"],
.reply-form textarea {
    width: 100%;
    padding: 8px;
    border: none;
    border-radius: 4px;
    background-color: #fff;
    resize: vertical;
    outline: none;
}

.reply-form .btn-primary {
    margin-top: 10px;
}

.reply {
    margin-top: 10px;
}

.reply-bubble {
    padding: 10px;
    background-color: #f6f7f8;
}

.reply-author {
    font-weight: bold;
    font-size: 14px;
    margin-bottom: 5px;
}

.reply-content {
    margin: 0;
}

.comment-header,
.reply-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.comment-actions,
.reply-actions {
    position: relative;
}

.comment-menu,
.reply-menu {
    cursor: pointer;
}

.comment-menu-options,
.reply-menu-options {
    position: absolute;
    top: 100%;
    right: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    padding: 5px;
    display: none;
}

.comment-menu-option,
.reply-menu-option {
    display: block;
    cursor: pointer;
    padding: 5px;
    text-decoration: none;
}

.comment-menu-option:hover,
.reply-menu-option:hover {
    background-color: #f9f9f9;
}

.like-comment {
    margin-right: 10px;
    font-size: large;
    position: relative;
    border: none;
    color: blue;
    transition: transform 0.3s ease;
}

.like-comment:hover>* {
    transform: scale(1.2);
}
 </style>