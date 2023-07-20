<?php
use app\models\Likes;
use yii\widgets\ActiveForm;

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

<style>
.like-comment {
    font-size: large;
    position: relative;
    border: none;
    color: blue;
    background-color: transparent;
    transition: transform 0.3s ease;
}

.like-comment:hover>* {
    transform: scale(1.2);
}

#like-form-8,
#like-form-4 {
    margin: 0;
}
</style>