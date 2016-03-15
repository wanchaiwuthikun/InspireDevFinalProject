<?php

namespace app\models;

use Yii;
use common\models\Course;
use common\models\User;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%forumAsk}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $course_id
 * @property integer $user_id
 *
 * @property ForumAns[] $forumAns
 * @property User $user
 * @property Course $course
 * @property Search[] $searches
 */
class ForumAsk extends \yii\db\ActiveRecord
{
    public $asktotal;
    public $anstoal;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forumAsk}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['create_at', 'update_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['update_at'],
                ]

            ],

        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_at', 'update_at', 'course_id', 'user_id'], 'integer'],
            [['course_id', 'user_id'], 'required'],
            [['title'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อคำถาม',
            'content' => 'คำถาม',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'course_id' => 'ชื่อคอร์ส',
            'user_id' => 'ผู้ตั้งคำถาม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumAns()
    {
        return $this->hasMany(ForumAns::className(), ['forumAsk_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearches()
    {
        return $this->hasMany(Search::className(), ['forumAsk_id' => 'id']);
    }

    public function getcourseList()
    {
        $cat = Course::find()->where(['category_id' => 3 ])->asArray()->all();

        return ArrayHelper::map($cat,'id','title');
    }

    /**
     * Gets the id of the article creator.
     * NOTE: needed for RBAC Author rule.
     *
     * @return integer
     */
    public function getCreatedBy()
    {
        return $this->user_id;
    }

    /**
     * Gets the author name from the related User table.
     *
     * @return mixed
     */
    public function getAuthorName()
    {
        return $this->user->username;
    }

    public function getCourseid()
    {
        return $this->course_id;
    }
}
