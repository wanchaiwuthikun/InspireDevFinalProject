<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%forumAsk}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property integer $create_at
 * @property integer $update_at
 * @property integer $course_id
 *
 * @property ForumAns[] $forumAns
 * @property Course $course
 * @property Search[] $searches
 */
class ForumAsk extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%forumAsk}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content'], 'string'],
            [['create_at', 'update_at', 'course_id'], 'integer'],
            [['course_id'], 'required'],
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
            'course_id' => 'Course ID',
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
}
