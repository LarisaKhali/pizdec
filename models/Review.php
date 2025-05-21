<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "review".
 *
 * @property int $id
 * @property int $card_id
 * @property string $text
 *
 * @property Card $card
 */
class Review extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'review';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'text'], 'required'],
            [['card_id'], 'integer'],
            [['text'], 'string', 'max' => 255],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::class, 'targetAttribute' => ['card_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'text' => 'Text',
        ];
    }

    /**
     * Gets query for [[Card]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::class, ['id' => 'card_id']);
    }
}
