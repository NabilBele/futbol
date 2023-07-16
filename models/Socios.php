<?php

namespace app\models;

use Yii;
use yii\base\Security;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "socios".
 *
 * @property int $id
 * @property string $nombre
 * @property string $apellidos
 * @property string $email
 * @property string $telefono
 * @property string $fechahora
 * @property string $password
 * @property bool $isAdmin
 *
 * @property Alquileres[] $alquileres
 */
class Socios extends ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'socios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'email'], 'required'],
            [['nombre', 'email'], 'string', 'max' => 200],
            [['apellidos'], 'string', 'max' => 400],
            [['telefono'], 'string', 'max' => 20],
            [['email'], 'unique'],
            [['password'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'apellidos' => 'Apellidos',
            'email' => 'Email',
            'telefono' => 'Teléfono',
            'fechahora' => 'Fecha y Hora',
            'password' => 'Contraseña',
            'isAdmin' => 'Is Admin',
        ];
    }

    /**
     * {@inheritdoc}
     */
public function beforeSave($insert)
{
    if (parent::beforeSave($insert)) {
        if ($this->isNewRecord) {
            $this->id = null;
        }

        if ($this->password === null || $this->password === '') {
            // Generate a random password if not provided
            $security = new Security();
            $this->password = $security->generateRandomString();
        } else {
            // Encrypt the password
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }

        return true;
    }

    return false;
}

    /**
     * Gets query for [[Alquileres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAlquileres()
    {
        return $this->hasMany(Alquileres::class, ['idSocio' => 'id']);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID, `null` if not found
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface|null the identity object that matches the given token, `null` if not found
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Implement this method if you have token-based authentication
        return null;
    }

    /**
     * Returns the ID of the user.
     *
     * @return string|int the ID of the user
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the key used to check the validity of the given auth key.
     *
     * @return string|null the key used to check the validity of the given auth key. `null` is returned
     * if the key should not be checked
     */
    public function getAuthKey()
    {
        // Implement this method if you have cookie-based authentication
        return null;
    }

    /**
     * Validates the given auth key.
     *
     * @param string $authKey the given auth key
     * @return bool whether the given auth key is valid
     */
    public function validateAuthKey($authKey)
    {
        // Implement this method if you have cookie-based authentication
        return null;
    }
    public function login()
{
    if ($this->validate()) {
        return Yii::$app->user->login($this);
    }
    return false;
}
public function validatePassword($password)
{
    return Yii::$app->security->validatePassword($password, $this->password);
}


}