<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "replies".
 *
 * @property int $id
 * @property string $replyText
 * @property int $userId
 * @property int $commentId
 * @property int|null $parentCommentId
 * @property int|null $parentReplyId
 * @property string $timestamp
 *
 * @property Comments $comment
 * @property Likes[] $likes
 * @property Comments $parentComment
 * @property Replies $parentReply
 * @property Replies[] $replies
 * @property Socios $user
 */
class Replies extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'replies';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['replyText', 'userId', 'commentId', 'timestamp'], 'required'],
            [['userId', 'commentId', 'parentCommentId', 'parentReplyId'], 'integer'],
            [['timestamp'], 'safe'],
            [['replyText'], 'string', 'max' => 500],
            [['commentId'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::class, 'targetAttribute' => ['commentId' => 'id']],
            [['parentCommentId'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::class, 'targetAttribute' => ['parentCommentId' => 'id']],
            [['parentReplyId'], 'exist', 'skipOnError' => true, 'targetClass' => Replies::class, 'targetAttribute' => ['parentReplyId' => 'id']],
            [['userId'], 'exist', 'skipOnError' => true, 'targetClass' => Socios::class, 'targetAttribute' => ['userId' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'replyText' => 'Reply Text',
            'userId' => 'User ID',
            'commentId' => 'Comment ID',
            'parentCommentId' => 'Parent Comment ID',
            'parentReplyId' => 'Parent Reply ID',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Comment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComment()
    {
        return $this->hasOne(Comments::class, ['id' => 'commentId']);
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['replyId' => 'id']);
    }

    /**
     * Gets query for [[ParentComment]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentComment()
    {
        return $this->hasOne(Comments::class, ['id' => 'parentCommentId']);
    }

    /**
     * Gets query for [[ParentReply]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getParentReply()
    {
        return $this->hasOne(Replies::class, ['id' => 'parentReplyId']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::class, ['parentReplyId' => 'id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Socios::class, ['id' => 'userId']);
    }
}
