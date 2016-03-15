<?php

namespace common\models;

use Yii;
use app\models\Tag;
use frontend\models\Article;
use app\models\ForumAsk;
use app\models\Videos;



/**
 * This is the model class for table "{{%search}}".
 *
 * @property integer $id
 * @property integer $tag_id
 * @property integer $article_id
 * @property integer $videos_id
 * @property integer $forumAsk_id
 *
 * @property Article $article
 * @property ForumAsk $forumAsk
 * @property Tag $tag
 * @property Videos $videos
 */
class Search extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%search}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_id', 'article_id', 'videos_id', 'forumAsk_id'], 'safe'],
            [['tag_id', 'article_id', 'videos_id', 'forumAsk_id'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tag_id' => 'Tag ID',
            'article_id' => 'Article ID',
            'videos_id' => 'Videos ID',
            'forumAsk_id' => 'Forum Ask ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
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
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasOne(Videos::className(), ['id' => 'videos_id']);
    }

    /**
     * @inheritdoc
     * @return SearchQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SearchQuery(get_called_class());
    }
}
