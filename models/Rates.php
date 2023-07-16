<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rates".
 *
 * @property int $id
 * @property int $idCampo
 * @property int $userId
 * @property int $rate
 * @property string|null $comment
 *
 * @property Campos $idCampo0
 * @property Socios $user
 */
class Rates extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'rates';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idCampo', 'userId', 'rate'], 'required'],
            [['idCampo', 'userId', 'rate'], 'integer'],
            [['comment'], 'string', 'max' => 500],
            [['idCampo'], 'exist', 'skipOnError' => true, 'targetClass' => Campos::class, 'targetAttribute' => ['idCampo' => 'id']],
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
            'idCampo' => 'Id Campo',
            'userId' => 'User ID',
            'rate' => 'Rate',
            'comment' => 'Comment',
        ];
    }

    /**
     * Gets query for [[IdCampo0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getIdCampo0()
    {
        return $this->hasOne(Campos::class, ['id' => 'idCampo']);
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
