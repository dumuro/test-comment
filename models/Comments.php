<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "comments".
 *
 * @property integer $id
 * @property integer $tid
 * @property integer $pid
 * @property string $name
 * @property string $email
 * @property string $text
 * @property integer $is_published
 * @property string $create_date
 * @property string $update_date
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tid', 'pid', 'name', 'email', 'text', 'create_date', 'update_date'], 'required'],
            [['tid', 'pid', 'is_published'], 'integer'],
            [['text', 'create_date', 'update_date'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tid' => Yii::t('app', 'Tid'),
            'pid' => Yii::t('app', 'Pid'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'E-mail'),
            'text' => Yii::t('app', 'Text'),
            'is_published' => Yii::t('app', 'Is Published'),
            'create_date' => Yii::t('app', 'Create Date'),
            'update_date' => Yii::t('app', 'Update Date'),
        ];
    }

    /**
     * @param $tid
     * @return ActiveDataProvider
     */
    public function search($tid)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);

        $dataProvider->sort->defaultOrder['id']  = SORT_DESC;
        $dataProvider->query->where(['tid' => $tid,'is_published' => 1]);

        return $dataProvider;
    }
}
