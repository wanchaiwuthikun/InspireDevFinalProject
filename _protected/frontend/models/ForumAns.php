<?php

namespace app\models;

use Yii;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * This is the model class for table "{{%forumAns}}".
 *
 * @property integer $id
 * @property string $content
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $user_id
 * @property integer $forumAsk_id
 *
 * @property ForumAsk $forumAsk
 * @property User $user
 */
class ForumAns extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forumAns}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],

                ],

            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['create_at', 'update_at', 'user_id', 'forumAsk_id'], 'integer'],
            [['user_id', 'forumAsk_id', 'content'], 'required'],
            [['content'], 'string', 'max' => 1000],


        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'คำตอบ',
            'create_at' => 'วันที่ตอบคำถาม',
            'update_at' => 'วันที่แก้ไขคำตอบ',
            'user_id' => 'User ID',
            'forumAsk_id' => 'Forum Ask ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumAsk()
    {
        return $this->hasOne(ForumAsk::className(), ['id' => 'forumAsk_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
