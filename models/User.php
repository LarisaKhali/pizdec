<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $password
 * @property string $full_name
 * @property string $phone
 * @property string $email
 * @property int $role
 *
 * @property Card[] $cards
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'password', 'full_name', 'phone', 'email'], 'required'],
            [['role'], 'integer'],
            [['username', 'full_name', 'phone', 'email'], 'string', 'max' => 255],
            [['password'], 'string', 'max' => 50],
            [['username'], 'unique'],
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
            'password' => 'Password',
            'full_name' => 'Full Name',
            'phone' => 'Phone',
            'email' => 'Email',
            'role' => 'Role',
        ];
    }

    /**
     * Gets query for [[Cards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCards()
    {
        return $this->hasMany(Card::class, ['user_id' => 'id']);
    }
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return null;
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string|null current user auth key
     */
    public function getAuthKey()
    {
        return null;
    }

    /**
     * @param string $authKey
     * @return bool|null if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return false;
    }
    public static function findByUsername($username)
    {
        return User::findOne(['username' => $username]);
    }
    public function validatePassword($password)
    {
        return $this->password === md5($password);
    }
    public function beforeSave($insert)
    {
        $this->password = md5($this->password);
        return parent::beforeSave($insert);
    }
    public function isAdmin(){
        return $this->role == 1;
    }
}
