<?php

namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use Yii;

class Upload extends Model
{
    /**
     * @var UploadedFile
     */
    public $images;
    public $randomName;

    public function rules()
    {
        return [
            /* ['images', 'required','message' => 'กรุณาเลือกไฟล์'],*/
            [['images'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, gif']
        ];
    }

    public function attributeLabels()
    {
        return [
            'images' => 'ภาพประกอบ'
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            $this->images->saveAs(Yii::getAlias('@pathUpload').'/'.$this->randomName);
            return true;
        } else {
            return false;
        }
    }



}