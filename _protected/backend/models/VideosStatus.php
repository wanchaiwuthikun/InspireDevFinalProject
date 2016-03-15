<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%videos_status}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $detail
 *
 * @property Videos[] $videos
 */
class VideosStatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%videos_status}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 100],
            [['detail'], 'string', 'max' => 250]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อสถานะ',
            'detail' => 'คำอธิบายเพิ่มเติม',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['videos_status_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return VideosStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VideosStatusQuery(get_called_class());
    }
}
