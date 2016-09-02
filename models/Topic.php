<?php

namespace app\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "topic".
 *
 * @property integer $id
 * @property string $name
 * @property string $alias
 * @property string $text
 * @property integer $is_published
 * @property string $author
 * @property string $create_date
 * @property string $update_date
 * @property Comments comments[]
 *
 */
class Topic extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'topic';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'alias'], 'required'],
            [['text'], 'string'],
            [['is_published'], 'integer'],
            [['create_date', 'update_date'], 'safe'],
            [['name', 'alias', 'author'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'           => Yii::t('app', 'ID'),
            'name'         => Yii::t('app', 'Name'),
            'alias'        => Yii::t('app', 'Alias'),
            'text'         => Yii::t('app', 'Text'),
            'is_published' => Yii::t('app', 'Is Published'),
            'author'       => Yii::t('app', 'Author'),
            'create_date'  => Yii::t('app', 'Create Date'),
            'update_date'  => Yii::t('app', 'Update Date'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['tid' => 'id'])->where(['is_published' => 1]);
    }

    /**
     * @return ActiveDataProvider
     */
    public function search()
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $dataProvider->sort->defaultOrder['id'] = SORT_DESC;
        $dataProvider->query->where(['is_published' => 1]);

        return $dataProvider;
    }
}
