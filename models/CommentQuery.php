<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii2mod\comments\models\enums\CommentStatus;

/**
 * Class CommentQuery
 * @package app\models
 */
class CommentQuery extends ActiveQuery
{
    /**
     * @return $this
     */
    public function active()
    {
        return $this->andWhere(['is_published' => 1]);
    }

    /**
     * @return $this
     */
    public function deleted()
    {
        return $this->andWhere(['is_published' => 0]);
    }
}