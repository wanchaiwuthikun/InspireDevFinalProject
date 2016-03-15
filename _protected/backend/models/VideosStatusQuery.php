<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VideosStatus]].
 *
 * @see VideosStatus
 */
class VideosStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return VideosStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VideosStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}