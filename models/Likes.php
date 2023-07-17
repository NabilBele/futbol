<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "likes".
 *
 * @property int $id
 * @property int $userId
 * @property int|null $commentId
 * @property int|null $replyId
 * @property string $timestamp
 *
 * @property Comments $comment
 * @property Replies $reply
 * @property Socios $user
 */
class Likes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'likes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['userId', 'timestamp'], 'required'],
            [['userId', 'commentId', 'replyId'], 'integer'],
            [['timestamp'], 'safe'],
            [['commentId'], 'exist', 'skipOnError' => true, 'targetClass' => Comments::class, 'targetAttribute' => ['commentId' => 'id']],
            [['replyId'], 'exist', 'skipOnError' => true, 'targetClass' => Replies::class, 'targetAttribute' => ['replyId' => 'id']],
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
            'userId' => 'User ID',
            'commentId' => 'Comment ID',
            'replyId' => 'Reply ID',
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
     * Gets query for [[Reply]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getReply()
    {
        return $this->hasOne(Replies::class, ['id' => 'replyId']);
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