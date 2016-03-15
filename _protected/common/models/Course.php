<?php

namespace common\models;

use Yii;
use common\models\Category;
use yii\helpers\ArrayHelper;
use yii\db\BaseActiveRecord;

/**
 * This is the model class for table "{{%course}}".
 *
 * @property integer $id
 * @property string $title
 * @property string $images
 * @property integer $category_id
 *
 * @property Article[] $articles
 * @property Category $category
 * @property ForumsAsk[] $forumsAsks
 * @property Videos[] $videos
 */
class Course extends \yii\db\ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%course}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id'], 'required'],
            [['category_id'], 'integer'],
            [['title', 'images'], 'string', 'max' => 100],
//          title and category_id need to be unique together, only title will receive error message
            [['title'], 'unique', 'targetAttribute' => ['title', 'category_id']],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อคอร์ส',
            'images' => 'รูปปกคอร์ส',
            'category_id' => 'หมวดหมู่',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getForumsAsks()
    {
        return $this->hasMany(ForumsAsk::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVideos()
    {
        return $this->hasMany(Videos::className(), ['course_id' => 'id']);
    }

    public function getDropdownCategory()
    {
        $cate = Category::find()->asArray()->all();
        return ArrayHelper::map($cate, 'id', 'title');
    }
    public function getUploadUrl(){

        return '@getImage/uploads/imgCourse/'.$this->images;
    }

    public function getPhotoViewer(){

        if (empty($this->images)){

        }

        return 'empty($this->images)' ? '@getImage/imgCourse/'.'none.png' : $this->getUploadUrl();
    }



}
