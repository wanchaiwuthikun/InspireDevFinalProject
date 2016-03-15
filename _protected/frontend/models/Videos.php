<?php

namespace app\models;

use Yii;
use common\models\Course;
use common\models\User;
use common\models\VideosStatus;
use yii\helpers\ArrayHelper;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%videos}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $url
 * @property integer $course_id
 * @property integer $user_id
 * @property integer $videos_status_id
 *
 * @property Search[] $searches
 * @property Course $course
 * @property User $user
 * @property VideosStatus $videosStatus
 */
class Videos extends ActiveRecord
{
    public $ep=1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%videos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['course_id', 'user_id', 'title', 'url'], 'required', 'message' => 'กรุณากรอก {attribute}'],
            [['course_id', 'user_id', 'videos_status_id'], 'integer'],
            // set value default Video_status = 1 (Pending)
            ['videos_status_id', 'default', 'value' => 1],
            [['title'], 'string', 'max' => 100],
            [['url'], 'string', 'max' => 250,]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อวิดีโอ',
            'content' => 'คำอธิบายเพิ่มเติม',
            'url' => 'ลิงก์วิดีโอ',
            'course_id' => 'ชื่อคอร์ส',
            'user_id' => 'ผู้อัพโหลด',
            'videos_status_id' => 'สถานะ',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSearches()
    {
        return $this->hasMany(Search::className(), ['videos_id' => 'id']);
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideosStatus()
    {
        return $this->hasOne(VideosStatus::className(), ['id' => 'videos_status_id']);
    }
    public function getcourseList()
    {
    $cat = Course::find()->where(['category_id' => 1 ])->asArray()->all();

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
    public  function  getstatusList()
    {
        $status = VideosStatus::find()->asArray()->all();
        return ArrayHelper::map($status, 'id', 'title');
    }
    public function getStatusVideos()
    {

        return $this->videosStatus->title;
    }

}
