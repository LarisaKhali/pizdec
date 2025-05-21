<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $binding_id
 * @property string $name
 * @property string $author
 * @property string $sharing_status
 * @property string|null $publishing_name
 * @property string|null $year
 * @property int|null $condition_id
 * @property int $is_archive
 * @property int $is_published
 * @property string $cancellation_reason
 * @property Binding $binding
 * @property ConditionBook $condition
 * @property User $user
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[ 'name', 'author', 'sharing_status'], 'required'],
            [['user_id', 'binding_id', 'condition_id'], 'integer'],
            [['sharing_status'], 'string'],
            [['year'], 'safe'],
            [['name', 'author', 'publishing_name'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['condition_id'], 'exist', 'skipOnError' => true, 'targetClass' => ConditionBook::class, 'targetAttribute' => ['condition_id' => 'id']],
            [['binding_id'], 'exist', 'skipOnError' => true, 'targetClass' => Binding::class, 'targetAttribute' => ['binding_id' => 'id']],
            ['user_id', 'default', 'value' => Yii::$app->user->id],
            ['cancellation_reason', 'required', 'when' => function ($model) {
            return $model->is_published == 2;
            }, 'whenClient' => "function (attribute, value) {
            return $('#publish').val() == 2;}"]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'binding_id' => 'Binding ID',
            'name' => 'Name',
            'author' => 'Author',
            'sharing_status' => 'Sharing Status',
            'publishing_name' => 'Publishing Name',
            'year' => 'Year',
            'condition_id' => 'Condition ID',
            'is_published' => 'Статус публикации',
            'is_archive' => 'Статус архива',
            'cancellation_reason' => 'Причина отклонения'
        ];
    }

    /**
     * Gets query for [[Binding]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBinding()
    {
        return $this->hasOne(Binding::class, ['id' => 'binding_id']);
    }

    /**
     * Gets query for [[Condition]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCondition()
    {
        return $this->hasOne(ConditionBook::class, ['id' => 'condition_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    public function getShare()
    {
        switch ($this->sharing_status) {
            case 'share': return 'Готов поделиться';
            case 'unshare': return 'Хочу в свою библиотеку';
        }
    }

    public function getConditionName()
    {
        return $this->condition->condition_name;
    }

    public function getBindingName()
    {
        return $this->binding->name;
    }

    public function getArchive()
    {
        switch ($this->is_archive) {
            case 0: return 'Не в архиве';
            case 1: return 'Удалена (в архиве)';
        }
    }

    public function getPublish()
    {
        switch ($this->is_published) {
            case 0: return 'На рассмотрении';
            case 1: return 'Опубликована';
            case 2: return "Не опубликована";
        }
    }
}
