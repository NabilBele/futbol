<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string $comment
 * @property int $userId
 * @property int $postId
 * @property string|null $timestamp
 *
 * @property Likes[] $likes
 * @property Alquileres $post
 * @property Replies[] $replies
 * @property Replies[] $replies0
 * @property Socios $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment', 'userId', 'postId'], 'required'],
            [['userId', 'postId'], 'integer'],
            [['timestamp'], 'safe'],
            [['comment'], 'string', 'max' => 500],
            [['postId'], 'exist', 'skipOnError' => true, 'targetClass' => Alquileres::class, 'targetAttribute' => ['postId' => 'id']],
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
            'comment' => 'Comment',
            'userId' => 'User ID',
            'postId' => 'Post ID',
            'timestamp' => 'Timestamp',
        ];
    }

    /**
     * Gets query for [[Likes]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLikes()
    {
        return $this->hasMany(Likes::class, ['commentId' => 'id']);
    }

    /**
     * Gets query for [[Post]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPost()
    {
        return $this->hasOne(Alquileres::class, ['id' => 'postId']);
    }

    /**
     * Gets query for [[Replies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies()
    {
        return $this->hasMany(Replies::class, ['commentId' => 'id']);
    }

    /**
     * Gets query for [[Replies0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReplies0()
    {
        return $this->hasMany(Replies::class, ['parentCommentId' => 'id']);
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