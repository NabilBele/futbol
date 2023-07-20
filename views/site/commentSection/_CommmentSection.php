 <?php
 use app\models\Comments;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
 
 
 ?>
 <div class="comments-section">

     <div class="comment-form">
         <?php $newComment = new Comments(); ?>
         <?php $form = ActiveForm::begin(['id' => 'comment-form',
         'enableAjaxValidation' => true,])?>

         <?= $form->field($newComment, 'comment')
         ->textarea(['rows' => 4, 'placeholder' => 'Add your comment'])->label(false) ?>

         <button class="submit-comment-btn btn btn-primary" data-action="<?= Yii::$app->urlManager
             ->createUrl(['comments/add', 'postId' => $model->id]) ?>">
             <i class="far fa-comment"></i> Submit
         </button>



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
                 <?php include('LikeComment.php');?>


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
             <?php include('Replies.php'); ?>
     </div>
     <?php endforeach; ?>
 </div>

 <script>
$(document).ready(function() {
    $(document).on("click", ".submit-comment-btn", function(event) {
        event.preventDefault();
        var commentButton = $(this);

        var commentForm = $(this).closest("form");
        var commentInput = commentForm.find("textarea[name='Comments[comment]']");
        var commentValue = commentInput.val().trim();

        if (commentValue === "") {
            console.log("Comment cannot be empty");
            return;
        }

        $.ajax({
            url: commentButton.data("action"),
            type: "POST",
            data: commentForm.serialize(),
            dataType: "json",
            success: function(response) {
                var parsedResponse = JSON.parse(response);

                if (parsedResponse.success === true) {
                    console.log("Works");

                    // Fetch the updated comments section
                    $.ajax({
                        url: parsedResponse.fetchCommentsUrl,
                        type: "GET",
                        success: function(updatedComments) {
                            $('.comments-section').html(updatedComments);

                            // Clear the comment input field
                            commentInput.val('');
                        },
                        error: function() {
                            console.log("Failed to fetch updated comments.");
                        }
                    });
                }
            },
            error: function(xhr, textStatus, errorThrown) {
                console.error("AJAX request failed:", errorThrown);
            }
        });



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
    display: flex;
    flex-direction: row;
    align-items: center;
    margin: 0;
    justify-content: space-between;
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
 </style>