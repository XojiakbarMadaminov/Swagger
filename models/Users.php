<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users.users".
 *
 * @property int $id
 * @property string|null $username
 * @property string|null $access_token
 * @property string|null $password
 * @property int|null $auth_key
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users.users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'string'],
            [['auth_key'], 'default', 'value' => null],
            [['auth_key'], 'integer'],
            [['access_token'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 32],
            [['password'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'access_token' => 'Access Token',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin(string $login)
    {
        return static::findOne(['login' => $login]);

    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);

    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
