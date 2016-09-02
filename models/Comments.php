<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use app\behaviors\PurifyBehavior;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;

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
 * @property array|\yii\db\ActiveRecord[] children
 * @property mixed level
 */
class Comments extends \yii\db\ActiveRecord
{
    protected $_children;

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
            [['tid'], 'required'],
            [['tid', 'pid', 'is_published'], 'integer'],
            [['text', 'create_date', 'update_date'], 'string'],
            [['name', 'email'], 'string', 'max' => 255],
            ['pid', 'default', 'value' => 0]
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
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'create_date',
                'updatedAtAttribute' => 'update_date'
            ],
            'purify' => [
                'class' => PurifyBehavior::className(),
                'attributes' => ['text'],
                'config' => [
                    'HTML.SafeIframe'      => true,
                    'URI.SafeIframeRegexp' => '%^(https?:)?//(www\.youtube(?:-nocookie)?\.com/embed/|player\.vimeo\.com/video/)%',
                    'AutoFormat.Linkify'   => true,
                    'HTML.TargetBlank'     => true,
                    'HTML.Allowed'         => 'a[href], iframe[src|width|height|frameborder], img[src]'
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     *
     * @return CommentQuery
     */
    public static function find()
    {
        return new CommentQuery(get_called_class());
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

    /**
     * This method is called at the beginning of inserting or updating a record.
     *
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->pid > 0) {
                $parentNodeLevel = (int)self::find()->select('level')->where(['id' => $this->pid])->scalar();
                $this->level = $parentNodeLevel + 1;
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * This method is called at the end of inserting or updating a record.
     *
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        if (!$insert) {
            if (array_key_exists('is_published', $changedAttributes) && $this->is_published == 0) {
                self::updateAll(['is_published' => 1], ['pid' => $this->id]);
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * Get comments tree.
     *
     * @param $tid int
     * @param null $maxLevel
     * @param bool $showDeletedComments
     * @return array|\yii\db\ActiveRecord[] Comments tree
     */
    public static function getTree($tid, $maxLevel = null, $showDeletedComments = false)
    {
        $query = self::find()->where(['tid' => $tid]);

        if ($maxLevel > 0) {
            $query->andWhere(['<=', 'level', $maxLevel]);
        }

        if (!$showDeletedComments) {
            $query->active();
        }

        $models = $query->orderBy(['pid' => SORT_ASC, 'create_date' => SORT_ASC])->all();

        if (!empty($models)) {
            $models = self::buildTree($models);
        }

        return $models;
    }

    /**
     * Build comments tree.
     *
     * @param array $data Records array
     * @param int $rootID parentId Root ID
     * @return array|ActiveRecord[] Comments tree
     */
    protected static function buildTree(&$data, $rootID = 0)
    {
        $tree = [];

        /**
         * @var  $id
         * @var  $node self
         */
        foreach ($data as $id => $node) {
            if ($node->pid == $rootID) {
                unset($data[$id]);
                $node->children = self::buildTree($data, $node->id);
                $tree[] = $node;
            }
        }

        return $tree;
    }

    /**
     * $_children getter.
     *
     * @return null|array|ActiveRecord[] Comment children
     */
    public function getChildren()
    {
        return $this->_children;
    }

    /**
     * $_children setter.
     *
     * @param array|ActiveRecord[] $value Comment children
     */
    public function setChildren($value)
    {
        $this->_children = $value;
    }

    /**
     * Check if comment has children comment
     *
     * @return bool
     */
    public function hasChildren()
    {
        return !empty($this->_children);
    }

    /**
     * Get avatar user
     *
     * @return string
     */
    public function getAvatar()
    {
        return "http://www.gravatar.com/avatar/00000000000000000000000000000000?d=mm&f=y&s=50";
    }

    /**
     * Get a list of the authors of the comments
     *
     * This function used for filter in gridView, for attribute `createdBy`.
     *
     * @return array
     */
    public function getAuthorsNames()
    {
        return $this->name;
    }


    /**
     * Get comment posted date as relative time
     *
     * @return string
     */
    public function getPostedDate()
    {
        return Yii::$app->formatter->asRelativeTime($this->create_date);
    }
}
